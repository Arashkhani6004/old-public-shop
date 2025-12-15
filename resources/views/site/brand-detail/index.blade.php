@extends('layouts.site.master')
@section('title'){{ @$brand->title_seo ? $brand->title_seo : $brand->title }} @stop
@section('image_seo'){{ @$brand->image ? $brand->brand_image : asset('assets/uploads/content/set/' . @$setting->logo) }}
@endsection
@section('canonical'){{ $brand->keyword ? $brand->keyword : trim(url()->current()) }}@stop

@section('description')
    @if ($brand->description_seo != null)
        {!! $brand->description_seo !!}
    @else
        {!! strip_tags(\Illuminate\Support\Str::limit($brand->description, 100)) !!}
    @endif
@stop
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
            <div class="row w-100 m-0 align-items-center">
                <div class="col-lg-12 col-md-11 col-sm-10 col-9 align-self-center">
                    <div class="title ">
                        <div class="right d-flex align-items-center">
                            <span class="icon me-sm-2 me-1"></span>
                            <h1 class="m-0 fm-eb">
                                {{ @$brand->title }}
                            </h1>
                        </div>
                        <nav aria-label="breadcrumb" class="mt-2">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/" class="d-flex align-items-center color-title font-re">
                                        <i class="bi bi-house d-flex me-1"></i>
                                        خانه
                                    </a>
                                </li>
                                <li class="breadcrumb-item color-title font-re">
                                    <a href=" {{ route('site.brand.list') }}"
                                        class="d-flex align-items-center color-title font-re">
                                        برندها
                                    </a>
                                </li>
                                <li class="breadcrumb-item active color-title" aria-current="page">
                                    {{ @$brand->title }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                {{-- brand img in mobile --}}
                <div class="col-md-1 col-sm-2 col-3 p-1 d-lg-none d-block align-self-center">
                    <img src="{{ $brand->brand_image }}" class="w-100 rounded-3" width="100%"
                        alt="{!! @$brand->title !!}" title="{!! @$brand->title !!}" loading="lazy">
                </div>
            </div>

        </div>
    </section>
    <section class="list-product mt-4">
        <div class="container">
            {{-- @include('site.product-list._partials.upper-categories') --}}
            @include('site.brand-detail._partials.price-desktop-script')
            @include('site.brand-detail._partials.price-mobile-script')
            <div class="row w-100 m-0 mt-4">
                @if (!App\Library\Helper::isMobile())
                    @include('site.brand-detail._partials.desktop-filter')
                @else
                    @include('site.brand-detail._partials.mobile-filter')
                @endif
                <!-- list -->
                <div class="col-xl-9 col-lg-8 p-lg-2 p-1">
                    @include('site.brand-detail._partials.sort')
                    @include('site.brand-detail._partials.laravel-list')
                </div>
            </div>
        </div>
    </section>
    @if($brand->description != null)
        @include('site.brand-detail._partials.description')
    @endif
@stop
@section('scripts')
    <script src="{{ asset('assets/site/js/products/list.js') }}"></script>
@stop
