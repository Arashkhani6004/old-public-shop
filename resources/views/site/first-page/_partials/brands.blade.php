@if(count($brands) > 0)
<section class="brands">
    <div class="container">
        <div class="title d-flex align-items-center justify-content-between">
            <div class="right d-flex align-items-center">
                <span class="icon me-sm-2 me-1"></span>
                <p class="m-0 fm-eb">
                    برترین برندها
                </p>
            </div>
            <a href="#" class="link text-dark fm-re d-flex align-items-center">
                مشاهده همه
                <i class="bi bi-arrow-left-short d-flex ms-1"></i>
            </a>
        </div>
        <div class="swiper mySwiper-brands mt-3">
            <div class="swiper-wrapper">
                @foreach($brands as $brand)
                <div class="swiper-slide">
                    <a href="{{route('site.brand.detail',['id'=>@$brand->url])}}" class="d-block">
                        <img src="{{@$brand->small_image}}" class="w-100 h-auto" width="237"
                            height="64" alt="{!! @$brand->title !!}" title="{!! @$brand->title !!}" loading="lazy" />
                    </a>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next swiper-button-next-5"></div>
            <div class="swiper-button-prev swiper-button-prev-5"></div>
        </div>
    </div>
</section>
@endif
