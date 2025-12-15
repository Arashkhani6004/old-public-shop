@if (count($product->variable) > 0 && $product->count > 0)
    <template v-if="variable == 1 && variablePrice != 0">
        <button type="button"
            class="btn dynamic-color py-3 primary-btn d-flex align-items-center justify-content-center w-100 rounded-12"
            @click="addToCart2({{ $product->id }},quantity,true,variableId)">
            <i class="bi bi-cart3 d-flex me-2"></i>
            اضافه به سبد خرید

        </button>
    </template>
    <template v-else="">
        <p class="m-0 text-product-detail fm-re rounded-12 w-100 text-center">
            ناموجود
        </p>
    </template>
@else
    @if ($product->count > 0 && $product->old_price !== 'ندارد' && $product->old_price !== 0)
        <button type="button"
            class="btn dynamic-color py-3 primary-btn d-flex align-items-center justify-content-center w-100 rounded-12"
            @click="addToCart2({{ $product->id }},quantity,true,)">
            <i class="bi bi-cart3 d-flex me-2"></i>
            اضافه به سبد خرید

        </button>
    @endif
@endif
