@extends('layouts.site.master-help')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/shared/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/site/css/index/index.css?0.07') }}" />
@stop

@section('content')

    <section class="d-lg-block d-none">
        @include('help.first-page._partials.header')
    </section>

    <section class="d-lg-none d-block">
        @include('help.first-page._partials.header-mobile')
    </section>

    @include('help.first-page._partials.h-one')
    @include('help.first-page._partials.category')
    @include('help.first-page._partials.offer-products')
    @include('help.first-page._partials.banners')
    @include('help.first-page._partials.sale-products')
    @include('help.first-page._partials.banner-two')
    @include('help.first-page._partials.new-products')
    @include('help.first-page._partials.banner-three')
    @include('help.first-page._partials.discounted-products')
    @include('help.first-page._partials.banner-three-mobile')
    @include('help.first-page._partials.brands')
    @include('help.first-page._partials.popular-products')
    @include('help.first-page._partials.blogs')

@stop
@section('scripts')
    <script src="{{ asset('assets/site/js/index/index.js?v0.05') }}"></script>
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
    <script type="application/ld+json">
  {
    "@context": "https://schema.org/",
    "@type": "WebSite",
    "name": "{!! @$setting_header->title !!}",
    "url": "{{ url()->current() }}",
    "sameAs": "",
    "description": "{!! @$setting_header->description_seo !!}",
    "image": "{{asset('assets/uploads/content/set/'.@$setting_header->logo)}}",
    "alternateName": "{!! @$setting_header->h1 !!}"
  }
</script>
@stop
