@if (count($popular_products) > 0)
    <section class="popular-products">
        <div class="container">
            <div class="title d-flex align-items-center justify-content-between">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <p class="m-0 fm-eb">
                        {{ @$setting_header->title_3 }}
                    </p>
                </div>
                <a href="{{url('/popular-products')}}" class="link text-dark fm-re d-flex align-items-center">
                    مشاهده همه
                    <i class="bi bi-arrow-left-short d-flex ms-1"></i>
                </a>
            </div>
            <div class="swiper mySwiper-popular mt-3 p-sm-2">
                <div class="swiper-wrapper">
                    @foreach ($popular_products as $row)
                        <div class="swiper-slide">
                            <a href="{{route('site.product.detail',['id'=>$row->url])}}" class="d-block">
                                <div class="popular-card">
                                    <div class="row w-100 m-0">
                                        <div class="col-4 p-1">
                                            @if (count($row->variable) > 0)
                                                <img src="{{ $row->variable[0]->medium_image }}" class="w-100 h-auto"
                                                    width="100" height="100" loading="lazy"
                                                    alt="{{ @$row->title }}" title="{{ @$row->title }}" />
                                            @else
                                                <img src="{{ @$row->medium_image }}" class="w-100 h-auto" width="100"
                                                    height="100" loading="lazy" alt="{{ @$row->title }}"
                                                    title="{{ @$row->title }}" />
                                            @endif
                                        </div>
                                        <div class="col-8 p-1">
                                            <p class="m-0 fm-md">
                                                {{ @$row->title }}
                                            </p>
                                            @if (@$row->price != null && @$row->price != 0 && @$row->count > 0)
                                                <div class=" mt-2 prices text-end">
                                                    <p class="price fm-eb m-0">{{ number_format(@$row->price) }}
                                                        <span>تومان</span></p>

                                                    <div
                                                        class="d-flex justify-content-end align-items-end mt-1 text-end">
                                                        @if (@$row->price != null && @$row->price != 0 && @$row->old_price != 0 && @$row->count > 0)
                                                            <span class="discounted me-auto">
                                                                {{ round((($row->old_price - $row->price) * 100) / $row->old_price) }}%</span>
                                                        @endif
                                                        <del> {{ number_format(@$row->old_price) }}</del>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="text-end mt-3 price">
                                                    @if ($row->old_price == 0 || $row->count == 0)
                                                        <p class="fm-eb m-0">تماس بگیرید</p>
                                                    @else
                                                        <p class="fm-eb m-0"> {{ number_format(@$row->old_price) }}
                                                            <span>تومان</span>
                                                        </p>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next swiper-button-next-6"></div>
                <div class="swiper-button-prev swiper-button-prev-6"></div>
            </div>
        </div>
    </section>
@endif
