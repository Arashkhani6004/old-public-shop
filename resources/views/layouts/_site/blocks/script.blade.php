@yield('js')
<script src="{{asset('assets/site/js/bootstrap.bundle.min.js')}}?v={{time()}}" async></script>
<script src="{{asset('assets/site/js/popper.min.js')}}?v={{time()}}" async></script>
@if(Request::segment(1) == 'pro')
    <script src="{{asset('assets/site/js/zoom/magiczoomplus.min.js')}}?v={{time()}}" async></script>
    <script src="{{asset('assets/site/js/zoom/zoom.min.js')}}?v={{time()}}" async></script>
@endif
@if(Request::segment(1) == 'pro' || Request::segment(1) == 'search')
    <script src="{{asset('assets/site/js/lottie-player.min.js')}}?v={{time()}}" async></script>
@endif
<script src="{{asset('assets/site/js/nironeUpdated.min.js')}}?v={{time()}}" async></script>
<script src="{{asset('assets/site/js/vue.js')}}?v={{time()}}"></script>
<script src="{{asset('assets/site/js/axios.min.js')}}?v={{time()}}"></script>
<script>
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
</script>
<script>
    function handelMega(id) {
        const mega = document.getElementById(`mega${id}`).getBoundingClientRect().height;
        if (mega == 400) {
            document.getElementById(`but${id}`).classList.remove("d-none")
        }
    }
</script>

<script>
    let tableList = document.querySelectorAll('.description table');
tableList.forEach((item) => {
    item.className = "table table-striped mx-auto table-bordered";
  item.outerHTML = `<div class="table-responsive">${item.outerHTML}</div>`
})
</script>
<script>
var mzOptions = {
 textExpandHint: "برای بزرگنمایی کلیک کنید",
 textHoverZoomHint: "",
 zoomMode: "magnifier",
 zoomWidth: 200,
 zoomHeight: 200,
 transitionEffect: false,
};
</script>
@include('layouts.site.blocks.vue')
