window.addEventListener('DOMContentLoaded', function () {

    // Кнопка с последними событиями
    $('.alert-socket__btn').click(function() {
        // Показать список с последними событиями
        $('.alert-socket__content').toggle(500, function () {
            // Запомнить последний просмотренный ID события
            let id = $(this).find('li:first-child').data('alert_item');
            if(id) {
                cookie('messageIteration', id, {expires: 2592e6});
            }
        });
    });

    // Sockets
    eventsWebSocket();
});

function eventsWebSocket() {
    if(typeof io === 'undefined') {
        return false;
    }
    var params = {
        // Интервал вывода сообщений на экран в секундах
        delay   : 7,
        cookie: {
          // Сколько хранить куки, для итерации события(в секундах)
          expires: 2592e3,
        },
        message :
        {
            'regLevelEvent' : [
                l('ws-regLevel_0'),
                l('ws-regLevel_1'),
                l('ws-regLevel_2'),
                l('ws-regLevel_3'),
            ],
            'newUserPlaceEvent'       : l('ws-newUserPlace'),
            'upgrageEvent'            : l('ws-upgrade'),
            'reinvestEvent'           : l('ws-reinvest'),
            'missedEthReceive'        : l('ws-missedEthReceive'),
            'sentExtraEthDividends'   : l('ws-sentExtraEthDividends'),
            'cannotSendMoneyEvent'    : l('ws-cannotSendMoneyEvent'),
            'leadingPartner'          : l('ws-leadingPartner'),
            'leadingPlacePurchase'    : l('ws-leadingPlacePurchase'),
        },
        rates   : null,
        levels  : null,
        events  : null,
        messageIteration: 0,
        storage: {
        },
        // Настройки контейнера
        container: {
            el:   $('.alert-socket__items'),
            cell: $('.alert-socket__cell'),
            btn:  $('.alert-socket__btn'),
            wrapper:  $('.alert-socket__content'),
            countItems: 20,
        },
        // Иконка событий
        eventsTypeIcon: {
          'regLevelEvent'           : 'useradd.svg',
          'newUserPlaceEvent'       : 'newuserplace.svg',
          'upgrageEvent'            : 'upgrade.svg',
          'reinvestEvent'           : 'reinvest.svg',
          'missedEthReceive'        : 'missed.svg',
          'sentExtraEthDividends'   : 'dividends.svg',
          'cannotSendMoneyEvent'    : '',
          'leadingPartner'          : 'leading.svg',
          'leadingPlacePurchase'    : 'dividends.svg',
        }
    };
    params.delay    *= 1000;


    var socket = io.connect('wss://forsage.io:2087', {
        rejectUnauthorized: false,
        rememberTransport: false,
        secure: true,
    });
    socket.on('addEvents', function(data) {
        data = JSON.parse(data);
        if (!data.events) {
          notify('empty variable "data.events"');
          return;
        }
        if (!data.params) {
          notify('empty variable "data.params"');
          return;
        }
        if (!data.params.levels) {
          notify('empty variable "data.params.levels"');
          return;
        }
        if (!data.params.storage) {
          notify('empty variable "data.params.storage"');
          return;
        }
        params.events = data.events.reverse();
        params.levels = data.params.levels;
        params.rates  = data.params.storage;

        // Модификация событий в зависимости от доп. условий
        let event;
        for(let e in params.events) {
            event = params.events[e];
            // Обгоны в X3, меняем тип события
            if(event.matrix == '1' && (event.overflow && !event.is_leading)) {
                params.events[e].type = 'leadingPlacePurchase';
            }
        }


        // Запись в контейнер событий
        writeByContainer(params.events);
    });
    socket.on('resetEvents', function(status) {});
    socket.on('error', function(err) {
        notify(err);
    });

    // Вывести сообщение короткое
    alertByEvent();

    // Вывод короткого окошка о событии
    function alertByEvent() {
        setInterval(function () {
            if(params.container.wrapper.css('display') == 'block') {
                return;
            }
            if (!params.events || params.events.length == 0) {
                notify('empty variable "params.events"');
                return;
            }
            // Получить с кук последний указанный ID события
            messageIteration('init');
            let event = null;
            let events = params.events.slice(-3);
            for(let e in events) {
                if(params.messageIteration < events[e].id) {
                    event = events[e];
                    break;
                }
            }
            if(event) {
                let msg = createMessage(event)
                params.container.cell.html(`<img src="/img/icons/${params.eventsTypeIcon[event.type]}" alt="" class="alert-socket__img"> ${msg} <div data-elapse_time="${event.time1}" class="elapsedTime"></div>`)

                params.container.cell.show(500, function() {
                    setTimeout(function() {
                        params.container.cell.hide(500);
                        params.container.cell.empty();
                    }, 2500);
                });
                messageIteration('set', event.id);
            }
        }, params.delay);
    }

    // Запись в контейнер событий
    function writeByContainer(events) {
        let event, msg;
        for(let i = 0; i < events.length; i++) {
            event = events[i];
            if (!event.id) {
              break;
            }

            msg = createMessage(event);

            let el = params.container.el;
            let item = el.find('li:first-child').data('alert_item');
            if(!item || item < event.id) {
                // Добавить запись
                el.prepend(`<li data-alert_item="${event.id}"><img src="/img/icons/${params.eventsTypeIcon[event.type]}" alt="" class="alert-socket__img"> ${msg} <div data-elapse_time="${event.time1}" class="elapsedTime"></div></li>`);

                // Импульс для кнопки, оповестить юзера о новой транзакции
                if(!params.container.btn.hasClass('pulse')) {
                    params.container.btn.addClass('pulse')
                }
                setTimeout(function () {
                    params.container.btn.removeClass('pulse')
                }, 2000);

                // Удалить с контейнера больше чем n записей
                for(let i = el.find('li').length; i > params.container.countItems; i--) {
                    el.find('li:last-child').remove();        
                }
            } else {
            }
        }
    }

    function createMessage(event) {
        let msg;
        // Тип сообщения
        msg = params.message[event.type];
        // Рандомизировать сообщения
        if(Array.isArray(msg)) {
            msg = msg[Math.floor(Math.random() * msg.length)];
        }
        msg = msg.replace('{up_id}', event.up_id);
        msg = msg.replace('{ref_id}', event.r_id);
        msg = msg.replace('{u_id}', event.u_id);
        msg = msg.replace('{user_id}', event.user_id);
        msg = msg.replace('{crypto_name}', 'ETH');
        msg = msg.replace('{level}', event.level);
        if(event.matrix > 0) {
            msg = msg.replace('{price_level}', parseFloat( params.levels[event.matrix][event.level] ));
            msg = msg.replace('{currency_usd}', parseFloat( params.rates.eth * params.levels[event.matrix][event.level] ) . toFixed(2));
        }
        switch(event.matrix) {
            case '1':
                msg = msg.replace('{matrix}', 'X3');
                break;
            case '2':
                msg = msg.replace('{matrix}', 'X4');
                break;
            default:
                msg = msg.replace('{matrix}', '?');
        }
        return msg;
    }

    function messageIteration(action, key) {
        if (action == 'init') {
          params.messageIteration = cookie('messageIteration');
        }
        if (action == 'set') {
          params.messageIteration = key;
          cookie('messageIteration', params.messageIteration, {expires: 2592e6});
        }
    }
    // Вывод уведомлений веб сокета
    function notify(msg) {
      console.log('JS WebSocket: ', msg);
    }
}

