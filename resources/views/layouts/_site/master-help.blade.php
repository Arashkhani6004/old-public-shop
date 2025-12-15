<!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('layouts.site.blocks-help.head')

<body>

<div>
@include('layouts.site.blocks-help.menu')

<!-- start content -->
@yield('content')
<!-- end content -->

    @include('layouts.site.blocks-help.footer')
</div>
@include('layouts.site.blocks-help.script')
<div class="whatsapp-fix"><a href="whatsapp://send?phone=" class="text-white">
        <i class="bi bi-whatsapp d-flex fs-2"></i>
    </a></div>
</body>

</html>
