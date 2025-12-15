var mzOptions = {
    textExpandHint: "برای بزرگنمایی کلیک کنید",
    textHoverZoomHint: "",
    zoomMode: "magnifier",
    zoomWidth: 200,
    zoomHeight: 200,
    transitionEffect: false,
};

var swiper = new Swiper(".swiper-selector", {
    spaceBetween: 30,
    slidesPerView: 4,
    grabCursor: true,
    autoplay: {
      delay: 1500,
      disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    breakpoints: {
      0: {
        slidesPerView: 4,
        spaceBetween: 10,
      },
      576: {
        slidesPerView: 4.5,
        spaceBetween: 15,
      },
      768: {
        slidesPerView: 8,
        spaceBetween: 10,
      },
      992: {
        slidesPerView: 4,
        spaceBetween: 10,
      },
      1200: {
        slidesPerView: 4,
        spaceBetween: 10,
      },
      1400: {
        slidesPerView: 3.75,
        spaceBetween: 10,
      },
      1600: {
        slidesPerView: 4.5,
        spaceBetween: 10,
      },
    },
  });
  var swiper = new Swiper(".swiper-team", {
    spaceBetween: 30,
    slidesPerView: 5.75,
    grabCursor: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    breakpoints: {
      0: {
        slidesPerView: 1.25,
        spaceBetween: 10,
      },
      576: {
        slidesPerView: 2.75,
        spaceBetween: 15,
      },
      768: {
        slidesPerView: 3.75,
        spaceBetween: 30,
      },
      992: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
      1200: {
        slidesPerView: 4.75,
        spaceBetween: 30,
      },
      1400: {
        slidesPerView: 5,
        spaceBetween: 30,
      },
      1600: {
        slidesPerView: 5.75,
        spaceBetween: 30,
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
        spaceBetween:18,
      },
    },
  });

  function increaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
  }
  
  function decreaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value < 1 ? value = 1 : '';
    value--;
    document.getElementById('number').value = value;
  }


  const menuLinks = document.querySelectorAll('.product-tabs-menu a');
  const sections = Array.from(menuLinks).map(link => document.querySelector(link.getAttribute('href')));

  function setActiveLink() {
    const scrollPos = window.scrollY || window.pageYOffset;
    let selectedIndex = 0;

    sections.forEach((section, index) => {
      const sectionTop = section.offsetTop - 80;
      if (scrollPos >= sectionTop) {
        selectedIndex = index;
      }
    });

    menuLinks.forEach((link, idx) => {
      if (idx === selectedIndex) {
        link.classList.add('active');
      } else {
        link.classList.remove('active');
      }
    });
  }

  window.addEventListener('scroll', setActiveLink);


  menuLinks.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      const target = document.querySelector(link.getAttribute('href'));
      window.scrollTo({
        top: target.offsetTop - 75, 
        behavior: 'smooth'
      });
    });
  });

  setActiveLink();