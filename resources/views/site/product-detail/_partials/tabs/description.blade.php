<p class="fm-b">
    توضیحات تکمیلی محصول
</p>
@if ($product->description != null)
    <div class="description content">
        <input type="checkbox" id="expanded">
        <div id="description-text" class="">
            {!! @$product->description !!}
        </div>
        <label id="show-more-btn" for="expanded" class="primary-color btn-more  fs-6 d-none">مشاهده بیشتر</label>
    </div>
@else
    <div class="col-xxl-2 col-xl-3 col-6 m-auto p-0">
        <img src="{{ asset('assets/site/images/empty-states/des-empty.svg') }}" class="w-100" alt="empty"
            title="empty" loading="lazy" />
    </div>
    <p class="text-center text-dark small">
        هنوز توضیحی راجع به این محصول وجود ندارد!
    </p>
@endif



