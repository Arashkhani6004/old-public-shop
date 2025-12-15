<section class="pro newest fgf pt-5 mt-5">
    <div class="container">
        <div class="text-center py-3">sss
            <p class="h5 ismb text-a my-0">
                {{@$setting_header->title_3}}
            </p>

        </div>
        <div class="barline position-relative px-1">
            <hr>
            <div class="imgbox">
                @if(isset($setting_header->logo2))
                    <div height="100%" width="100%" src="{{$setting_header->logo_image}}" class="w-100"
                         loading="lazy"></div>
                @endif            </div>
        </div>
        <div class="px-4 py-1 position-relative">
            <div dir="rtl" class="swiper mySwiper-pro1" style=" position: unset;">
                <div class="swiper-wrapper ">
                    @foreach($popular_products as $row)
                        <div class="swiper-slide d-block">
                            <div class="item">
                                <a href="{{route('site.product.detail',['id'=>$row->url])}}">
                                    <div class="card border p-2">
                                        @if(@$row->price != null && @$row->price != 0 && @$row->old_price != 0 && @$row->count > 0)
                                            <div
                                                class="disc text-white d-flex align-items-center justify-content-center">
                                                {{round((($row->old_price - $row->price)* 100)/$row->old_price)}}%
                                            </div>
                                        @endif
                                        <figure>
                                            @if(count($row->variable) > 0)
                                                <div class="figure-inn">
                                                    <img src="{{$row->variable[0]->medium_image}}" width="1" height="1"
                                                         class="w-100" alt="{{@$row->title}}" loading="lazy">
                                                </div>
                                            @else
                                                <div class="figure-inn">
                                                    <img src="{{@$row->medium_image}}" alt="{{@$row->title}}" class=" "
                                                         width="1" height="1" loading="lazy">
                                                </div>
                                            @endif
                                        </figure>
                                        <p class="h6 mb-0 text-secondary">
                                            {{@$row->title}}
                                        </p>
                                        <div class="row w-100 m-0">
                                            @if(@$row->price != null && @$row->price != 0 && @$row->count > 0)
                                                <div class="col-sm-6 col-xs-6 p-0 align-self-center">
                                                    <del class="text-danger">
                                                        {{number_format(@$row->old_price)}} تومان
                                                    </del>
                                                </div>
                                                <div class="col-sm-6 col-xs-6 p-0 align-self-center">
                                                    <p class="m-0 text-secondary">
                                                        {{ number_format(@$row->price)}} تومان
                                                    </p>
                                                </div>
                                            @else

                                                @if($row->old_price == 0 || $row->count == 0)
                                                    <div class="col-sm-6 col-xs-6 p-0 align-self-center">
                                                        <p class="m-0 text-secondary">
                                                            تماس بگیرید
                                                        </p>
                                                    </div>
                                                @else
                                                    <div class="col-sm-6 col-xs-6 p-0 align-self-center">
                                                        <p class="m-0 text-secondary">
                                                            {{ number_format(@$row->old_price) }} تومان
                                                        </p>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next p-4"></div>
                <div class="swiper-button-prev p-4"></div>
            </div>
            {{--            <section id="demos">--}}
            {{--                <div class="row w-100 m-0">--}}
            {{--                    <div class="large-12 px-0 columns">--}}
            {{--                        <div class="owl-carousel-best owl-theme">--}}
            {{--                            @foreach($popular_products as $row)--}}
            {{--                                <div class="item">--}}
            {{--                                    <a href="{{route('site.product.detail',['id'=>$row->url])}}">--}}
            {{--                                        <div class="card border px-1 py-4">--}}
            {{--                                            @if($row->calcute > 0)--}}
            {{--                                                <div--}}
            {{--                                                    class="disc text-white d-flex align-items-center justify-content-center">--}}
            {{--                                                    {{round(@$row->calcute)}}%--}}
            {{--                                                </div>--}}
            {{--                                            @endif--}}
            {{--                                            <figure>--}}
            {{--                                                <div class="figure-inn">--}}
            {{--                                                    <img src="{{@$row->pro_image}}" alt="{{@$row->title}}" loading="lazy">--}}
            {{--                                                </div>--}}
            {{--                                            </figure>--}}
            {{--                                            <p class="h6 mb-0 text-secondary">--}}
            {{--                                                {{@$row->title}}--}}
            {{--                                            </p>--}}
            {{--                                            <div class="row w-100 m-0">--}}
            {{--                                                <div class="col-sm-6 col-xs-6 p-0 align-self-center">--}}
            {{--                                                    @if($row->calcute > 0)--}}
            {{--                                                        <del class="text-danger">--}}
            {{--                                                            {!! @$row->price_first['old'] !!}--}}
            {{--                                                        </del>--}}
            {{--                                                    @endif--}}
            {{--                                                </div>--}}
            {{--                                                <div class="col-sm-6 col-xs-6 p-0 align-self-center">--}}
            {{--                                                    <p class="m-0 text-secondary">--}}
            {{--                                                        {!! @$row->price_first['price'] !!}--}}
            {{--                                                    </p>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </a>--}}
            {{--                                </div>--}}
            {{--                            @endforeach--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </section>--}}
        </div>
    </div>
</section>
