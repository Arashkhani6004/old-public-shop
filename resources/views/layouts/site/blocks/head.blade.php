<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- favicon --}}
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/uploads/content/set/' . @$setting_header->favicon) }}" />
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('assets/uploads/content/set/' . @$setting_header->favicon) }}" />
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('assets/uploads/content/set/' . @$setting_header->favicon) }}" />
    <link rel="manifest" href="{{ asset('assets/site/favicon/site.webmanifest') }}" />


    {{-- title --}}
    <title>
        @yield('title', @$setting_header->title)
    </title>


    {{-- meta tags --}}
    @if (@$setting_header->noindex == 1)
        <meta name="robots" content="@yield('robots', 'noindex,nofollow')" />
    @else
        @if ($setting_header->park_domains !== null && in_array(request()->getHttpHost(), $setting_header->park_domains))
            <meta name="robots" content="@yield('robots', 'noindex,nofollow')" />
        @else
            <meta name="robots" content="@yield('robots', 'index,follow')" />
        @endif
    @endif

    @if ($setting_header->head_enamd != null)
        <meta name="enamad" content="{{ @$setting_header->head_enamd }}" />
    @endif

    <meta name="description" content="@yield('description', @$setting_header->description_seo)" />
    <link rel="canonical" href="@yield('canonical', url()->current())" />
    <meta property="og:site_name" content="@yield('title', @$setting_header->title)" />
    <meta property="og:title" content="@yield('title', @$setting_header->title)">
    <meta property="og:description" content="@yield('description', @$setting_header->description_seo)" />
    <meta property="og:locale" content="fa_ir" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="@yield('image_seo', asset('assets/uploads/content/set/' . @$setting_header->logo))" />
    <meta name="title" content="@yield('title', @$setting_header->title)">
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <link rel="alternate" hreflang="fa-IR" href="{{ url()->current() }}" />
    @yield('torob')


    {{-- styles --}}
    <link rel="stylesheet" href="{{ asset('assets/site/css/shared/bootstrap.rtl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/site/css/shared/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/site/css/shared/public.css?v0.12') }}" />

    <script src="{{asset('assets/site/js/sweetalert.min.js')}}?v={{time()}}" async></script>
    @yield('styles')

    <style>
        :root {
            --primary-color: #d4a373;
            --secondary-color: #ccd5ae;
            --primary-light-color: #f2d5b8;
            --secondary-light-color: #d0cfbb;
            --body-color: #fffdf0;
            --text-primary: #ffffff;
            --text-secondary: #1a1a1a;
        }

        [v-cloak] {
            display: none
        }
    </style>

    {{-- analytics --}}
    {!! @$setting_header->analytics !!}

    {{-- tag manager --}}
    {!! @$setting_header->tagmanager !!}

</head>

