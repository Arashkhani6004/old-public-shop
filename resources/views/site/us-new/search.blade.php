@extends('layouts.site.master')
@section('title', 'جستجوی' . ' ' . @$search)
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/search/search.css?v0.05') }}">
@stop

@section('content')
    <section class="header-inner mt-lg-5 mt-4">
        <div class="container">
            <div class="title ">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <h1 class="m-0 fm-eb">
                        جستجو برای "{{ @$search }}"
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
                        <li class="breadcrumb-item active color-title" aria-current="page">جستجو</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="search-page mt-4">
        <div class="tabs-buttons mt-3 position-sticky top-0">
            <div class="container">
                <ul class="nav bg-white shadow-sm py-2 rounded-12 nav-pills" id="pills-tab" role="tablist">
                    @if ($products->count() > 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pro-tab" data-bs-toggle="pill" data-bs-target="#pro"
                                type="button" role="tab" aria-controls="pro" aria-selected="true">
                                محصولات
                            </button>
                        </li>
                    @endif
                    @if ($brands->count() > 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="brand-tab" data-bs-toggle="pill" data-bs-target="#brand"
                                type="button" role="tab" aria-controls="brand" aria-selected="false">
                                برندها
                            </button>
                        </li>
                    @endif
                    @if ($articles->count() > 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="blog-tab" data-bs-toggle="pill" data-bs-target="#blog"
                                type="button" role="tab" aria-controls="blog" aria-selected="false">
                                مقالات
                            </button>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="container mt-3">
            <div class="result pb-5">
                <div class="tab-content" id="pills-tabContent">
                    @if ($products->count() > 0)
                        <div class="tab-pane fade show active" id="pro" role="tabpanel" aria-labelledby="pro-tab"
                            tabindex="0">
                            @include('site.us-new._partials.products')
                        </div>
                    @endif
                    @if ($brands->count() > 0)
                        <div class="tab-pane fade" id="brand" role="tabpanel" aria-labelledby="brand-tab"
                            tabindex="0">
                            @include('site.us-new._partials.brands')
                        </div>
                    @endif
                    @if ($articles->count() > 0)
                        <div class="tab-pane fade" id="blog" role="tabpanel" aria-labelledby="blog-tab"
                            tabindex="0">
                            @include('site.us-new._partials.blogs')
                        </div>
                    @endif
                </div>
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
                "name": "جستجو",
                "item": "{{ route('site.search') }}"
            }]
        }
    </script>
@endsection