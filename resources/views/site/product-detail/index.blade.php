@extends('layouts.site.master')
@section('title'){{ @$product->title_seo ? $product->title_seo : $product->title }} @stop
@section('image_seo', @$product->images[0]->file ? asset('assets/uploads/content/pro/big/' . @$product->images[0]->file)
    : asset('assets/uploads/content/set/' . @$setting_header->logo))

@section('og_type', 'product')

@section('canonical'){{ $product->keyword ? $product->keyword : trim(url()->current()) }}@stop

@section('description')
    @if ($product->description_seo != null)
        {!! $product->description_seo !!}
    @else
        {!! strip_tags(\Illuminate\Support\Str::limit($product->description, 100)) !!}
    @endif
@stop

@section('torob')
    <meta name="product_id" content="{{ @$product->id }}">
    <meta name="product_name" content="{{ @$product->title ? $product->title : @$product->title_seo }}">
    @if (count(@$product->variable) > 0)

        @if (@$product->variable[0]->discounted_price > 0)
            <meta name="productprice" content="{{ @$product->variable[0]->discounted_price }}">
            <meta name="productoldprice" content="{{ @$product->variable[0]->price }}">
        @else
            <meta name="productprice" content="{{ @$product->variable[0]->price }}">
        @endif
    @else
        @if (@$product->price != null && @$product->price != 0)
            <meta name="productprice" content="{{ @$product->price }}">
            <meta name="productoldprice" content="{{ @$product->old_price }}">
        @else
            <meta name="productprice" content="{{ @$product->old_price }}">
        @endif
    @endif
    <meta name="availability" content="{{ @$product->count > 0 ? 'instock' : 'outofstock' }}">
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/products/detail.css?v0.25') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/products/magiczoomplus.css') }}">
@stop

@section('content')
    <section class="product-page mt-md-5 mt-3">
        <div class="container">
            <div class="product-info">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="d-flex align-items-center fm-re">
                                <i class="bi bi-house d-flex me-1"></i>
                                خانه
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a class="d-flex align-items-center fm-re small"
                                href="{{ route('site.product.list', ['id' => $product->cats[0]->url]) }}">
                                {{ @$product->cats[0]->title }}
                            </a>
                        </li>
                        @if($product->cats->count() >0)
                            <li class="breadcrumb-item">
                                <a href="{{route('site.product.list',['id'=>$product->cats[0]->url])}}">
                                    {{@$product->cats[0]->title}}
                                </a>
                            </li>
                        @endif
                        @if($product->cats->count() >1)
                            <li class="breadcrumb-item">
                                <a href="{{route('site.product.list',['id'=>$product->cats[1]->url])}}">
                                    {{@$product->cats[1]->title}}
                                </a>
                            </li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ @$product->title }}
                        </li>
                    </ol>
                </nav>
                <div class="row w-100 m-0">
                    <div class="d-md-none d-block p-0 mb-3">
                        <div class="name border-bottom">
                            @include('site.product-detail._partials.components.info')
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-12 ps-0 pe-xl-2 pe-lg-2 pe-0">
                        @include('site.product-detail._partials.product-image')
                    </div>
                    <div class="col-xl-8 col-lg-8 col-12 pe-0 ps-xl-2 ps-lg-2 ps-0 mt-lg-0 mt-2">
                        @include('site.product-detail._partials.info-product')
                        <div class="row w-100 m-0 mt-md-4">
                            <div class="col-md-6 p-0 pe-md-2">

                                {{-- select color --}}
                                @include('site.product-detail._partials.colors')

                                {{-- attributes --}}
                                @include('site.product-detail._partials.attributes')

                                {{-- selected specification --}}
                                {{-- @include('pages.product-detail._partials.selected-specification') --}}
                            </div>
                            <div class="col-md-6 p-0 ps-md-2">
                                <div class="price mt-md-0 mt-4">
                                    {{-- slogans --}}
                                    @include('site.product-detail._partials.slogan')

                                    {{-- variables select --}}
                                    @if (count($product->variable) > 0)
                                        <div class="var-select">
                                            <label class="small fm-b mb-2 mx-1">
                                                انتخاب متغیر
                                                محصول
                                            </label>
                                            <select class="form-select form-select-sm" aria-label="Default select example"
                                                v-model="variableId" @change="changeVariables(variableId)">
                                                <option value="" selected> متغیر
                                                    محصول را انتخاب کنید
                                                </option>
                                                @foreach ($product->variable as $key => $variable)
                                                    <option value="{{ $variable->id }}">
                                                        {{ $variable->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    {{-- add to cart for desktop --}}
                                    @include('site.product-detail._partials.add-to-cart-desktop')
                                </div>
                            </div>
                        </div>
                        {{-- add to cart for mobile --}}
                        @include('site.product-detail._partials.add-to-cart-mobile')
                    </div>
                </div>
            </div>
            {{-- tabs --}}
            @include('site.product-detail._partials.tabs')

        </div>
        {{-- related products --}}
        @if ($relate->count() != 0)
            @include('site.product-detail._partials.related')
        @endif
        @if ($complement->count() != 0)
            @include('site.product-detail._partials.complement')
        @endif
    </section>
@stop
@section('scripts')
    @if (count($questions) > 0)
        <script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "FAQPage",
"mainEntity": [
@foreach($questions as $key => $answer) {
    "@type": "Question",
    "name": "{!! strip_tags($answer->question)!!}",
    "acceptedAnswer": {
        "@type": "Answer",
        "text": "{!! strip_tags($answer->answer)!!}"
    }
}
@if(count($questions) == $key + 1) @else, @endif
    @endforeach
    ]
}
</script>
    @endif
    <script type="application/ld+json">
{
"@context": "https://schema.org/",
"@type": "Product",
"name": "{{@$product->title}}",
"image": "{{asset('assets/uploads/content/pro/big/'.@$product->image[0]->file)}}",
"description": "{{@$product->description_seo}}.",
"brand": "{{@$product->title}}",
"aggregateRating": {
"@type": "AggregateRating",
"ratingValue": "4.90",
"bestRating": "5",
"worstRating": "1",
"ratingCount": "490"
}
}
</script>
    <script src="{{ asset('assets/site/js/products/magiczoomplus.js') }}"></script>
    <script src="{{ asset('assets/site/js/products/detail.js?v0.07') }}"></script>
    <script>
        var tableList = document.querySelectorAll('.content table');
        tableList.forEach((item) => {
            item.className = "table table-bordered bg-transparent mx-auto table-striped";
            item.outerHTML = `<div class="table-responsive">${item.outerHTML}</div>`
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var descElem = document.getElementById('description-text');
            var btn = document.getElementById('show-more-btn');
            var limitRem = 18;
            var limitPx = limitRem * parseFloat(getComputedStyle(document.documentElement).fontSize);
            console.log(descElem.scrollHeight)
            if (descElem.scrollHeight > limitPx) {
                btn.classList.remove('d-none');
                descElem.classList.add("description-text")
                btn.addEventListener('click', function() {
                    btn.style.display = 'none';
                });
            }
        });
    </script>
@stop
