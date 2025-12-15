@extends('layouts.site.master-help')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/products/detail.css?v0.23') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/products/magiczoomplus.css') }}">
@stop

@section('content')
    <section class="product-page mt-md-5 mt-3">
        <div class="container">
            <div class="product-info">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="#" class="d-flex align-items-cente fm-re">
                                <i class="bi bi-house d-flex me-1"></i>
                                خانه
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a class="d-flex align-items-center fm-re small" href="{{ url('/all-products') }}">
                                همه محصولات
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            جزئیات محصول
                        </li>
                    </ol>
                </nav>
                <div class="row w-100 m-0">
                    <div class="d-md-none d-block p-0 mb-3">
                        <div class="name border-bottom">
                            @include('help.product-detail._partials.components.info')
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-12 ps-0 pe-xl-2 pe-lg-2 pe-0">
                        @include('help.product-detail._partials.product-image')
                    </div>
                    <div class="col-xl-8 col-lg-8 col-12 pe-0 ps-xl-2 ps-lg-2 ps-0 mt-lg-0 mt-2">
                        @include('help.product-detail._partials.info-product')
                        <div class="row w-100 m-0 mt-md-4">
                            <div class="col-md-6 p-0 pe-md-2">


                                {{-- attributes --}}
                                @include('help.product-detail._partials.attributes')

                    
                            </div>
                            <div class="col-md-6 p-0 ps-md-2">
                                <div class="price mt-md-0 mt-4">
                                    {{-- slogans --}}
                                    @include('help.product-detail._partials.slogan')

                                    {{-- variables select --}}
                                    <div class="var-select">
                                        <label class="small fm-b mb-2 mx-1">
                                            انتخاب متغیر محصول
                                        </label>
                                        <select class="form-select form-select-sm" aria-label="Default select example">
                                            <option value="" selected>متغیر محصول را انتخاب کنید</option>
                                            <option value="1">رنگ قرمز</option>
                                            <option value="2">رنگ آبی</option>
                                            <option value="3">رنگ سبز</option>
                                        </select>
                                    </div>

                                    {{-- add to cart for desktop --}}
                                    @include('help.product-detail._partials.add-to-cart-desktop')
                                </div>
                            </div>
                        </div>
                        {{-- add to cart for mobile --}}
                        @include('help.product-detail._partials.add-to-cart-mobile')
                    </div>
                </div>
            </div>
            {{-- tabs --}}
            @include('help.product-detail._partials.tabs')

        </div>
        {{-- related products --}}
        
            @include('help.product-detail._partials.related')
        
        
            @include('help.product-detail._partials.complement')
        
    </section>
@stop
@section('scripts')
    <script src="{{ asset('assets/site/js/products/magiczoomplus.js') }}"></script>
    <script src="{{ asset('assets/site/js/products/detail.js?v0.04') }}"></script>
    <script>
        var tableList = document.querySelectorAll('.content table');
        tableList.forEach((item) => {
            item.className = "table table-bordered bg-transparent mx-auto table-striped";
            item.outerHTML = `<div class="table-responsive">${item.outerHTML}</div>`
        })
    </script>

@stop
