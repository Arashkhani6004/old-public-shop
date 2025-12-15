@if (count($articles) > 0)
    <section class="blogs">
        <div class="container">
            <div class="title d-flex align-items-center justify-content-between">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <p class="m-0 fm-eb">
                        دانستنی ها
                    </p>
                </div>
                <a href="{{url('/blogs')}}" class="link text-dark fm-re d-flex align-items-center">
                    مشاهده همه
                    <i class="bi bi-arrow-left-short d-flex ms-1"></i>
                </a>
            </div>
            <div class="row w-100 m-0 align-items-center mt-3 position-relative">
                <div class="p-0">
                    <div class="swiper mySwiper-blogs">
                        <div class="swiper-wrapper">
                            @foreach ($articles as $article)
                                <div class="swiper-slide">
                                    <a href="{{ route('site.blog.detail', ['id' => @$article->id]) }}" class="d-block">
                                        <div class="blog-card">
                                            <div class="position-relative">
                                                <span class="cat">
                                                    {{@$article->cat->title}}

                                                </span>
                                                <img src="{{ asset('assets/uploads/content/art/medium/' . $article->image) }}"
                                                    alt="{!! @$article->title !!}" title="{!! @$article->title !!}"
                                                    class="w-100 h-auto " width="450" height="300"
                                                    loading="lazy" />
                                            </div>

                                            <p class="title m-0 mt-2 fm-b">
                                                {!! @$article->title !!}
                                            </p>
                                            <div class="date d-flex align-items-center mt-3">
                                                <i class="bi bi-calendar4-event d-flex me-1"></i>
                                                <span class="fm-b">
                                                    {{ jdate('d F Y', @$article->created_at->timestamp) }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-button-next swiper-button-next-7"></div>
                    <div class="swiper-button-prev swiper-button-prev-7"></div>
                </div>
            </div>
        </div>
    </section>
@endif
