window.addEventListener('DOMContentLoaded', function () {
    var el, val, res, status;
    var a,b,c,d,e;

    // Покупка уровней
    $('.matrix-icon_cart__big, .user-matrix_cart').click(function () {
        let price  = $(this).data('matrix_price');
        let matrix = $(this).data('matrix');
        let level  = $(this).data('level');
        
        if(config.permissions.buyLevel == '0') {
            $.fancybox.open(
                $('.require-auth'),
                {
                    touch: false,
                    mobile: {
                        touch: {
                            vertical: true,
                            momentum: true
                        }
                    }
                }
            );
            return false;
        }
        if(confirm(l('buyLevel'))) {
            buyLevel(matrix, level, price)
        }
    })

    // Реавторизация
    $('#reauth').click(function (e) {
        if(config.haveWallet) {
            e.preventDefault();
        }
        getWeb3(function(web3) {
            MatrixInstance.isUserExists(web3.eth.coinbase, function (err, isUserExists) {
                if(err) {
                    Notice.error(
                        l('errorReadSmartContract')
                    );
                    return false;
                }
                if(!isUserExists) {
                    Notice.warning(
                        l('userNotExists')
                    );
                    return false;
                }
                rememberSession(
                    web3.eth.coinbase,
                    function (err, result) {
                        if(!err) {
                            return false;
                        }
                        setTimeout(function () {
                            if(result.redirect) {
                                window.location.href = result.redirect;
                            } else {
                                window.location.href = '/';
                            }
                        }, 2500);
                    }
                );
            });
        });
    });

    $('[data-fancybox]').fancybox({
        touch: false,
        mobile: {
            touch: {
                vertical: true,
                momentum: true
            }
        }
    });

    // Навигация по реинвестам
    el = document.querySelector('#changeCurrentReinvest');
    if(el) {
        el.onchange = function (e) {
            let i = this.value;
            let link = window.location.pathname;
            if(i >= 0) {
                link += $_GET({reinvest: i}, true);
            }
            window.location = link;
        }
    }

    // Замаскировать ID юзера, слева в разделе
    $('.status-panel__user-id').click(function () {
        // Запомнить выбор значения в хранилище
        status = storageTrigger(
            'user.id',
            true
        );
        // Скрыть, показать партнерскую ссылку
        el = $('.trigger_value__user-refkey');
        res = '';
        if(status == '1') {
            res = config.site.protocol + config.site.domain + `/i/***/`;
        } else {
            res = el.attr('title')
        }
        el.find('input').val(res);
    });
});