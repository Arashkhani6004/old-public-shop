@if (count($timer_products) > 0)
    <section class="offer-products ">
        <div class="container">
            <div class="title d-flex align-items-center justify-content-between">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <p class="m-0 fm-eb">
                        محصولات شگفت انگیز
                    </p>
                </div>
                <a href="{{ url('/incredible-offers') }}" class="link text-dark fm-re d-flex align-items-center">
                    مشاهده همه
                    <i class="bi bi-arrow-left-short d-flex ms-1"></i>
                </a>
            </div>
            <div class="row w-100 m-0 align-items-center position-relative mt-sm-0 mt-3">
                <div class="col-xxl-side col-xl-2 col-md-5 col-sm-4 col-12 p-2">
                    <div class="offer-side text-center primary-light-bg">
                        @if (file_exists('assets/uploads/content/set/' . @$setting_header->special_img) && $setting_header->special_img != null)
                            <img src="{{ asset('assets/uploads/content/set/' . @$setting_header->special_img) }}"
                                class="offer-icon h-auto d-sm-block d-none" width="240" height="200"
                                alt="{{ @$setting_header->title_2 }}" title="{{ @$setting_header->title_2 }}"
                                loading="lazy" />
                        @else
                            <img src="{{ asset('assets/site/images/offer-icon.png') }}"
                                class="offer-icon h-auto d-sm-block d-none" width="240" height="200"
                                alt="{{ @$setting_header->title_2 }}" title="{{ @$setting_header->title_2 }}"
                                loading="lazy" />
                        @endif
                    </div>
                </div>
                <div class="col-xxl-custom col-xl-10 col-md-7 col-sm-8 col-12 p-2 position-relative mt-sm-0 mt-2">
                    <div class="swiper mySwiper p-2">
                        <div class="swiper-wrapper">
                            @foreach ($timer_products as $timer)
                                <div class="swiper-slide">
                                    <a href="{{ route('site.product.detail', ['id' => @$timer->url]) }}"
                                        class="text-dark d-flex">
                                        <div class="product-card row w-100 m-0 bg-white ">
                                            <div class="col-md-12 p-0">
                                                @if (count($timer->variable) > 0)
                                                    <img src="{{ @$timer->variable[0]->medium_image }}"
                                                        alt="{!! @$timer->title !!}" title="{!! @$timer->title !!}"
                                                        width="190" height="190" class="w-100 h-auto"
                                                        loading="lazy" />
                                                @else
                                                    <img src="{{ @$timer->medium_image }}" alt="{!! @$timer->title !!}"
                                                        title="{!! @$timer->title !!}" width="190" height="190"
                                                        class="w-100 h-auto" loading="lazy" />
                                                @endif
                                            </div>
                                            <div class="col-md-12 p-0">
                                                <p class="m-0 fm-b text-start mt-2 title">
                                                    {!! @$timer->title !!}
                                                </p>
                                                @php
                                                    $old = isset($timer->price_first['old'])
                                                        ? (int) filter_var(
                                                            $timer->price_first['old'],
                                                            FILTER_SANITIZE_NUMBER_INT,
                                                        )
                                                        : 0;
                                                    $new = isset($timer->price_first['price'])
                                                        ? (int) filter_var(
                                                            $timer->price_first['price'],
                                                            FILTER_SANITIZE_NUMBER_INT,
                                                        )
                                                        : 0;
                                                @endphp
                                                <div class=" mt-3 price text-end">
                                                    <p class="fm-eb m-0">{{ number_format($new) }} <span>تومان</span>
                                                    </p>
                                                    @if (@$timer->calcute > 0)
                                                        <div
                                                            class="d-flex align-items-center justify-content-between text-end mt-1">
                                                            <span class="discount fm-b">
                                                                {{ round((($old - $new) * 100) / $old) }}
                                                                %
                                                            </span>
                                                            <del class="fm-re">{{ number_format($old) }}</del>
                                                        </div>
                                                    @endif
                                                </div>
                                                @php
                                                    $date = \Carbon\Carbon::parse(@$timer->date);
                                                @endphp
                                                <div
                                                    class="d-flex align-items-center justify-content-between timer mt-3">

                                                    <ul class="p-0 m-0 d-flex align-items-center gap-1 countdown"
                                                        data-date="{{ $date->format('m/d/Y H:i:s') }}">
                                                        <li class="seconds fm-b"></li>
                                                        :
                                                        <li class="minutes fm-b"></li>
                                                        :
                                                        <li class="hours fm-b"></li>
                                                        <li class="days fm-b">

                                                        </li>
                                                    </ul>
                                                    <img src="{{ asset('assets/site/images/offer.svg') }}"
                                                        width="24" height="24" alt="..." title="..."
                                                        loading="lazy" />
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-button-next swiper-button-next-1"></div>
                    <div class="swiper-button-prev swiper-button-prev-1"></div>
                </div>
            </div>
        </div>
    </section>
@endif
