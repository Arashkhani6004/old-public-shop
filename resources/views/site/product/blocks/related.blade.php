<section class="related pro py-5">
    <div class="text-center py-3">
        <p class="h5 ismb text-a my-0">s
            محصولات مرتبط 
        </p>
        <p class="text-secondary my-0">

        </p>
    </div>
    <div class="barline position-relative px-1">
        <hr>
        <div class="imgbox">
            @if(isset($setting_header->logo2))
                <img  height="100%" width="100%" src="{{$setting_header->logo_image}}" class="">
            @endif	  
            </div>
    </div>

    <div class="p-1">
        <div dir="rtl" class="swiper mySwiper-pro ">
            <div class="swiper-wrapper ">
                @foreach($relate as $row)
                    <div class="swiper-slide d-block">
                        <div class="item">
                            <a href="{{route('site.product.detail',['id'=>$row->url])}}">
                                <div class="card border px-1 py-4">
											@if($row->price > 0 && $row->old_price > 0)
    											<div
    												class="disc text-white d-flex align-items-center justify-content-center">
    												{{round(((@$row->old_price - @$row->price)/@$row->old_price)*100)}}%
    											</div>
											@endif
    											<figure>
    												<div class="figure-inn">
    													<img @if(count($row->variable) >0) src="{{asset('assets/uploads/content/pro/big/'.@$row->variable[0]->image)}}" @else src="{{@$row->pro_image}}" @endif alt="{{@$row->title}}">
    												</div>
    											</figure>
    											<p class="h6 mb-0 text-secondary">
    												{{@$row->title}}
    											</p>
    											<div class="row w-100 m-0">
											    @if($row->old_price == 0 && $row->price == 0 || $row->count == 0)
										            <p class="m-0 text-secondary text-center fw-bolder" >
                                                        @if($setting_header->product_button_text == 1)
                                                            تماس بگیرید
                                                        @else
                                                            ناموجود
                                                        @endif
                                                    </p>
												@elseif($row->price > 0)
    												<div class="col-sm-6 col-xs-6 p-0 align-self-center">
    													
    													<del class="text-danger">
    													    {{ number_format(@$row->old_price)}} تومان
    													</del>
    												</div>
    												<div class="col-sm-6 col-xs-6 p-0 align-self-center">
    													<p class="m-0 text-secondary">

    														{!! number_format(@$row->price) !!} تومان
    													</p>
    												</div>
												@else
    												<div class="col-sm-6 col-xs-6 p-0 align-self-center">
    													<p class="m-0 text-secondary">

    														{!! number_format(@$row->old_price) !!} تومان
    													</p>
    												</div>
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
