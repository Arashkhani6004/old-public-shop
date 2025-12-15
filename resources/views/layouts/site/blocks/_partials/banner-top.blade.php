@php
    $hasDesktopImage = !empty($setting_header->modal_img);
    $hasMobileImage = !empty($setting_header->modal_mobile_img);
@endphp

@if ($hasDesktopImage || ($hasMobileImage && App\Library\Helper::isMobile()))
<section class="banner">
    @if ($hasDesktopImage)
        <img class="img w-100 d-none d-lg-block"
            src="{{ asset('assets/uploads/content/set/' . $setting_header->modal_img) }}">
    @endif

    @if ($hasMobileImage && App\Library\Helper::isMobile())
        <!-- size mobile:700*950 -->
        <img class="img w-100 d-block d-lg-none"
            src="{{ asset('assets/uploads/content/set/' . $setting_header->modal_mobile_img) }}">
    @endif
</section>
@endif