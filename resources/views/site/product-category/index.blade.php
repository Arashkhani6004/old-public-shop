@extends('layouts.site.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/products/list.css') }}" />
@stop

@section('content')
    <section class="header-inner mt-lg-5 mt-4">
        <div class="container">
            <div class="title ">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <h1 class="m-0 fm-eb">
                        دسته بندی محصولات
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
                        <li class="breadcrumb-item active color-title" aria-current="page">دسته بندی محصولات</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="category mt-5">
        <div class="container">
            <div
                class="d-flex flex-wrap align-items-start gap-md-4 gap-3 justify-content-xl-start justify-content-center mt-4">
                @foreach($categories as $cat)
                    <div class="cat-card">
                        <a href="{{route('site.product.list',['id'=>@$cat->url])}}" class="text-dark">
                            <img src="{{@$cat->cat_image}}" width="200" height="200"
                                 class="w-100 h-auto" loading="lazy" alt="{{@$cat->title}}" title="{{@$cat->title}}" />
                            <p class="fm-md text-center small mt-2 mb-0">
                                {{@$cat->title}}
                            </p>
                        </a>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@stop
