// owl carousel best

let imgList
addEventListener('load', function(){
imgList = document.querySelectorAll('.esclet-img-box');
})
addEventListener('scroll' , () => scrollPro(imgList),{once:true})
function scrollPro(list){
list.forEach(item => {
item.outerHTML = `<img src="${item.getAttribute('src')}" alt="${item.getAttribute('alt')}" class="${item.getAttribute('imgclass')}" />`;
imgList = document.querySelectorAll('.esclet-img-box');
})
}


$(document).ready(function () {
	var owl = $(".owl-carousel-best");
	owl.owlCarousel({
		autoplayHoverPause: true,
		responsiveClass: true,
		autoplay: true,
		loop: true,
		nav: false,
		dots: false,
		rtl: true,
		margin: 7,
		responsive: {
			0: {
				items: 1.5,
			},
			576: {
				items: 2.5,
			},
			768: {
				items: 3.5,
			},
			1200: {
				items: 4.5,
			},
			1400: {
				items: 5,
			},
		},
	});
	$(".play").on("click", function () {
		owl.trigger("play.owl.autoplay", [250]);
	});
	$(".stop").on("click", function () {
		owl.trigger("stop.owl.autoplay");
	});
});
// owl carousel brand
$(document).ready(function () {
	var owl = $(".owl-carousel-brand");
	owl.owlCarousel({
		autoplayHoverPause: true,
		responsiveClass: true,
		autoplay: true,
		loop: true,
		nav: false,
		dots: false,
		rtl: true,
		margin: 7,
		responsive: {
			0: {
				items: 4,
			},
			576: {
				items: 5,
			},
			768: {
				items: 6,
			},
			1200: {
				items: 7,
			},
			1400: {
				items: 8,
			},
		},
	});
	$(".play").on("click", function () {
		owl.trigger("play.owl.autoplay", [250]);
	});
	$(".stop").on("click", function () {
		owl.trigger("stop.owl.autoplay");
	});
});

// owl carousel dis
$(document).ready(function () {
	var owl = $(".owl-carousel-dis");
	owl.owlCarousel({
		autoplayHoverPause: true,
		responsiveClass: true,
		autoplay: true,
		loop: false,
		nav: false,
		dots: false,
		rtl: true,
		margin: 7,
		responsive: {
			0: {
				items: 1,
			},
			576: {
				items: 2,
			},
			768: {
				items: 2.5,
			},
			1200: {
				items: 3,
			},
			1400: {
				items: 3,
			},
		},
	});
	$(".play").on("click", function () {
		owl.trigger("play.owl.autoplay", [250]);
	});
	$(".stop").on("click", function () {
		owl.trigger("stop.owl.autoplay");
	});
});

