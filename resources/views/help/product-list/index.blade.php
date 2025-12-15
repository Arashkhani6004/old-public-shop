@extends('layouts.site.master-help')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/products/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/site/css/products/list.css?v0.05') }}" />
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
                        لیست محصولات
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
                        <li class="breadcrumb-item color-title font-re">

                            دسته بندی محصولات

                        </li>
                        <li class="breadcrumb-item active color-title" aria-current="page">
                            لیست محصولات
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="list-product mt-4">
        <div class="container">
            @include('help.product-list._partials.price-desktop-script')
            @include('help.product-list._partials.price-mobile-script')
            <div class="row w-100 m-0 mt-4">
              
                    @include('help.product-list._partials.desktop-filter')
               
                    @include('help.product-list._partials.mobile-filter')
             
                <!-- list -->
                <div class="col-xl-9 col-lg-8 p-lg-2 p-1">
                    @include('help.product-list._partials.sort')
                    @include('help.product-list._partials.laravel-list')
                </div>
            </div>
        </div>
    </section>
   
    @include('help.product-list._partials.description')
   
@stop
@section('scripts')
    <script src="{{ asset('assets/site/js/products/list.js') }}"></script>
@stop
