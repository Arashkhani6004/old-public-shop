<a :href="product.url" class="d-block w-100">
    <div class="product-card row w-100 m-0 bg-white shadow-sm">
        <div class="col-md-12 p-0">
            <img :src="product.image" :alt="product.title" :title="product.title" width="190" height="190"
                class="w-100 h-auto" loading="lazy" />
        </div>
        <div class="col-md-12 p-0">
            <p class="m-0 fm-md text-start mt-2 title">
                @{{ product.title }}
            </p>
            <div class="mt-3 price text-end"
                v-if="product.stock > 0 && product.price !== 'ندارد' && product.price !== 0 && product.price !== '' ">
                <p class="fm-eb m-0 text-dark"> @{{ product.priceNmber }} </p>
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <span class="discount fm-b me-auto mt-auto" v-if="product.calcute != 0 && product.stock > 0">
                        @{{ product.calcute }}%</span>
                    <del class="fm-re">@{{ product.old_priceNmber }}</del>
                </div>
            </div>
            <template
                v-if="product.stock > 0 && product.old_price !== 0 &&  product.old_price !== 'ندارد'  && product.price == 'ندارد' || product.price == 0 && product.soon == 0 ">
                <div class="mt-3 price text-end" v-if="product.old_price > 0 && product.stock > 0">
                    <p class="fm-b m-0 text-dark"> @{{ product.old_priceNmber }}
                    </p>
    
                </div>
            </template>
           
            <div class="mt-3 price text-end" v-if="product.soon == 1">
                <p class="fm-b m-0 text-dark">به زودی...</p>
            </div>
            <template v-else>
                <div class="mt-3 price text-end"
                    v-if="product.old_price == 0 && product.price == 0 || product.stock == 0 || product.stock == null">
                    <p class="fm-b m-0 text-dark">
                        @if ($setting_header->product_button_text == 1)
                            تماس بگیرید
                        @else
                            ناموجود
                        @endif
                    </p>
                </div>
            </template>
        </div>
    </div>
</a>
