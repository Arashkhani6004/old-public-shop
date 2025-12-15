<div class="row w-100 m-0">
    <div class="col-lg-12 col-12 p-2">
        <p class="font-md mb-2 d-flex align-items-center">
            <i class="bi bi-caret-left-fill fs-4 me-1 d-flex color-theme-one"></i>
            بررسی عملکرد {{ $product->title }}
        </p>
        @if (isset($product->video_link))
            <div class="video-tab-item position-relative">
                <div class="iframe-parent">
                    {!! $product->video_link !!}
                </div>
            </div>
        @else
            <div class="col-xxl-2 col-xl-3 col-6 m-auto p-0">
                <img src="{{ asset('assets/site/images/empty-states/des-empty.svg') }}" class="w-100" alt="empty"
                    title="empty" loading="lazy" />
            </div>
            <p class="text-center text-dark small">
                هنوز ویدیو ای راجع به این محصول وجود ندارد!
            </p>
        @endif
    </div>
</div>