// owl carousel dis
$(document).ready(function () {
	var owl = $(".owl-carousel-zoom");
	owl.owlCarousel({
		autoplayHoverPause: true,
		responsiveClass: true,
		autoplay: false,
		loop: false,
		nav: true,
		dots: false,
		rtl: true,
		responsive: {
			0: {
				items: 5,
				margin: 1,
			},
			576: {
				items: 5,
				margin: 2,
			},
			768: {
				items: 5,
				margin: 3,
			},
			1200: {
				items: 5,
				margin: 4,
			},
			1400: {
				items: 5,
				margin: 5,
			},
		},
	});
	$(".play").on("click", function () {
		owl.trigger("play.owl.autoplay", [250]);
	});
	$(".stop").on("click", function () {
		owl.trigger("stop.owl.autoplay");
	});
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

// price range
(function ($) {
	$('#price-range-submit').hide();
	$("#min_price,#max_price").on('change', function () {
		$('#price-range-submit').show();
		var min_price_range = parseInt($("#min_price").val());
		var max_price_range = parseInt($("#max_price").val());
		if (min_price_range > max_price_range) {
			$('#max_price').val(min_price_range);
		}
		$("#slider-range").slider({
			values: [min_price_range, max_price_range]
		});
	});
	$("#min_price,#max_price").on("paste keyup", function () {
		$('#price-range-submit').show();
		var min_price_range = parseInt($("#min_price").val());
		var max_price_range = parseInt($("#max_price").val());
		if (min_price_range == max_price_range) {
			max_price_range = min_price_range + 100;
			$("#min_price").val(min_price_range);
			$("#max_price").val(max_price_range);
		}
		$("#slider-range").slider({
			values: [min_price_range, max_price_range]
		});
	});
	$(function () {
		$("#slider-range").slider({
			range: true,
			orientation: "horizontal",
			min: 0,
			max: 10000000,
			values: [0, 10000000],
			step: 100,
			slide: function (event, ui) {
				if (ui.values[0] == ui.values[1]) {
					return false;
				}
				$("#min_price").val(ui.values[0]);
				$("#max_price").val(ui.values[1]);
			}
		});
		$("#min_price").val($("#slider-range").slider("values", 0));
		$("#max_price").val($("#slider-range").slider("values", 1));
	});
	$("#slider-range,#price-range-submit").click(function () {
		var min_price = $('#min_price').val();
		var max_price = $('#max_price').val();
		$("#searchResults").text("Here List of products will be shown which are cost between " + min_price + " " + "and" + " " + max_price + ".");
	});
})(jQuery);

// price range
(function ($) {
	$('#price-range-submit').hide();
	$("#min_price_xs,#max_price_xs").on('change', function () {
		$('#price-range-submit').show();
		var min_price_xs_range = parseInt($("#min_price_xs").val());
		var max_price_xs_range = parseInt($("#max_price_xs").val());
		if (min_price_xs_range > max_price_xs_range) {
			$('#max_price_xs').val(min_price_xs_range);
		}
		$("#slider-range-xs").slider({
			values: [min_price_xs_range, max_price_xs_range]
		});
	});
	$("#min_price_xs,#max_price_xs").on("paste keyup", function () {
		$('#price-range-submit').show();
		var min_price_xs_range = parseInt($("#min_price_xs").val());
		var max_price_xs_range = parseInt($("#max_price_xs").val());
		if (min_price_xs_range == max_price_xs_range) {
			max_price_xs_range = min_price_xs_range + 100;
			$("#min_price_xs").val(min_price_xs_range);
			$("#max_price_xs").val(max_price_xs_range);
		}
		$("#slider-range-xs").slider({
			values: [min_price_xs_range, max_price_xs_range]
		});
	});
	$(function () {
		$("#slider-range-xs").slider({
			range: true,
			orientation: "horizontal",
			min: 0,
			max: 10000000,
			values: [0, 10000000],
			step: 100,
			slide: function (event, ui) {
				if (ui.values[0] == ui.values[1]) {
					return false;
				}
				$("#min_price_xs").val(ui.values[0]);
				$("#max_price_xs").val(ui.values[1]);
			}
		});
		$("#min_price_xs").val($("#slider-range-xs").slider("values", 0));
		$("#max_price_xs").val($("#slider-range-xs").slider("values", 1));
	});
	$("#slider-range-xs,#price-range-submit").click(function () {
		var min_price_xs = $('#min_price_xs').val();
		var max_price_xs = $('#max_price_xs').val();
		$("#searchResults").text("Here List of products will be shown which are cost between " + min_price_xs + " " + "and" + " " + max_price_xs + ".");
	});
})(jQuery);

// search
var sp = document.querySelector('.search-open');
var searchbar = document.querySelector('.search-inline');
var shclose = document.querySelector('.search-close');
function changeClass() {
	searchbar.classList.add('search-visible');
}
function closesearch() {
	searchbar.classList.remove('search-visible');
}
sp.addEventListener('click', changeClass);
shclose.addEventListener('click', closesearch);

// uploader


// show pass
function myFunction() {
	var x = document.getElementById("number");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
}
