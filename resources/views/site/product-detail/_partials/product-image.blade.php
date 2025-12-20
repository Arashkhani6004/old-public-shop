@if (count($product->variable) > 0)
    <div class="product-image">
        <div class="tab-content" id="pills-tabContent">
            @foreach ($product->variable as $key => $v)
                <div class="tab-pane fade @if ($key == 0) show active @endif"
                    id="pills-{{ $v->id }}" role="tabpanel" aria-labelledby="pills-{{ $v->id }}-tab"
                    tabindex="0">
             
                    <div class="app-figure" id="zoom-fig">
                        <a id="Zoom-1" class="MagicZoom d-flex justify-content-center align-items-center image-large"
                            href="{{ $v->big_image }}" data-zoom-image-2x="{{ $v->big_image }}"
                            data-image-2x="{{ $v->big_image }}">
                            <img src="{{ $v->big_image }}" srcset="{{ $v->big_image }} 2x" alt="{{ @$product->title }}"
                                title="{{ @$product->title }}" width="100%" />
                        </a>
                        <div class="selector mt-3">
                            <div class="swiper swiper-selector">
                                <div class="swiper-wrapper">
                                    @foreach ($v->images as $image)
                                        <div class="swiper-slide">
                                            <button class="selector-item w-100 p-0" data-zoom-id="Zoom-1"
                                                href="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}"
                                                data-image="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}"
                                                data-zoom-image-2x="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}"
                                                data-image-2x="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}">
                                                <img class="p-0"
                                                    srcset="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }} 2x"
                                                    src="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}"
                                                    width="100%" alt="{{ @$product->title }}"
                                                    title="{{ @$product->title }}" />

                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="product-image">
        <div class="app-figure" id="zoom-fig">
            <a id="Zoom-12" class="MagicZoom d-flex justify-content-center align-items-center image-large"
                href="{!! $product->pro_image !!}" data-zoom-image-2x="{!! $product->pro_image !!}"
                data-image-2x="{!! $product->pro_image !!}">
                <img src="{!! $product->pro_image !!}" srcset="{!! $product->pro_image !!} 2x" alt="{!! $product->title !!}"
                    title="{!! $product->title !!}" width="100%" />
            </a>
            <div class="selector mt-3">
                <div class="swiper swiper-selector">
                    <div class="swiper-wrapper">
                        @foreach ($product->images as $image)
                            <div class="swiper-slide">
                                <button class="selector-item w-100 p-0" data-zoom-id="Zoom-12"
                                    href="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}"
                                    data-image="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}"
                                    data-zoom-image-2x="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}"
                                    data-image-2x="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}">
                                    <img class="p-0"
                                        srcset="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }} 2x"
                                        src="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}"
                                        width="100%" alt="pro-title" title="pro-title" />

                                </button>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

            </div>
        </div>
    </div>
@endif
