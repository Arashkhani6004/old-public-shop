@if (count($most_products) > 0)
    <section class="offer-products ">
        <div class="container">
            <div class="title d-flex align-items-center justify-content-between">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <p class="m-0 fm-eb">
                        {{ @$setting_header->title_2 }}
                    </p>
                </div>
                <a href="{{ url('/bestselling') }}" class="link text-dark fm-re d-flex align-items-center">
                    مشاهده همه
                    <i class="bi bi-arrow-left-short d-flex ms-1"></i>
                </a>
            </div>
            <div class="row w-100 m-0 align-items-center position-relative mt-sm-0 mt-3">
                <div class="col-xxl-side col-xl-2 col-md-5 col-sm-4 col-12 p-2">
                    <div class="offer-side text-center secondary-bg">
                        <p class="fm-eb m-0">انتخاب‌های مشتریان</p>
                        <a href="{{ url('/bestselling') }}"
                            class="d-sm-flex d-none justify-content-center align-items-center small text-dark fm-re my-3">
                            مشاهده همه
                            <i class="bi bi-arrow-left-short d-flex ms-1"></i>
                        </a>
                        @if (isset($setting_header->logo2))
                            <img src="{{ $setting_header->logo_image }}" class="offer-icon h-auto d-sm-block d-none"
                                width="250" height="200" alt="{{ @$setting_header->title_2 }}"
                                title="{{ @$setting_header->title_2 }}" loading="lazy" />
                        @else
                            <img src="{{ asset('assets/site/images/sale-icon.png') }}"
                                class="offer-icon h-auto d-sm-block d-none" width="250" height="200"
                                alt="{{ @$setting_header->title_2 }}" title="{{ @$setting_header->title_2 }}"
                                loading="lazy" />
                        @endif
                    </div>
                </div>
                <div class="col-xxl-custom col-xl-10 col-md-7 col-sm-8 col-12 p-2 position-relative mt-sm-0 mt-5">
                    <div class="swiper mySwiper-sale p-2">
                        <div class="swiper-wrapper">
                            @foreach ($most_products as $row)
                                <div class="swiper-slide">
                                    <a href="{{ route('site.product.detail', ['id' => $row->url]) }}"
                                        class="text-dark d-flex">
                                        <div class="product-card row w-100 m-0 bg-white ">
                                            <div class="col-md-12 p-0">
                                                @if (count($row->variable) > 0)
                                                    <img src="{{ $row->variable[0]->medium_image }}"
                                                        alt="{{ @$row->title }}" title="{{ @$row->title }}"
                                                        width="190" height="190" class="w-100 h-auto"
                                                        loading="lazy" />
                                                @else
                                                    <img src="{{ @$row->medium_image }}" alt="{{ @$row->title }}"
                                                        title="{{ @$row->title }}" width="190" height="190"
                                                        class="w-100 h-auto" loading="lazy" />
                                                @endif
                                            </div>
                                            <div class="col-md-12 p-0">
                                                <p class="m-0 fm-md text-start mt-2 title">
                                                    {{ @$row->title }}
                                                </p>
                                                @if (@$row->price != null && @$row->price != 0 && @$row->count > 0)
                                                    <div class="text-end mt-3 price">
                                                        <p class="fm-eb m-0">{{ number_format(@$row->price) }}
                                                            <span>تومان</span>
                                                        </p>

                                                        <div
                                                            class=" text-end d-flex justify-content-between align-items-center mt-1">
                                                            @if (@$row->price != null && @$row->price != 0 && @$row->old_price != 0 && @$row->count > 0)
                                                                <span class="discount fm-b me-auto mt-auto">
                                                                    {{ round((($row->old_price - $row->price) * 100) / $row->old_price) }}%</span>
                                                            @endif
                                                            <del
                                                                class="fm-re">{{ number_format(@$row->old_price) }}</del>
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
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="swiper-button-next swiper-button-next-3"></div>
                    <div class="swiper-button-prev swiper-button-prev-3"></div>
                </div>
            </div>
        </div>
    </section>
@endif
