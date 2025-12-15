@extends('layouts.site.master')
@section('title'){{ @$setting_header->abouttitle ? $setting_header->abouttitle : $setting_header->title }} @stop
@section('image_seo'){{ @$setting_header->aboutimg ? asset('assets/uploads/content/set/big/' . $setting_header->aboutimg) : asset('assets/uploads/content/set/' . @$setting_header->logo) }}
@endsection
@section('description')
    {!! strip_tags(\Illuminate\Support\Str::limit(@$setting_header->about, 100)) !!}
@stop
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/us/us.css') }}" />
@stop

@section('content')
    <section class="header-inner mt-lg-5 mt-4">
        <div class="container">
            <div class="title ">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <h1 class="m-0 fm-eb">
                        {{ @$setting_header->abouttitle }}
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
                        <li class="breadcrumb-item active color-title" aria-current="page"> درباره ما</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="category mt-4">
        <div class="container">
            <img src="{{ 'assets/uploads/content/set/big/' . @$setting_header->aboutimg }}" class="w-100"
                alt="{{ @$setting_header->abouttitle }}" title="{{ @$setting_header->abouttitle }}" />
            <div class="description">
                {!! @$setting_header->about !!}
            </div>
        </div>
    </section>
@stop
@section('scripts')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "BreadcrumbList",
            "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "name": "{{$setting_header->title}}",
                "item": "{{route('site.home')}}"
            },{
                "@type": "ListItem",
                "position": 2,
                "name": "{{$setting_header->abouttitle}}",
                "item": "{{ route('site.about') }}"
            }]
        }
    </script>
@endsection