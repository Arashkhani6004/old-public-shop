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
                <button type="submit" class="btn btn-form position-relative">ثبت</button>
            </form>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8 col-md-7 p-1 ps-lg-2 align-content-center">
        @if (count($comments) > 0)
            @foreach ($comments as $comment)
                <div class="main-comment position-relative mb-2">
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