function storageTrigger(key, defaultValue) {
    let val = storage(key);
    if(val == '0') {
        val = '1';
    } else {
        val = '0';
    }
    return storage(key, val, defaultValue);
}

/* Cookie */
function storage(key, val, defaultValue) {
    let storage = getCookie('storage');
    if(!storage) {
        storage = {};
    } else {
        storage = JSON.parse(storage);
    }
    if(val) {
        // Значение по умолчанию если значение еще не установленно
        if(!storage.hasOwnProperty(key)) {
            val = defaultValue ? 1 : 0;
        }
        storage[key] = val;
        setCookie(
            'storage', 
            JSON.stringify(storage),
            {
                expires: 31104e3
            }
        );
        return val;
    }
    return storage.hasOwnProperty(key) ? storage[key] : null;
}

function cookie(key, val, opts) {
    if(val) {
        return setCookie(key, val, opts)
    }
    return getCookie(key);
}

function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options = {}) {
    let defaultOptions = {
        path: '/',
    };
    options = Object.assign(defaultOptions, options);
    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    } else {
        if(options.expires) {
            options.expires = new Date(Date.now() + Number.parseInt(options.expires));
        }
    }
    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);
    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }
    document.cookie = updatedCookie;
}

(function() {
    'use strict';

    // Триггер значений
    $('[data-trigger_value]').click(function () {
        let el, sib, out, val, res;
        el = out = $(this);
        if(el.find('span').length) {
            out = el.find('span');
        }
        val = el.data('trigger_value').split('|');
        if(out.text() == val[0]) {
            res = val[1];
        } else {
            res = val[0];
        }
        out.text(res);

        sib = el.data('trigger_value_siblings');
        if(sib) {
            sib = $(sib);
            if(sib.find('span').length) {
                sib = sib.find('span');
            }
            sib.text(res);
        }
    });

    // Спойлер
    $('[data-spoiler]').click(function () {
        let key = $(this).data('spoiler');
        $(key).slideToggle(); 
    });

    // Translates
    window.l = function l(key) {
        if(!config.lang || !config.lang.hasOwnProperty(key)) {
            return 'no translate';
        }
        return config.lang[key];
    };

    // Copy text
    window.copyText = function(value) {
        var s = document.createElement('input');
        s.value = value;
        document.body.appendChild(s);

        if(navigator.userAgent.match(/ipad|ipod|iphone/i)) {
            s.contentEditable = true;
            s.readOnly = false;
            var range = document.createRange();
            range.selectNodeContents(s);
            var sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
            s.setSelectionRange(0, 999999);
        }
        else {
            s.select();
        }
        try {
            document.execCommand('copy');
            Notice.success(
                l('copied')
            );
        }
        catch (err) {
            Notice.error('Copied error: ' + err.message);
        }
        s.remove();
    };

  // Notices service
    // window.Notice = new Vue({
    //     el: '#Notice',
    //     template: `
    //         <div class="notice" v-if="items.length">
    //             <div class="notice__darken" v-if="item.darken"></div>
    //             <div class="notice__wrap" @mouseover.once="item.lifetime > 0 ? (item.lifetime = 0) || clearTimeout(item._timeout) : null" :style="{width: item.width + 'px'}" :class="[item.type, 'notice__wrap_x-' + item.x, 'notice__wrap_y-' + item.y]" :key="item">
    //                 <div class="notice__close" v-if="item.canclose" @click="close(item)"></div>
    //                 <i class="notice__icon fa" v-if="item.icon" :class="['fa-' + item.icon]"></i>
    //                 <div class="notice__body">
    //                     <div class="notice__title" v-if="item.title" v-html="item.title"></div>
    //                     <div v-if="item.text" v-html="item.text"></div>
    //                     <div class="notice__btns">
    //                         <button v-for="(v, k) in item.buttons" @click="v(item) !== false ? close(item) : null" v-text="k"></button>
    //                     </div>
    //                 </div>
    //                 <div v-if="item.lifetime > 0" class="notice__progress" :style="{animation: 'notice__progress_anim ' + (item.lifetime / 1000) + 's linear'}"></div>
    //             </div>
    //         </div>
    //     `,
    //     data: {
    //         items: []
    //     },
    //     mounted() {
    //         let s = document.createElement('style');
    //         s.innerHTML = `
    //             .notice {}
    //                 .notice__darken { position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); }
    //                 .notice__wrap { position:fixed; z-index:1002; background:#fff; color:#000; box-shadow:0 4px 12px rgba(0,0,0,.1); overflow:hidden; border-radius:3px; }
    //                     .notice__wrap.primary { background:var(--primary-color); color:#fff; }
    //                     .notice__wrap.secondary { background:var(--secondary-color); color:#fff; }
    //                     .notice__wrap.success { background:var(--success-color); color:#fff; }
    //                     .notice__wrap.error { background:var(--error-color); color:#fff; }
    //                     .notice__wrap.warning { background:var(--warning-color); color:#fff; }
    //                     .notice__wrap_x-left { left:30px; }
    //                     .notice__wrap_x-center { left:50%; transform:translateX(-50%); }
    //                     .notice__wrap_x-right { right:30px; }
    //                     .notice__wrap_y-top { top:30px; }
    //                     .notice__wrap_y-center { top:50%; transform:translateY(-50%); }
    //                     .notice__wrap_y-bottom { bottom:30px; }
    //                     .notice__wrap_x-center.notice__wrap_y-center { transform:translate(-50%); }
    //                 .notice__close { position:absolute; top:8px; right:8px; opacity:0.3; cursor:pointer; padding:15px; background:url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTQiIGhlaWdodD0iMTQiIHZpZXdCb3g9IjAgMCAxNCAxNCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48dGl0bGU+Y2xvc2U8L3RpdGxlPjxnIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlPSIjMDAwIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0xIDFsMTIgMTJNMTMgMUwxIDEzIi8+PC9nPjwvc3ZnPg==) center center no-repeat; }
    //                     .notice__close:hover { opacity:0.7; }
    //                 .notice__icon { font-size:21px; position:absolute; top:13px; left:13px; }
    //                 .notice__body { padding:15px 45px 15px 20px; }
    //                     .notice__icon ~ .notice__body { padding-left:50px; }
    //                 .notice__title { font-size:15px; font-weight:600; margin:0 0 5px; }
    //                 .notice__btns > * { margin:10px 0 0; border:1px solid rgba(0,0,0,0.3); cursor:pointer; background:#fff; box-shadow:0 1px 4px rgba(0,0,0,.1); color:#000; padding:7px 20px; border-radius:2px; transition:0.2s; }
    //                     .notice__btns > *:hover { box-shadow:0 1px 4px rgba(0,0,0,.2); }
    //                 .notice__progress { position:absolute; bottom:0; left:0; height:5px; width:100%; background:rgba(0,0,0,0.3); }
    //                     @keyframes notice__progress_anim {0% { width:100%; } 100% { width:0%; } }
    //         `;
    //         document.head.appendChild(s);
    //     },
    //     computed: {
    //         item() { return this.items[this.items.length - 1]; }
    //     },
    //     methods: {
    //         show(text, params) {
    //             let item = Object.assign({x: 'center', y: 'top', width: 320, type: '', icon: '', text: text, title: '', buttons: {}, lifetime: 5000, canclose: true, darken: false}, params || {});
    //             this.items.push(item);
    //             if(item.lifetime > 0) item._timeout = setTimeout(() => { this.close(item); }, item.lifetime);
    //         },
    //         close(item) {
    //             if(item._timeout) clearTimeout(item._timeout);
    //             this.items.splice(this.items.indexOf(item), 1);
    //         },
    //         info(msg) { this.show(msg, {type: 'primary', icon: 'info-circle'}); },
    //         success(msg) { this.show(msg, {type: 'success', icon: 'check-circle'}); },
    //         error(msg) { this.show(msg, {type: 'error', icon: 'ban'}); },
    //         warning(msg) { this.show(msg, {type: 'warning', icon: 'exclamation-circle'}); },
    //         alert(msg, title) { this.show(msg, {x: 'center', y: 'top', title: title || location.host, lifetime: 0, buttons: {OK: () => {}}}); },
    //     }
    // });

    jQuery.fn.elapsedTime = function (selector, source, options = {}) {
        var options = jQuery.extend({
            lang: {
                years:   ['год', 'года', 'лет'],
                months:  ['месяц', 'месяца', 'месяцев'],
                days:    ['день', 'дня', 'дней'],
                hours:   ['час', 'часа', 'часов'],
                minutes: ['минута', 'минуты', 'минут'],
                seconds: ['секунда', 'секунды', 'секунд'],
                end: " назад",
                freshly: "только что",
            },
            plurar:  function(n) {
                return (n % 10 == 1 && n % 100 != 11 ? 0 : n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20) ? 1 : 2);
            },
            intervalUpdate: 1,
        }, options);
        options.intervalUpdate *= 1e3;

        var timeDifference = function(end, begin) {
            if (end < begin) {
                return false;
            }
            var difference = {
                seconds: [end.getSeconds() - begin.getSeconds(), 60],
                minutes: [end.getMinutes() - begin.getMinutes(), 60],
                hours:   [end.getHours()   - begin.getHours()  , 24],
                days:    [end.getDate()    - begin.getDate()   , new Date(begin.getYear(), begin.getMonth() + 1, 0).getDate()],
                months:  [end.getMonth()   - begin.getMonth()  , 12],
                years:   [end.getYear()    - begin.getYear()   , 0]
            };
            if(difference.years[0] != 0) {
                delete (difference.days);   
                delete (difference.hours);   
                delete (difference.minutes);
                delete (difference.seconds);
            }
            else if(difference.months[0] != 0) { 
                delete (difference.hours);  
                delete (difference.minutes); 
                delete (difference.seconds);
            }
            else if(difference.days[0] != 0) {
                delete (difference.minutes);
                delete (difference.seconds);
            }
            else if(difference.hours[0] != 0) {
                delete (difference.seconds);
            } 
            else if(difference.minutes[0] != 0) {
                delete (difference.seconds);
            }
            var result = new Array();
            var flag = false;
            for (let i in difference) {
                if (flag) {
                    difference[i][0]--;
                    flag = false;
                }     
                if (difference[i][0] < 0) {
                    flag = true;
                    difference[i][0] += difference[i][1];
                }
                if (!difference[i][0]) {
                    continue;
                }
                result.push(difference[i][0] + ' ' + options.lang[i][options.plurar(difference[i][0])]);
            }
            return result.reverse().join(' ');
        };
        var elapsedTime = function () {
            var need_to_time_update = $(selector);
            if(need_to_time_update.length > 0) {
                need_to_time_update.each(function(i) {
                    var date = need_to_time_update.eq(i).attr(source).toString().split(",");
                    if(!date[5]) {
                        date[5] = 0;
                    }
                    var s = timeDifference(
                        new Date(), 
                        new Date(
                            date[0],
                            date[1] - 1,
                            date[2],
                            date[3],
                            date[4],
                            date[5]
                        )
                    );
                    if (s.length) {
                        need_to_time_update.eq(i).html(s+options.lang.end);
                    }
                    else {
                        need_to_time_update.eq(i).html(options.lang.freshly);
                    }
                });
            }
        };

        elapsedTime();
        setInterval(elapsedTime, options.intervalUpdate);
    };

    $("body").elapsedTime(
        '.elapsedTime',
        'data-elapse_time',
        {
            lang: {
                years:   [
                    l('elt-years_0'), 
                    l('elt-years_1'), 
                    l('elt-years_2')
                ],
                months:  [
                    l('elt-months_0'), 
                    l('elt-months_1'), 
                    l('elt-months_2')
                ],
                days:    [
                    l('elt-days_0'),
                    l('elt-days_1'),
                    l('elt-days_2'),
                ],
                hours:   [
                    l('elt-hours_0'),
                    l('elt-hours_1'),
                    l('elt-hours_2'),
                ],
                minutes: [
                    l('elt-minutes_0'),
                    l('elt-minutes_1'),
                    l('elt-minutes_2'),
                ],
                seconds: [
                    l('elt-seconds_0'),
                    l('elt-seconds_1'),
                    l('elt-seconds_2'),
                ],
                end: l('elt-end'),
                freshly: l('elt-freshly'),
            }
        }
    );
})();