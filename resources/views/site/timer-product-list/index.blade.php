@extends('layouts.site.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/products/list.css?v0.03') }}" />
@stop
@section('title'){{@$setting_header->title_offers ? $setting_header->title_offers : $setting_header->title}} @stop

@section('description')
    @if($setting_header->des_offers != null)
        {!! $setting_header->des_offers !!}
    @else
        {!! $setting_header->description_seo !!}
    @endif
@stop

@section('content')
    <section class="header-inner mt-lg-5 mt-4">
        <div class="container">
            <div class="title ">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <h1 class="m-0 fm-eb">
                        محصولات شگفت انگیز
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
                            محصولات شگفت انگیز
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="list-product mt-4">
        <div class="container">
            @include('site.timer-product-list._partials.laravel-list')
        </div>
    </section>
@stop
@section('scripts')
<script>
    (function() {
        const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;

        document.querySelectorAll(".countdown").forEach(timer => {
            const countDownDate = new Date(timer.getAttribute("data-date")).getTime();
                console.log(timer.getAttribute("data-date"))
            setInterval(function() {
                const now = new Date().getTime(),
                    distance = countDownDate - now;

                timer.querySelector(".days").innerText = Math.floor(distance / day) ?
                    `${Math.floor(distance / day -1)} روز` : "";
                timer.querySelector(".hours").innerText = Math.floor((distance % day) / hour);
                timer.querySelector(".minutes").innerText = Math.floor((distance % hour) / minute);
                timer.querySelector(".seconds").innerText = Math.floor((distance % minute) /
                    second);
            }, 1000);
        });
    }());
</script>
@stop
