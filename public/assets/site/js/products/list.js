if (document.querySelector(".swiper-categories")) {
    var swiper = new Swiper(".swiper-categories", {
        spaceBetween: 30,
        slidesPerView: 4,
        grabCursor: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 3.5,
                spaceBetween: 10,
            },
            576: {
                slidesPerView: 4.5,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 6.5,
                spaceBetween: 15,
            },
            992: {
                slidesPerView: 7.5,
                spaceBetween: 15,
            },
            1200: {
                slidesPerView: 8.5,
                spaceBetween: 15,
            },
            1400: {
                slidesPerView: 9.5,
                spaceBetween: 15,
            },
            1600: {
                slidesPerView: 10.5,
                spaceBetween: 15,
            },
        },
    });
}
document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = Array.from(document.querySelectorAll(".colorInput"));


    function isDark(color) {
        const rgb = color.match(/\d+/g);
        const brightness = (0.299 * rgb[0]) + (0.587 * rgb[1]) + (0.114 * rgb[2]);
        return brightness < 128; 
    }

    checkboxes.forEach(checkbox => {
        const label = checkbox.nextElementSibling; 
        if (label && label.classList.contains("colorLabel")) {
            const bgColor = window.getComputedStyle(label).backgroundColor; 

            if (isDark(bgColor)) {
                checkbox.classList.add("black-filter"); 
            }
        }
    });
});
