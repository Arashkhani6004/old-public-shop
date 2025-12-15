@extends('layouts.site.master')
@section('title', 'جستجوی'.' '.@$search)
@section('content')
    <main class="content">
        <div class="">
            <div class="bg-b-light py-3">
                <div class="container">
                    <div class="row w-100 m-0">
                        <div class="col-sm-12 p-1 px-xs-2">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/">
                                            خانه
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        جستجو
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-sm-12 p-1 px-xs-2">
                            <div class="bg-white product-details-header p-3">
                                <p class="h2 m-0 ismb text-a border-bottom">
                                    "{{@$search}}"
                                </p>
                            </div>
                        </div>
                        <div class="search-list">
                            @if($products->count() > 0 || $brands->count() > 0 || $articles->count() > 0)
                                <div class="d-flex align-items-center py-4">
                                    <p class=" m-0  d-none d-sm-block">
                                        جستجو در :
                                    </p>
                                    <ul class="nav nav-pills px-1" id="pills-tab" role="tablist">
                                        @if($products->count() > 0)
                                        <li class="nav-item px-2" role="presentation">
                                            <button class="nav-link active item-list-search py-1" id="pills-home-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-home" type="button"
                                                    role="tab" aria-controls="pills-home" aria-selected="true">محصولات
                                            </button>
                                        </li>
                                        @endif
                                        @if($brands->count() > 0)
                                        <li class="nav-item px-2" role="presentation">
                                            <button class="nav-link item-list-search py-1" id="pills-profile-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"
                                                    role="tab" aria-controls="pills-profile" aria-selected="false">برند ها
                                            </button>
                                        </li>
                                        @endif
                                        @if($articles->count() > 0)
                                        <li class="nav-item px-2" role="presentation">
                                            <button class="nav-link item-list-search py-1" id="pills-contact-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-contact" type="button"
                                                    role="tab" aria-controls="pills-contact" aria-selected="false">مقالات
                                            </button>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                            <div class="tab-content" id="pills-tabContent">
                                @if($products->count() > 0)
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                         aria-labelledby="pills-home-tab" tabindex="0">
                                        <div class="col-sm-12 p-1 px-xs-2 pro pro-det">
                                            <div class="bg-white product-details-header p-3">
                                                <p class="h3 ismb text-b border-bottom">
                                                    محصولات
                                                </p>
                                                <div class="row w-100 m-0">
                                                    @foreach($products as $row)

                                                        <div class="col-xxl-2 col-lg-3 col-sm-4 col-xs-6 p-1">
                                                            <a href="{{route('site.product.detail',['id'=>$row->url])}}">
                                                                <div class="card border px-1 py-4">
                                                                    @if($row->price > 0 && $row->old_price > 0 && $row->count > 0)
                                                                        <div
                                                                            class="disc text-white d-flex align-items-center justify-content-center">
                                                                            {{round(((@$row->old_price - @$row->price)/@$row->old_price)*100)}}
                                                                            %
                                                                        </div>
                                                                    @endif
                                                                    <figure>
                                                                        <div class="figure-inn">
                                                                            <img
                                                                                @if(count($row->variable) >0) src="{{asset('assets/uploads/content/pro/big/'.@$row->variable[0]->image)}}"
                                                                                @else src="{{@$row->pro_image}}"
                                                                                @endif alt="{{@$row->title}}">
                                                                        </div>
                                                                    </figure>
                                                                    <p class="h6 mb-0 text-secondary">
                                                                        {{@$row->title}}
                                                                    </p>
                                                                    <div class="row w-100 m-0">
                                                                        @if($row->old_price == 0 && $row->price == 0 || $row->count == 0)
                                                                            <p class="m-0 text-secondary text-center fw-bolder">
                                                                                تماس بگیرید
                                                                            </p>
                                                                        @elseif($row->price > 0)
                                                                            <div class="col-sm-6 col-xs-6 p-0 align-self-center">
                                                                                <del class="text-danger">
                                                                                    {{ number_format(@$row->old_price)}}
                                                                                    تومان
                                                                                </del>
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-6 col-xs-6 p-0 align-self-center">
                                                                                <p class="m-0 text-secondary">

                                                                                    {!! number_format(@$row->price) !!}
                                                                                    تومان
                                                                                </p>
                                                                            </div>
                                                                        @else
                                                                            <div
                                                                                class="col-sm-6 col-xs-6 p-0 align-self-center">
                                                                                <p class="m-0 text-secondary">

                                                                                    {!! number_format(@$row->old_price) !!}
                                                                                    تومان
                                                                                </p>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($brands->count() > 0)
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                         aria-labelledby="pills-profile-tab" tabindex="0">
                                        <div class="col-sm-12 p-1 px-xs-2 br br-list brands">
                                            <div class="bg-white product-details-header p-3">
                                                <p class="h3 ismb text-b border-bottom">
                                                    برندها
                                                </p>
                                                <div class="row w-100 m-0">
                                                    @foreach($brands as $brand)
                                                        <div class="col-xxl-2 col-xl-3 col-md-4 col-6 text-center p-1">
                                                            <a href="{{route('site.brand.detail',['id'=>$brand->url])}}">
                                                                <div class="card rounded-4 overflow-hidden">
                                                                    <figure>
                                                                        <div class="figure-inn">
                                                                            <img src="{{$brand->brand_image}}"
                                                                                 alt="{!! @$brand->title !!}">
                                                                        </div>
                                                                    </figure>
                                                                    <p class="text-b mb-3">
                                                                        {!! @$brand->title !!}
                                                                    </p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($articles->count() > 0)
                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                         aria-labelledby="pills-contact-tab" tabindex="0">
                                        <div class="col-sm-12 p-1 px-xs-2 br br-list brands">
                                            <div class="bg-white product-details-header p-3">
                                                <p class="h3 ismb text-b border-bottom">
                                                    مقالات
                                                </p>
                                                <div class="row w-100 m-0 blogs-tab">
                                                    @foreach($articles as $article)
                                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-xs-12 p-1">
                                                            <a href="#">
                                                                <div class="card p-5"
                                                                     style="background-image: url('{{$article->image}}')}}');">
                                                                    <div class="overlay">
                                                                        <p class="m-0 text-c">
                                                                            {!! @$article->title !!}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if($products->count() == 0 && $brands->count() == 0 && $articles->count() == 0)
                            <div class="pb-5">
                                <div class="my-5">
                                    <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_a7vr2ghs.json" background="transparent" speed="1" class="w-25 h-auto mx-auto" loop autoplay></lottie-player>
                                </div>
                                <p class="h4 ismb text-center text-secondary my-2">
                                    چیزی که دنبالش میگردی رو پیدا نکردیم! دوباره جستجو کن
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
@section('js')
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
