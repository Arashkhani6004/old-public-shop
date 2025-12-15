<a href="{{url('/site-guide/pro/det')}}">
    <div class="card border px-1 py-2">
        <div class="disc text-white d-flex align-items-center justify-content-center" v-if="product.calcute != 0 && product.stock > 0">
           10%
        </div>
        <figure>
            <div class="figure-inn">

                <img src="{{asset('assets/site/images/product.png')}}" class="swiper-lazy text-secondary h6" loading="lazy">
            </div>
        </figure>
        <p class="h6 mb-0 text-secondary">
            نام محصول
        </p>
        <div class="row w-100 m-0 justify-content-between">
            <div class="col-sm-6 col-xs-6 p-0 align-self-center">
                <del class="text-danger">
                 100،000 تومان
                </del>
            </div>
            <div class=" col-sm-6 col-xs-6 p-0 align-self-center">
                <p class="m-0 text-secondary text-end" >
                    200،000 تومان
                </p>
            </div>
        </div>
    </div>
</a>
