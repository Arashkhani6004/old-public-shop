<script src="{{ asset('assets/site/js/shared/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/site/js/shared/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/site/js/shared/style.js') }}"></script>
<script src="{{ asset('assets/site/js/vue.js') }}?v={{ time() }}"></script>
<script src="{{ asset('assets/site/js/axios.min.js') }}?v={{ time() }}"></script>
<script>
    var tableList = document.querySelectorAll('.description table');
    tableList.forEach((item) => {
        item.className = "table table-striped mx-auto table-bordered";
        item.outerHTML = `<div class="table-responsive">${item.outerHTML}</div>`
    })
</script>

@include('layouts.site.blocks.vue')
@yield('scripts')