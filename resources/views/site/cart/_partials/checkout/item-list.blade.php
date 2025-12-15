<div class="row w-100 m-0" v-if="cartItem.productQuantity > 0">
    <div class="col-xxl-2 col-lg-3 col-sm-4 col-3 p-1">
        <img :src="cartItem.productImage" :alt="cartItem.productTitle" :title="cartItem.productTitle" loading="lazy"
            class="w-100 rounded-4">
    </div>
    <div class="col-xxl-10 col-lg-9 col-sm-8 col-9 p-2 pe-md-2 pe-5">
        <div class="name mt-2 pe-4">
            <p class="fm-b mb-1">
                @{{ cartItem.productTitle }}
            </p>
        </div>
        <div class="price mt-md-3 mt-2">
            <div class="d-flex align-items-center">
                <p class="fm-b m-0 me-2 d-md-block d-none">
                    قیمت :
                </p>
                <div class="d-md-flex align-items-center gap-4">
                    <p class="fm-md m-0">
                        @{{ cartItem.itemPrice }} تومان
                    </p>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center mt-3">
            <div class="number d-flex align-items-center justify-content-start ">
                <div v-if="cartItem.productQuantity > 0"
                    class="value-button d-flex align-items-center justify-content-center decrease"
                    @click="minusQnty(cartItem.id),addToCart2(cartItem.productId,cartItem.productQuantity,false,cartItem.specificationId,cartItem.id)">
                    <i class="bi bi-dash"></i> </div>
                <div v-else class="value-button d-flex align-items-center justify-content-center decrease"> <i
                        class="bi bi-dash"></i> </div>
                <input @change="addToCart2(cartItem.productId,cartItem.productQuantity,false,cartItem.specificationId)"
                    type="text" readonly class="fm-re number-input" name="quantity"
                    v-model="cartItem.productQuantity" min="1">
                <div class="value-button d-flex align-items-center justify-content-center increase"
                    @click="plusQnty(cartItem.id),addToCart2(cartItem.productId,cartItem.productQuantity,false,cartItem.specificationId,cartItem.id)">
                    <i class="bi bi-plus"></i>
                </div>
            </div>
        </div>
    </div>
    <button type="button" @click="removeCart(cartItem.productId,cartItem.specificationId)" class="btn btn-trash">
        <i class="bi bi-trash d-flex"></i>
    </button>
</div>
