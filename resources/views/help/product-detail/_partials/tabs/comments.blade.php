<div class="row w-100 m-0">
    <div class="col-xl-3 col-lg-4 col-md-5 p-1 pe-lg-2">
        <div class="comment-form">
            <form class="m-0">
                <div class="mb-3">
                    <label for="testTitle" class="form-label small mb-1 fm-li">
                        موضوع
                    </label>
                    <input type="text" class="form-control" id="testTitle" name="title" placeholder="مثلاً کیفیت محصول">
                </div>
                <div class="mb-3">
                    <label for="testContent" class="form-label small mb-1 fm-li">نظر</label>
                    <textarea class="form-control" id="testContent" name="content" rows="3">این یک نظر تستی است.</textarea>
                </div>
                <button type="button" class="btn btn-form position-relative">ثبت تستی</button>
            </form>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8 col-md-7 p-1 ps-lg-2 align-content-center">


        <div class="main-comment position-relative mb-2">
            <div class="header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/site/images/avatar.png') }}" class="me-2" width="30" height="30" loading="lazy"
                        alt="avatar" title="avatar">
                    <p class="m-0 fm-b">
                        علی رضایی
                    </p>
                </div>
                <!-- reply button -->
                <button type="button" class="btn border-0 bg-transparent shadow-none p-0" data-bs-toggle="modal"
                    data-bs-target="#exampleModal1">
                    <i class="bi bi-reply d-flex fs-5"></i>
                </button>
            </div>
            <div class="body mt-3">
                <p class="fm-md m-0 mb-2">
                    کیفیت محصول عالی بود
                </p>
                <p class="fm-re m-0">
                    من این محصول رو خریدم و خیلی راضی بودم. پیشنهاد میکنم امتحانش کنید.
                </p>
            </div>
        </div>
        <!-- reply form modal -->
        @include('help.product-detail._partials.tabs.reply-modal')

        @include('help.product-detail._partials.tabs.reply-comment')



    </div>
</div>
