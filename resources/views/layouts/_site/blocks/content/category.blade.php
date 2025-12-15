<section class="cat bg-a-light py-5 my-3">
    <div class="container">
        <div class="row w-100 m-0 px-1">
            @foreach($categories as $cat)
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    <a href="{{route('site.product.list',['id'=>@$cat->url])}}">
                        <figure>
                            <div class="figure-inn rounded-0">
                                <img src="{{@$cat->cat_image}}" class="categories-Img" width="1" height="1" alt="{{@$cat->title}}" loading="lazy" />
                            </div>
                        </figure>
                        <h2 class="h5 fw-bolder text-a">
                            {{@$cat->title}}
                        </h2>
                        <!--<p class="text-secondarsy">-->
                        <!--    {!! strip_tags(\Illuminate\Support\Str::limit(@$cat->description,100)) !!}-->
                        <!--</p>-->
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
