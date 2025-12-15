<div class="d-md-block d-none">
    <div class="price-inn text-center mt-3">
        @include('help.product-detail._partials.components.price')
    </div>
    <div class="row w-100 m-0 mt-3">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 m-xl-0 m-auto px-1 mb-xl-0 mb-2 align-self-center"
            v-if="variable == 1 && variablePrice != 0">
            @include('help.product-detail._partials.components.counter')
        </div>
        <div
            :class="(variable == 1 && variablePrice != 0) ?
            'col-xxl-8 col-xl-7 col-lg-12 m-xl-0 m-auto px-1 align-self-center' :
            'col-12 px-1'">
            <div class="add-to-cart d-flex justify-content-center ">
                @include('help.product-detail._partials.components.cart-btn')
            </div>
        </div>

    </div>
</div>
