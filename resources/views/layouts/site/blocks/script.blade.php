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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var descElem2 = document.getElementById('about-footer');
        var btn2 = document.getElementById('show-more-btn-footer');
        var limitRem2 = 4;
        var limitPx2 = limitRem2 * parseFloat(getComputedStyle(document.documentElement).fontSize);
        if (descElem2.scrollHeight > limitPx2) {
            btn2.classList.remove('d-none');
            descElem2.classList.add("about-footer")
            btn2.addEventListener('click', function() {
                btn2.style.display = 'none';
            });
        }
    });
</script>
@include('layouts.site.blocks.vue')
@yield('scripts')
