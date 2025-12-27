
<div class="reply-comment col-11 ms-5 mt-2 border rounded-4">
    <div class="header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <img src="{{asset('assets/site/images/avatar.png')}}" class="me-2" width="30" height="30" loading="lazy"
                alt="avatar" title="avatar">
            <p class="m-0 fm-eb">
                {{ @$reply->user->name . ' ' . @$reply->user->family }}
            </p>
        </div>

    </div>
    <div class="body mt-0 ms-5">
        <p class="fm-b m-0 mb-0">
            {{ @$reply->title }}
        </p>
        <p class="fm-re m-0">
            {{ @$reply->content }}
        </p>
{{--        <ul class="d-flex align-items-center gap-2 flex-wrap images-sent p-0 m-0 mt-2">--}}
{{--            <li data-bs-toggle="modal" data-bs-target="#commentImagesModalReply{{ $key }}">--}}
{{--                <figure>--}}
{{--                    <div class="figure-in">--}}
{{--                        <img src="{{ asset('assets/site/images/pro2.jpg') }}" alt="" title=""--}}
{{--                            loading="lazy" />--}}

{{--                    </div>--}}
{{--                </figure>--}}
{{--            </li>--}}
{{--             <li data-bs-toggle="modal" data-bs-target="#commentImagesModalReply{{ $key }}">--}}
{{--                <figure>--}}
{{--                    <div class="figure-in">--}}
{{--                        <img src="{{ asset('assets/site/images/pro3.jpg') }}" alt="" title=""--}}
{{--                            loading="lazy" />--}}

{{--                    </div>--}}
{{--                </figure>--}}
{{--            </li>--}}
{{--        </ul>--}}
        {{-- comment images modal --}}
        <div class="modal fade" id="commentImagesModalReply{{ @$key }}" tabindex="-1"
            aria-labelledby="commentImagesModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered comments-images-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title fs-6" id="exampleModalLabel">تصاویر کاربران</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="swiper mySwiper2 mb-2">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                                </div>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <div thumbsSlider="" class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
