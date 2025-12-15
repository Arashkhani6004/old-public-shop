<section class="related pro py-5">s
    <div class="text-center py-3">
        <p class="h5 ismb text-a my-0">
            محصولات مکمل
        </p>
        <p class="text-secondary my-0">

        </p>
    </div>
    <div class="barline position-relative px-1">
        <hr>
        <div class="imgbox">
            @if(isset($setting_header->logo2))
                <img src="{{$setting_header->logo_image}}" alt="{{@$setting_header->title}}" >
            @endif	        </div>
    </div>

    <div class="p-1">
        <div dir="rtl" class="swiper mySwiper-pro ">
            <div class="swiper-wrapper ">
                @foreach($complement as $row)
                    <div class="swiper-slide d-block">
                        <div class="item">
                            <a href="{{route('site.product.detail',['id'=>$row->url])}}">
                                <div class="card border px-1 py-4">
                                    @if(@$row->price != null && @$row->price != 0 && $row->old_price != 0)
                                        <div
                                            class="disc text-white d-flex align-items-center justify-content-center">
                                            {{round((($row->old_price - $row->price)* 100)/$row->old_price)}}%
                                        </div>
                                    @endif
                                    <figure>
                                        @if(count($row->variable) > 0)
                                        <div class="figure-inn">
                                            <img src="{{asset('assets/uploads/content/pro/big/'.$row->variable[0]->image)}}" alt="{{@$row->title}}" loading="lazy">
                                        </div>
                                        @else
                                        <div class="figure-inn">
                                            <img src="{{@$row->pro_image}}" alt="{{@$row->title}}" loading="lazy">
                                        </div>
                                        @endif
                                    </figure>
                                    <p class="h6 mb-0 text-secondary">
                                        {{@$row->title}}
                                    </p>
                                    <div class="row w-100 m-0">
                                        @if(@$row->price != null && @$row->price != 0 )
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
                                        @if($row->old_price == 0 ||$row->count == 0 )
                                        <div class="col-sm-6 col-xs-6 p-0 align-self-center">
                                            <p class="m-0 text-secondary">
                                                @if($setting_header->product_button_text == 1)
                                                    تماس بگیرید
                                                @else
                                                    ناموجود
                                                @endif
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
        </div>
{{--        <section id="demos">--}}
{{--            <div class="row w-100 m-0">--}}
{{--                <div class="large-12 px-0 columns">--}}
{{--                    <div class="owl-carousel-best owl-theme">--}}
{{--                        @foreach($relate as $row)--}}
{{--                            <div class="item">--}}
{{--                                <a href="{{route('site.product.detail',['id'=>$row->url])}}">--}}
{{--                                    <div class="card border px-1 py-4">--}}
{{--                                        @if(round($row->calcute) != 0)--}}
{{--                                            <div--}}
{{--                                                class="disc text-white d-flex align-items-center justify-content-center">--}}
{{--                                                {{round($row->calcute)}}%--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                        <figure>--}}
{{--                                            <div class="figure-inn">--}}
{{--                                                <img src="{{@$row->pro_image}}" alt="{{@$row->title}}">--}}
{{--                                            </div>--}}

{{--                                        </figure>--}}

{{--                                        <div class="row w-100 m-0">--}}
{{--                                            <p class="m-0 text-secondary">--}}
{{--                                                {{@$row->title}}--}}
{{--                                            </p>--}}
{{--                                            @if($row->price_first['old'] !== 'ندارد')--}}
{{--                                                <div class="col-sm-6 col-xs-6 p-0 align-self-center">--}}

{{--                                                    <del class="text-danger">--}}
{{--                                                        {{@$row->price_first['old']}}--}}
{{--                                                    </del>--}}


{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                            @if($row->price_first['price'] !== 'ندارد')--}}
{{--                                                <div class="col-sm-6 col-xs-6 p-0 align-self-center">--}}
{{--                                                    <p class="m-0 text-secondary">--}}
{{--                                                        {{@$row->price_first['price']}}--}}
{{--                                                    </p>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
    </div>

</section>
