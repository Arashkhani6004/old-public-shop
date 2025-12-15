@extends('layouts.site.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/products/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/site/css/products/list.css?v0.03') }}" />
    <script src="{{ asset('assets/site/js/products/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/products/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/products/jquery.ui.touch-punch.min.js') }}"></script>
@stop

@section('content')
    <section class="header-inner mt-lg-5 mt-4">
        <div class="container">
            <div class="title ">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <h1 class="m-0 fm-eb">
                        محصولات
                    </h1>
                </div>
                <nav aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="d-flex align-items-center color-title font-re">
                                <i class="bi bi-house d-flex me-1"></i>
                                خانه
                            </a>
                        </li>
                        <li class="breadcrumb-item active color-title" aria-current="page">
                            محصولات
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="list-product mt-4">
        <div class="container">
            {{-- @include('site.all-product-list._partials.upper-categories') --}}
            @include('site.all-product-list._partials.price-desktop-script')
            @include('site.all-product-list._partials.price-mobile-script')
            <div class="row w-100 m-0 mt-4">
                @if (!App\Library\Helper::isMobile())
                    @include('site.all-product-list._partials.desktop-filter')
                @else
                    @include('site.all-product-list._partials.mobile-filter')
                @endif
                <!-- list -->
                <div class="col-xl-9 col-lg-8 p-lg-2 p-1">
                    @include('site.all-product-list._partials.sort')
                    @include('site.all-product-list._partials.laravel-list')
                </div>
            </div>
        </div>
    </section>
@stop
@section('scripts')
    <script src="{{ asset('assets/site/js/products/list.js') }}"></script>
@stop
