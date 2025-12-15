var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next-1",
        prevEl: ".swiper-button-prev-1",
    },
    breakpoints: {
        0: {
            slidesPerView: 1.5,
            spaceBetween: 10,
            navigation: false, 
        },
        576: {
            slidesPerView: 1.5,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next-1",
                prevEl: ".swiper-button-prev-1",
            },
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 18,
            navigation: {
                nextEl: ".swiper-button-next-1",
                prevEl: ".swiper-button-prev-1",
            },
        },
        992: {
            slidesPerView: 3,
            spaceBetween: 18,
            navigation: {
                nextEl: ".swiper-button-next-1",
                prevEl: ".swiper-button-prev-1",
            },
        },
        1200: {
            slidesPerView: 4,
            spaceBetween: 18,
            navigation: {
                nextEl: ".swiper-button-next-1",
                prevEl: ".swiper-button-prev-1",
            },
        },
        1400: {
            slidesPerView: 5,
            spaceBetween: 18,
            navigation: {
                nextEl: ".swiper-button-next-1",
                prevEl: ".swiper-button-prev-1",
            },
        },
    },
});

// Optional: Hide navigation buttons with CSS for < 768px
function updateSwiperNavVisibility() {
    const navNext = document.querySelector(".swiper-button-next-1");
    const navPrev = document.querySelector(".swiper-button-prev-1");
    if (window.innerWidth < 768) {
        navNext && (navNext.style.display = "none");
        navPrev && (navPrev.style.display = "none");
    } else {
        navNext && (navNext.style.display = "");
        navPrev && (navPrev.style.display = "");
    }
}
window.addEventListener("resize", updateSwiperNavVisibility);
updateSwiperNavVisibility();
var swiper = new Swiper(".mySwiper-discounted", {
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next-2",
        prevEl: ".swiper-button-prev-2",
    },
    breakpoints: {
        0: {
            slidesPerView: 1.5,
            spaceBetween: 10,
        },
        576: {
            slidesPerView: 1.5,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 18,
        },
        992: {
            slidesPerView: 3,
            spaceBetween: 18,
        },
        1200: {
            slidesPerView: 4,
            spaceBetween: 18,
        },
        1400: {
            slidesPerView: 5,
            spaceBetween: 18,
        },
    },
});
var swiper = new Swiper(".mySwiper-sale", {
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next-3",
        prevEl: ".swiper-button-prev-3",
    },
    breakpoints: {
        0: {
            slidesPerView: 1.5,
            spaceBetween: 10,
        },
        576: {
            slidesPerView: 2.5,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 18,
        },
        992: {
            slidesPerView: 4,
            spaceBetween: 18,
        },
        1200: {
            slidesPerView: 5,
            spaceBetween: 18,
        },
        1400: {
            slidesPerView: 6.25,
            spaceBetween: 18,
        },
    },
});
var swiper = new Swiper(".mySwiper-new", {
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next-4",
        prevEl: ".swiper-button-prev-4",
    },
    breakpoints: {
        0: {
            slidesPerView: 1.5,
            spaceBetween: 10,
        },
        576: {
            slidesPerView: 2.5,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 18,
        },
        992: {
            slidesPerView: 4,
            spaceBetween: 18,
        },
        1200: {
            slidesPerView: 5,
            spaceBetween: 18,
        },
        1400: {
            slidesPerView: 6.25,
            spaceBetween: 18,
        },
    },
});
var swiper = new Swiper(".mySwiper-brands", {
    slidesPerView: 3,
    grid: {
        rows: 2,
    },
    spaceBetween: 30,
    navigation: {
        nextEl: ".swiper-button-next-5",
        prevEl: ".swiper-button-prev-5",
    },
    breakpoints: {
        0: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        576: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        992: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
        1200: {
            slidesPerView: 5,
            spaceBetween: 15,
        },
        1400: {
            slidesPerView: 5,
            spaceBetween: 15,
        },
    },
});
var swiper = new Swiper(".mySwiper-popular", {
    slidesPerView: 3,
    grid: {
        rows: 2,
    },
    spaceBetween: 30,
    navigation: {
        nextEl: ".swiper-button-next-6",
        prevEl: ".swiper-button-prev-6",
    },
    breakpoints: {
        0: {
            slidesPerView: 1.15,
            spaceBetween: 10,
        },
        576: {
            slidesPerView: 1.5,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        992: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
        1200: {
            slidesPerView: 4,
            spaceBetween: 15,
        },
        1400: {
            slidesPerView: 4,
            spaceBetween: 15,
        },
    },
});
var swiper = new Swiper(".mySwiper-blogs", {
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next-7",
        prevEl: ".swiper-button-prev-7",
    },
    breakpoints: {
        0: {
            slidesPerView: 1.25,
            spaceBetween: 8,
        },
        576: {
            slidesPerView: 1.75,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 2.5,
            spaceBetween: 15,
        },
        1200: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
        1400: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
    },
});
