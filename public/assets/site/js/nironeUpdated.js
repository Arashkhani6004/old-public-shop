
//swiper brands
var swiper = new Swiper(".mySwiper-brands", {

    slidesPerView: 8,
    grabCursor: true,
    breakpoints: {
        0: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
        576: {
            slidesPerView: 4,
            spaceBetween: 15,
        },
        768: {
            slidesPerView: 5,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 6,
            spaceBetween: 15,
        },
        1200: {
            slidesPerView: 8,
            spaceBetween: 15,
        },
    },
});
//swiper dis
var swiper = new Swiper(".mySwiper-dis", {
    loop:false,
    slidesPerView: 3,
    grabCursor: true,
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        576: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        992: {
            slidesPerView: 2.5,
            spaceBetween: 10,
        },
        1200: {
            slidesPerView: 3,
            spaceBetween: 7,
        },
    },
});
//swiper pro
var swiper = new Swiper(".mySwiper-pro", {
    loop:true,
    slidesPerView: 5,
    grabCursor: true,
    breakpoints: {
        0: {
            slidesPerView: 1.5,
            spaceBetween: 7,
        },
        576: {
            slidesPerView: 2.5,
            spaceBetween: 7,
        },
        768: {
            slidesPerView: 3.5,
            spaceBetween: 7,
        },
        992: {
            slidesPerView: 4.5,
            spaceBetween: 7,
        },
        1200: {
            slidesPerView: 5,
            spaceBetween: 7,
        },
    },
});


// inputNumber
(function () {

    window.inputNumber = function (el) {

        var min = el.attr('min') || false;
        var max = el.attr('max') || false;

        var els = {};

        els.dec = el.prev();
        els.inc = el.next();

        el.each(function () {
            init($(this));
        });

        function init(el) {

            els.dec.on('click', decrement);
            els.inc.on('click', increment);

            function decrement() {
                var value = el[0].value;
                value--;
                if (!min || value >= min) {
                    el[0].value = value;
                }
            }

            function increment() {
                var value = el[0].value;
                value++;
                if (!max || value <= max) {
                    el[0].value = value++;
                }
            }
        }
    }
})();
inputNumber($('.input-number'));

// scrolled
$(function () {
    var header = $(".menu");
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 50) {
            header.addClass("scrolled");
        } else {
            header.removeClass("scrolled");
        }
    });
});

// Sidenav
function openNav() {
    document.getElementById("mySidenav").style.right = "0";
}
function closeNav() {
    document.getElementById("mySidenav").style.right = "100%";
}



// show pass
function myFunction() {
    var x = document.getElementById("number");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}



