if ($(document).width() > 1175) {
    $('.section').addClass('will-animate');
}
$('.heading').addClass('will-animate');
document.addEventListener('DOMContentLoaded', function () {
   
    
    // Ролик в шапке
    $('.marketing-video .list-lang > a').click(function () {
        let el = $('.marketing-video');
        let lang = $(this).data('lang');
        let video = $(this).data('video_key');
        let copy = el.find('.block-copy .link > a');

        $('.marketing-video .list-lang > a').removeClass('active');
        $(this).addClass('active');

        el.find('[data-video_lang]').removeClass('active').addClass('noactive');
        el.find('[data-video_lang="' + lang + '"]').removeClass('noactive').addClass('active');

        copy.html('https://youtu.be/' + video);
    });
    $('.marketing-video .block-copy .copy').click(function () {
        window.copyText($('.marketing-video .block-copy .link > a').text())
    });
    $('.marketing-video .block-copy .link > a').click(function (e) {
        window.copyText($(this).text())
        e.preventDefault();
        return false;
    });
    $('.marketing-video__button').click(function () {
       
        
        // Init modal
        $.fancybox.open(
            $('#marketing-video'), {
                touch: false,
                mobile: {
                    touch: {
                        vertical: true,
                        momentum: true
                    }
                }
            }
        );
    });

    // $('.modal').modal();

    // body onload animation
    window.addEventListener('load', function () {
        setTimeout(function () {
            document.querySelector('body').classList.add('loaded');
        }, 1500);
    });
    
    
    // fullpage slider
    if ($(window).width() > 11175) {
        var k = 2;
        new fullpage('.wrapper', {
            autoScrolling: false,
            navigation: false,
            navigationPosition: 'false',
            scrollOverflow: false,
            verticalCentered: false,
            licenseKey: '16F2C723-92754D84-825481FF-A7C6C7CC',
            onLeave: (origin, destination, direction) => {
                if (origin.index != 2) {
                    $('.carousel').carousel('next');
                }
                const section = destination.item;
                section.classList.add('preanimated');
                section.classList.add('animated');
                if (destination.index === 4) {
                    $('.accordion-heading').on('click', function () {
                        setTimeout(function () {
                            fullpage_api.reBuild();
                        }, 500);
                    });
                }
            },
        });
        $(window).resize(function () {
            fullpage_api.reBuild();
        });
    }
    
    
    // lang choosing
    if (document.querySelector('.header-lang')) {
        const langs = document.querySelectorAll('.header-lang__option');
        langs.forEach(lang => {
            lang.addEventListener('click', function () {
                const parent = document.querySelector('.header-lang');
                parent.classList.toggle('opened');
                langs.forEach(item => {
                    item.classList.remove('current');
                });
                lang.classList.add('current');
            });
        });
    }
    
    
    // advantage height set
    if (document.querySelector('.advantage') && $(window).width() > 1440) {
        var advantagess = document.querySelectorAll('.advantage');
        var minHeight = 0;
        advantagess.forEach(item => {
            if (item.clientHeight > minHeight) {
                minHeight = item.clientHeight;
            }
        });
        advantagess.forEach(item => {
            item.style.minHeight = minHeight + 'px';
        });
    }
    
    
    // carousel
    if (document.querySelector('.carousel')) {
        var elems = document.querySelectorAll('.carousel');
        var optionsDesktop = {
            duration: 200,
            dist: -40,
            shift: -60,
            numVisible: 5,
            onCycleTo: function () {
                $('.carousel-item').removeClass('dark darken');
                var index = $('.carousel-item.active').index();
                $('.dot').removeClass('current');
                $('.dot').eq(index).addClass('current');
                var carouselLen = $('.carousel-item').length;
                var currentSlide = $('.carousel-item.active').index();
                console.log(carouselLen);
                if (currentSlide == 0) {
                    $('.carousel-item').eq(carouselLen - 1).addClass('dark');
                    $('.carousel-item').eq(carouselLen - 2).addClass('darken');
                    $('.carousel-item').eq(1).addClass('dark');
                    $('.carousel-item').eq(2).addClass('darken');
                } else if (currentSlide == 1) {
                    $('.carousel-item').eq(0).addClass('dark');
                    $('.carousel-item').eq(2).addClass('dark');
                    $('.carousel-item').eq(3).addClass('darken');
                    $('.carousel-item').eq(carouselLen - 1).addClass('darken');
                } else if (currentSlide == carouselLen - 1) {
                    $('.carousel-item').eq(0).addClass('dark');
                    $('.carousel-item').eq(1).addClass('darken');
                    $('.carousel-item').eq(carouselLen - 2).addClass('dark');
                    $('.carousel-item').eq(carouselLen - 3).addClass('darken');
                } else if (currentSlide == carouselLen - 2) {
                    $('.carousel-item').eq(carouselLen - 1).addClass('dark');
                    $('.carousel-item').eq(0).addClass('darken');
                    $('.carousel-item').eq(currentSlide - 1).addClass('dark');
                    $('.carousel-item').eq(currentSlide - 2).addClass('darken');
                } else {
                    $('.carousel-item').eq(currentSlide + 1).addClass('dark');
                    $('.carousel-item').eq(currentSlide + 2).addClass('darken');
                    $('.carousel-item').eq(currentSlide - 1).addClass('dark');
                    $('.carousel-item').eq(currentSlide - 2).addClass('darken');
                }
            },
        };
        var optionsMobile = {
            duration: 200,
            dist: -20,
            shift: -240,
            numVisible: 5,
            onCycleTo: function () {
                $('.carousel-item').removeClass('dark darken');
                var index = $('.carousel-item.active').index();
                $('.dot').removeClass('current');
                $('.dot').eq(index).addClass('current');
                var carouselLen = $('.carousel-item').length;
                var currentSlide = $('.carousel-item.active').index();
                console.log(carouselLen);
                if (currentSlide == 0) {
                    $('.carousel-item').eq(carouselLen - 1).addClass('dark');
                    $('.carousel-item').eq(carouselLen - 2).addClass('darken');
                    $('.carousel-item').eq(1).addClass('dark');
                    $('.carousel-item').eq(2).addClass('darken');
                } else if (currentSlide == 1) {
                    $('.carousel-item').eq(0).addClass('dark');
                    $('.carousel-item').eq(2).addClass('dark');
                    $('.carousel-item').eq(3).addClass('darken');
                    $('.carousel-item').eq(carouselLen - 1).addClass('darken');
                } else if (currentSlide == carouselLen - 1) {
                    $('.carousel-item').eq(0).addClass('dark');
                    $('.carousel-item').eq(1).addClass('darken');
                    $('.carousel-item').eq(carouselLen - 2).addClass('dark');
                    $('.carousel-item').eq(carouselLen - 3).addClass('darken');
                } else if (currentSlide == carouselLen - 2) {
                    $('.carousel-item').eq(carouselLen - 1).addClass('dark');
                    $('.carousel-item').eq(0).addClass('darken');
                    $('.carousel-item').eq(currentSlide - 1).addClass('dark');
                    $('.carousel-item').eq(currentSlide - 2).addClass('darken');
                } else {
                    $('.carousel-item').eq(currentSlide + 1).addClass('dark');
                    $('.carousel-item').eq(currentSlide + 2).addClass('darken');
                    $('.carousel-item').eq(currentSlide - 1).addClass('dark');
                    $('.carousel-item').eq(currentSlide - 2).addClass('darken');
                }
            },
        };
        if ($(window).width() > 560) {
            var instances = M.Carousel.init(elems, optionsDesktop);
        } else {
            var instances = M.Carousel.init(elems, optionsMobile);
        }
        document.querySelector('.carousel-nav__prev').addEventListener('click', function () {
            $('.carousel').carousel('prev');
        });
        document.querySelector('.carousel-nav__next').addEventListener('click', function () {
            $('.carousel').carousel('next');
        });
        
        
        // dots system
        const carouselLen = document.querySelectorAll('.carousel-item').length;
        const dotsContainer = document.querySelector('.carousel-nav-dots');
        for (let i = 0; i < carouselLen; i++) {
            dotsContainer.innerHTML += '<span class="dot"></span>';
        }
        $('.dot').eq(0).addClass('current');
        $('.dot').on('click', function () {
            var index = $(this).index();
            $('.dot').removeClass('current');
            $('.carousel').carousel('set', index);
            $(this).addClass('current');
        });
    }
    
    
    // accordion
    if (document.querySelector('.faqq')) {
        ! function (i) {
            var o, n;
            i(".accordion-heading").on("click", function () {
                o = i(this).parents(".accordion"), n = o.find(".accordion-content"),
                    o.hasClass("active") ? (o.removeClass("active"),
                        n.slideUp()) : (o.addClass("active"), n.stop(!0, !0).slideDown(),
                        o.siblings(".active").removeClass("active").children(".accordion-content").stop(!0, !0).slideUp());
            })
        }(jQuery);
    }
    
    
    // system message
    console.log('Page loaded. v1.0.0');
    $('.carousel').carousel('next');
});