<div class="row w-100 m-0">
    <div class="col-xl-3 col-lg-4 col-md-5 p-1 pe-lg-2">
        <div class="comment-form">
            <form method="post" action="{{ URL::action('Site\HomeController@postComment') }}"
                enctype="multipart/form-data" class="m-0">
                {{ csrf_field() }}
                <input type="hidden" name="commentable_id" value="{{ $product->id }}">
                <input type="hidden" name="commentable_type" value="{{ 'App\Models\Product' }}">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label small mb-1 fm-li">
                        موضوع
                    </label>
                    <input type="text" class="form-control" name="title" id="exampleFormControlInput1"
                        placeholder="موضوع">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label small mb-1 fm-li">نظر</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <p class="small mb-1 fm-li">امتیاز شما به این محصول :</p>
                    <div class="star-rating">
                        <input id="star-5" type="radio" name="rating" value="star-5" />
                        <label for="star-5" title="5 stars">
                            <i class="active bi bi-star-fill" aria-hidden="true"></i>
                        </label>
                        <input id="star-4" type="radio" name="rating" value="star-4" />
                        <label for="star-4" title="4 stars">
                            <i class="active bi bi-star-fill" aria-hidden="true"></i>
                        </label>
                        <input id="star-3" type="radio" name="rating" value="star-3" />
                        <label for="star-3" title="3 stars">
                            <i class="active bi bi-star-fill" aria-hidden="true"></i>
                        </label>
                        <input id="star-2" type="radio" name="rating" value="star-2" />
                        <label for="star-2" title="2 stars">
                            <i class="active bi bi-star-fill" aria-hidden="true"></i>
                        </label>
                        <input id="star-1" type="radio" name="rating" value="star-1" checked />
                        <label for="star-1" title="1 star">
                            <i class="active bi bi-star-fill" aria-hidden="true"></i>
                        </label>
                    </div>
                </div>
                <div class="upload__box mb-3">
                    <div class="upload__btn-box">
                        <label class="upload__btn">
                            <i class="bi bi-image d-flex fs-5"></i>
                            <p class="small mb-0 fm-li">افزودن عکس</p>
                            <input type="file" multiple="" data-max_length="20" class="upload__inputfile">
                        </label>
                    </div>
                    <div class="upload__img-wrap"></div>
                </div>
                <button type="submit" class="btn btn-form position-relative">ثبت</button>
            </form>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8 col-md-7 p-1 ps-lg-2 align-content-center">
        @if (count($comments) > 0)
            @foreach ($comments as $key => $comment)
                <div class="main-comment mb-2">
                    <div class="header d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="assets/site/images/avatar.png" class="me-2" width="30" height="30"
                                loading="lazy" alt="avatar" title="avatar">
                            <p class="m-0 fm-b">
                                {{ @$comment->user->name . ' ' . @$comment->user->family }}
                            </p>
                        </div>
                        <!-- reply button -->
                        <button type="button" class="btn border-0 bg-transparent shadow-none p-0"
                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ @$comment->id }}">
                            <i class="bi bi-reply d-flex fs-5"></i>
                        </button>

                    </div>
                    <div class="body mt-3">
                        <p class="fm-md m-0 mb-2">
                            {{ @$comment->title }}
                        </p>
                        <p class="fm-re m-0">
                            {{ @$comment->content }}
                        </p>
                        <ul class="d-flex align-items-center gap-2 flex-wrap images-sent p-0 m-0 mt-2">
                            <li data-bs-toggle="modal" data-bs-target="#commentImagesModal{{ $key }}">
                                <figure>
                                    <div class="figure-in">
                                        <img src="{{ asset('assets/site/images/pro1.jpg') }}" alt=""
                                            title="" loading="lazy" />

                                    </div>
                                </figure>
                            </li>
                        </ul>
                        {{-- comment images modal --}}
                        <div class="modal fade" id="commentImagesModal{{ @$key }}" tabindex="-1"
                            aria-labelledby="commentImagesModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <p class="modal-title fs-6" id="exampleModalLabel">تصاویر کاربران</p>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div
                                            class="swiper mySwiper2">
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
                <!-- reply form modal -->
                @include('site.product-detail._partials.tabs.reply-modal')
                @foreach ($comment->replies as $reply)
                    @include('site.product-detail._partials.tabs.reply-comment')
                @endforeach
            @endforeach
        @else
            <div class="col-xxl-2 col-xl-3 col-6 m-auto p-0">
                <img src="{{ asset('assets/site/images/empty-states/cm-empty.svg') }}" class="w-100" alt="empty"
                    title="empty" loading="lazy" />
            </div>
            <p class="text-center text-dark small">
                هنوز نظری راجع به این محصول وجود ندارد!
            </p>
        @endif
    </div>
</div>
