@extends('layouts.site.master')
@section('title'){{ @$setting_header->title_brand ? $setting_header->title_brand : $setting_header->title }} @stop

@section('description')
    @if ($setting_header->des_brand != null)
        {!! $setting_header->des_brand !!}
    @else
        {!! $setting_header->description_seo !!}
    @endif
@stop
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/brands/list.css') }}" />
@stop

@section('content')
    <section class="header-inner mt-lg-5 mt-4">
        <div class="container">
            <div class="title ">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <h1 class="m-0 fm-eb">
                        برند ها
                    </h1>
                </div>
                <nav aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}" class="d-flex align-items-center color-title font-re">
                                <i class="bi bi-house d-flex me-1"></i>
                                خانه
                            </a>
                        </li>
                        <li class="breadcrumb-item active color-title" aria-current="page">برندها</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="category mt-5">
        <div class="container">
            <div class="row w-100 m-0">
                @foreach($brands as $brand)
                <div class="col-xxl-2 col-xl-3 col-md-4 col-6 p-xl-3 p-2">
                    <div class="brand-card">
                        <a href="{{route('site.brand.detail',['id'=>$brand->url])}}" class="d-block text-dark">
                            <img src="{{$brand->medium_image}}" class="w-100 h-auto" width="237"
                                height="64" alt="{!! @$brand->title !!}" title="{!! @$brand->title !!}" loading="lazy" />
                            <p class="text-center m-0 mt-1">
                                {!! @$brand->title !!}
                            </p>
                        </a>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@stop
