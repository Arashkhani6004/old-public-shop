{{--@if($brands->count() > 0)--}}
<section class="pro brands">
    <div class="container">
        <div class="text-center py-3">
            <h4 class="h5 ismb text-a my-0">
                برندهای محصولات
            </h4>
            <p class="text-secondary my-0">
                پر طرفدارترین و برترین برندهای جهان را گرد هم جمع کرده ام
            </p>
        </div>
        <div class="barline position-relative px-1">
            <hr>
            <div class="imgbox">

                    <img src="{{asset('assets/site/images/logo1.png')}}" class="" loading="lazy">
              		</div>
        </div>
        <div class="p-1">
            <section id="demos">
                <div class="row w-100 m-0">
                    <div class="large-12 px-0 columns">
                        <div class="owl-carousel-brand owl-theme">

                            <div class="item">
                                <a href="{{url('/site-guide/brand/det')}}">
                                    <div class="card rounded-0">
                                        <figure>
                                            <div class="figure-inn">
                                                <img src="{{asset('assets/site/images/brand.png')}}"
                                                     alt="" loading="lazy" />
                                            </div>
                                        </figure>
                                    </div>
                                </a>
                            </div>


                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

