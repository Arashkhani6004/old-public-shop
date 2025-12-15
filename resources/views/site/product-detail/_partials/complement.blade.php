<section class="offer-products ">
    <div class="container">
        <div class="title d-flex align-items-center justify-content-between">
            <div class="right d-flex align-items-center">
                <span class="icon me-sm-2 me-1"></span>
                <p class="m-0 fm-eb">
                    محصولات مکمل
                </p>
            </div>
        </div>
        <div class="row w-100 m-0 align-items-center mt-2 position-relative">
            <div class="p-0 sale">
                <div class="swiper mySwiper-sale p-2">
                    <div class="swiper-wrapper">
                        @foreach ($complement as $row)
                            <div class="swiper-slide">
                                <a href="{{ route('site.product.detail', ['id' => $row->url]) }}"
                                    class="text-dark d-flex">
                                    <div class="product-card row w-100 m-0 bg-white ">
                                        <div class="col-md-12 p-0">
                                            <img @if (count($row->variable) > 0) src="{{ asset('assets/uploads/content/pro/big/' . @$row->variable[0]->image) }}" @else src="{{ @$row->pro_image }}" @endif
                                                alt="{{ @$row->title }}" title="{{ @$row->title }}" width="190"
                                                height="190" class="w-100 h-auto" loading="lazy" />
                                        </div>
                                        <div class="col-md-12 p-0">
                                            <p class="m-0 fm-md text-start mt-2 title">
                                                {{ @$row->title }}
                                            </p>
                                            @if (($row->old_price == 0 && $row->price == 0) || $row->count == 0)
                                                <div class="text-end mt-3 price">
                                                    <p class="fm-eb m-0">
                                                        @if ($setting_header->product_button_text == 1)
                                                            تماس بگیرید
                                                        @else
                                                            ناموجود
                                                        @endif
                                                    </p>
                                                </div>
                                            @elseif($row->price > 0)
                                                <div class="text-end mt-3 price">
                                                    <p class="fm-eb m-0">{!! number_format(@$row->price) !!} <span>تومان</span></p>

                                                    <div
                                                        class=" text-end d-flex justify-content-between align-items-center mt-1">
                                                        @if ($row->price > 0 && $row->old_price > 0)
                                                            <span
                                                                class="discount fm-b me-auto mt-auto">{{ round(((@$row->old_price - @$row->price) / @$row->old_price) * 100) }}%</span>
                                                        @endif
                                                        <del class="fm-re">{{ number_format(@$row->old_price) }}</del>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="text-end mt-3 price">
                                                    <p class="fm-eb m-0">{!! number_format(@$row->old_price) !!} <span>تومان</span></p>
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
