@extends('layouts.site.master-help')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/blog/list.css') }}" />
@stop

@section('content')
    <section class="header-inner mt-lg-5 mt-4">
        <div class="container">
            <div class="title ">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <h1 class="m-0 fm-eb">
                        دسته بندی تستی
                    </h1>
                </div>
                <nav aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="d-flex align-items-center fm-re">
                                <i class="bi bi-house d-flex me-1"></i>
                                خانه
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="d-flex align-items-center fm-re">
                                دسته بندی مقالات
                            </a>
                        </li>
                        <li class="breadcrumb-item active " aria-current="page">دسته بندی تستی</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="category mt-4">
        <div class="container">
            <div class="row w-100 m-0">
                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-12 p-lg-2 p-1 mt-md-0 mt-4">
                    <a href="#" class="d-block">
                        <div class="blog-card">
                            <div class="position-relative">
                                <span class="cat">
                                    دسته‌بندی نمونه
                                </span>
                                <img src="{{ asset('assets/site/images/frame-blog.jpg') }}"
                                    alt="عنوان نمونه" title="عنوان نمونه" class="w-100 h-auto"
                                    width="450" height="300" loading="lazy" />
                            </div>

                            <p class="title m-0 mt-2 fm-b justify-content-start">
                                عنوان نمونه مقاله
                            </p>
                            <div class="date d-flex align-items-center mt-3">
                                <i class="bi bi-calendar4-event d-flex me-1"></i>
                                <span class="fm-b">
                                    01 فروردین 1403
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-12 p-lg-2 p-1 mt-md-0 mt-4">
                    <a href="#" class="d-block">
                        <div class="blog-card">
                            <div class="position-relative">
                                <span class="cat">
                                    دسته‌بندی تستی
                                </span>
                                <img src="{{ asset('assets/site/images/frame-blog.jpg') }}"
                                    alt="عنوان تستی" title="عنوان تستی" class="w-100 h-auto"
                                    width="450" height="300" loading="lazy" />
                            </div>

                            <p class="title m-0 mt-2 fm-b justify-content-start">
                                عنوان تستی مقاله
                            </p>
                            <div class="date d-flex align-items-center mt-3">
                                <i class="bi bi-calendar4-event d-flex me-1"></i>
                                <span class="fm-b">
                                    15 اردیبهشت 1403
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@stop
