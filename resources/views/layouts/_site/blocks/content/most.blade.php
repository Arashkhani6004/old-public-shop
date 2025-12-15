<section class="pro newest">
    <div class="container">
        <div class="text-center py-3">
            <p class="h5 ismb text-a my-0">
                {{@$setting_header->title_2}}
            </p>

        </div>
        <div class="barline position-relative px-1">
            <hr>
            <div class="imgbox">
                @if(isset($setting_header->logo2))
                    <img height="100%" width="100%" src="{{$setting_header->logo_image}}" class="" loading="lazy">
                @endif            </div>
        </div>
        <div class="px-4 py-1 position-relative">
            <div dir="rtl" class="swiper mySwiper-pro" style=" position: unset;">
                <div class="swiper-wrapper">
                    @foreach($most_products as $row)
                        <div class="swiper-slide d-block">
                            <div class="item">
                                <a href="{{route('site.product.detail',['id'=>$row->url])}}">
                                    <div class="card border px-1 py-4">
                                        @if(@$row->price != null && @$row->price != 0 && @$row->old_price != 0 && @$row->count > 0)
                                            <div
                                                class="disc text-white d-flex align-items-center justify-content-center">
                                                {{round((($row->old_price - $row->price)* 100)/$row->old_price)}}%
                                            </div>
                                        @endif
                                        <figure>
                                            @if(count($row->variable) > 0)
                                                <div class="figure-inn">
                                                    <img src="{{ $row->variable[0]->medium_image }}" width="1"
                                                         height="1" alt="{{@$row->title}}" loading="lazy">
                                                </div>
                                            @else
                                                <div class="figure-inn">
                                                    <img src="{{@$row->medium_image}}" alt="{{@$row->title}}" width="1"
                                                         height="1" loading="lazy">
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
        </div>
    </div>
</section>
