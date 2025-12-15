<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <title>
        @yield('title', '')( 💻 پنل ادمین {{ str_replace('.', '.', request()->getHost()) }} )
    </title>
    <meta name="robots" content="@yield('robots', 'noindex', 'nofollow')" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/libs/css/bootstrap-icons.css') }}">
    {{-- <link rel="stylesheet" href="{{asset('assets/admin/vendor/bootstrap/css/bootstrap.rtl.min.css')}}?v={{time()}}"> --}}
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.rtl.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/circular-std/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/libs/css/style.css') }}?v={{ time() }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/fonts/fontawesome/css/fontawesome-all.css') }}?v={{ time() }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/charts/chartist-bundle/chartist.css') }}?v={{ time() }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/charts/morris-bundle/morris.css') }}?v={{ time() }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/charts/c3charts/c3.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.0.0/cropper.min.css" /> --}}
    {{--    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --> --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/libs/css/w3.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/date/bootstrap-datepicker.min.css') }}?v={{ time() }}">
    <style>
        .image_container {
            max-width: 100%;
            max-height: 450px;
        }

        #cropped_result img {
            width: 100%;
        }
    </style>
    <!-- Date Picker
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datepicker/datepicker3.css') }}?v={{ time() }}">

    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker-bs3.css') }}?v={{ time() }}">
 -->
    <!-- JS -->
    <script src="{{ asset('assets/admin/libs/js/vue.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/s/axios.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/js/sweetalert.min.js') }}}"></script>
    <script src="{{ asset('assets/admin/js/image-load.js') }}?v={{ time() }}"></script>


</head>

@yield('css')
