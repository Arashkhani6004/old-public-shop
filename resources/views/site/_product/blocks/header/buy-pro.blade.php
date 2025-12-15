<div
    class="bg-l rounded-custom pro-buy d-flex align-items-center justify-content-center py-lg-5 py-md-4 py-sm-3 py-xs-2 position-relative">
    <div class="d-lg-block d-sm-none d-xs-none">
        @if (count($product->variable) > 0)
            <div class="disc text-white d-flex align-items-center justify-content-center" v-if="(percent != '' )">
                @{{ percent }}%
            </div>
        @else
            @if (
                @$product->count &&
                    $product->count > 0 &&
                    @$product->price != null &&
                    @$product->price != 0 &&
                    $product->old_price != 0 &&
                    round(((@$product->old_price - @$product->price) / @$product->old_price) * 100) > 0)
                <div class="disc text-white d-flex align-items-center justify-content-center">
                    {{ round((($product->old_price - $product->price) * 100) / $product->old_price) }}%
                </div>
            @endif
        @endif
    </div>

    <div class="row w-100 m-0">
        @if (count($product->variable) > 0 && $product->count > 0)
            <div v-if="variable == 1 && variablePrice != 0">
                <div class="col-xxl-8 col-lg-11 mx-auto p-1 d-lg-block d-sm-none d-xs-none">
                    @include('site.product.blocks.header.change-number')
                </div>
                <div class="col-xxl-8 col-lg-11 mx-auto p-1 d-lg-block d-sm-none d-xs-none">
                    <button type="submit"
                        class="btn btn-lg w-100 btn-pro-buy d-flex align-items-center justify-content-center "
                        @click="addToCart2({{ $product->id }},quantity,true,variableId)">
                        <i class="bi bi-plus h2 my-0 d-flex me-2"></i>
                        افزودن به سبد خرید
                    </button>
                </div>
            </div>
            <div v-else>
                <div class="col-xxl-8 col-lg-11 mx-auto p-1 d-lg-block d-sm-none d-xs-none">
                    @include('site.product.blocks.header.change-number')
                </div>
                <div class="col-xxl-8 col-lg-11 mx-auto p-1 d-lg-block d-sm-none d-xs-none">
                    <button disabled type="submit"
                        class="btn btn-lg w-100 btn-pro-buy d-flex align-items-center justify-content-center ">
                        ناموجود
                    </button>
                </div>
            </div>
        @else
            @if ($product->count > 0)
                <div class="col-xxl-8 col-lg-11 mx-auto p-1 d-lg-block d-sm-none d-xs-none">
                    @include('site.product.blocks.header.change-number')
                </div>
                <div class="col-xxl-8 col-lg-11 mx-auto p-1 d-lg-block d-sm-none d-xs-none">
                    @if ($product->count > 0 && $product->old_price !== 'ندارد' && $product->old_price !== 0)
                        <button type="submit"
                            class="btn btn-lg w-100 btn-pro-buy d-flex align-items-center justify-content-center "
                            @click="addToCart2({{ $product->id }},quantity,true,)">
                            <i class="bi bi-plus h2 my-0 d-flex me-2"></i>
                            افزودن به سبد خرید
                        </button>
                    @else
                        <button disabled type="submit"
                            class="btn btn-lg w-100 btn-pro-buy d-flex align-items-center justify-content-center ">
                            ناموجود
                        </button>
                    @endif
                </div>
            @else
                <button disabled type="submit"
                    class="btn btn-lg w-100 btn-pro-buy d-flex align-items-center justify-content-center ">
                    @if ($setting_header->product_button_text == 1)
                        تماس بگیرید
                    @else
                        ناموجود
                    @endif


                </button>
            @endif
        @endif
    </div>
</div>
