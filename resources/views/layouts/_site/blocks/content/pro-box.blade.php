<a :href="product.url" >ss
    <div class="card border px-1 py-2">
        <div class="disc text-white d-flex align-items-center justify-content-center" v-if="product.calcute != 0 && product.stock > 0">
            @{{ product.calcute }}%
        </div>
        <figure>
            <div class="figure-inn">
                <img :data-src="product.image" :src="product.image"  :alt="product.title" />
            </div>
        </figure>
        <p class="h6 mb-0 text-secondary">
            @{{ product.title }}
        </p>
        <div class="row w-100 m-0 justify-content-between">
            <div class=" col-sm-6 col-xs-6 p-0 align-self-center" v-if="product.stock > 0 && product.price !== 'ندارد' && product.price !== 0 && product.price !== '' " >
                <del class="text-danger">
                    @{{ product.old_priceNmber }} 
                    
                </del>
                <p class="m-0 text-secondary text-end" >
                    @{{ product.priceNmber }} 
                </p>
            </div>
            <div class="col-sm-6 col-xs-6 p-0 align-self-center"
                v-if="product.stock > 0 && product.old_price !== 0 &&  product.old_price !== 'ندارد'  && product.price == 'ندارد' || product.price == 0 && product.soon == 0 ">
                <p class="m-0 text-secondary text-end" v-if="product.old_price > 0 && product.stock > 0">
                    @{{ product.old_priceNmber }} 
                </p>
            </div>
            <div class="col-sm-12 col-xs-12 p-0 align-self-center" v-if="product.soon == 1">
                <p class="m-0 text-secondary text-center fw-bolder" >
                    بزودی ...
                </p>
            </div>
            <div class="col-sm-12 col-xs-12 p-0 align-self-center" v-else>
                <div class="col-sm-12 col-xs-12 p-0 align-self-center" v-if="product.old_price == 0 && product.price == 0 || product.stock == 0 || product.stock == null">
                    <p class="m-0 text-secondary text-center fw-bolder" >
                         @if($setting_header->product_button_text == 1)
                                                        تماس بگیرید
                                                    @else
                                                        ناموجود
                                                    @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</a>
