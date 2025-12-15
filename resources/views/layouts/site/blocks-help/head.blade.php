<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#d70a83" />
    <link rel="shortcut icon" href="" type="image/x-icon">
    <title>
        Help Site
    </title>

    <meta name="robots" content="noindex , nofollow" />



    <meta name="description" content="" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta property="og:site_name" content="" />
    <meta property="og:title" content="">
    <meta property="og:description" content="" />
    <meta property="og:locale" content="fa_ir" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="" />
    <meta property="og:type" content="article" />
    <meta property="og:type" content="website" />
    <meta name="title" content="">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/shared/bootstrap.rtl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/site/css/shared/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/site/css/shared/public.css?v0.10') }}" />

    <script src="{{ asset('assets/site/js/sweetalert.min.js') }}?v={{ time() }}" async></script>
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
    {{-- <script src="{{ asset('assets/site/js/owlcarousel/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/site/js/sweetalert.min.js') }}" async></script> --}}
</head>
