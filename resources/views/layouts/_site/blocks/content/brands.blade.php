@if($brands->count() > 0)
<section class="pro brands container">
            <p class="h5 ismb text-a my-3 text-center">
                برندهای محصولات
            </p>
        <div class="barline position-relative px-1">
            <hr>
            <div class="imgbox">
                @if(isset($setting_header->logo2))
                    <img  height="100%" width="100%" src="{{asset('assets/uploads/content/set/'.@$setting_header->logo2)}}" alt="لوگو" loading="lazy">
                @endif   
                </div>
        </div>
        <div class="p-1">
            <div dir="rtl" class="swiper mySwiper-brands ">
                <div class="swiper-wrapper ">
                    @foreach($brands as $brand)
                    <div class="swiper-slide">
                        <div class="item">
                            <a href="{{route('site.brand.detail',['id'=>@$brand->url])}}">
                                <div class="card rounded-0">
                                    <figure>
                                        <div class="figure-inn">
                                            <img height="100%" width="100%" src="{{@$brand->small_image}}" alt="{!! @$brand->title !!}"  loading="lazy" />
                                        </div>
                                    </figure>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
</section>
@endif
