@if(count($categories) > 0)
<section class="category ">
    <div class="container">
        <div class="title d-flex align-items-center justify-content-between">
            <div class="right d-flex align-items-center">
                <span class="icon me-sm-2 me-1"></span>
                <p class="m-0 fm-eb">
                    دسته بندی محصولات
                </p>
            </div>
            <a href="{{url('/categories')}}" class="link text-dark fm-re d-flex align-items-center">
                مشاهده همه
                <i class="bi bi-arrow-left-short d-flex ms-1"></i>
            </a>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-md-4 gap-3 justify-content-xl-between justify-content-center mt-4">
            @foreach($categories as $cat)
            <div class="cat-card">
                <a href="{{route('site.product.list',['id'=>@$cat->url])}}" class="text-dark">
                    <img src="{{@$cat->cat_image}}" width="112" height="112"
                        class="" loading="lazy" alt="{{@$cat->title}}" title="{{@$cat->title}}" />
                    <p class="fm-md text-center small mt-2 mb-0">
                        {{@$cat->title}}
                    </p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
