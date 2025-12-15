@extends('layouts.site.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/products/list.css?v0.03') }}" />
@stop
@section('title') محبوبترین محصولات @stop

@section('content')
    <section class="header-inner mt-lg-5 mt-4">
        <div class="container">
            <div class="title ">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <h1 class="m-0 fm-eb">
                        محبوبترین محصولات
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
                            محبوبترین محصولات
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="list-product mt-4">
        <div class="container">
            @include('site.popular-list._partials.laravel-list')
        </div>
    </section>
@stop
