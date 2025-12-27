<h1 class="mb-sm-0 mb-1 fm-eb color-title ">
    @if ($product->title2)
        {{ @$product->title2 }}
    @else
        {{ @$product->title }}
    @endif
</h1>
<div class="category d-flex align-items-center mb-1 flex-wrap font-small fm-b mt-2">
    دسته بندی :
    @if ($product->cats->count() > 0)
        <a href="{{ route('site.product.list', ['id' => $product->cats[0]->url]) }}"
            class="fm-b m-0 font-small text-dark me-2">
            <span class="fm-re">
                {{ @$product->cats[0]->title }}
            </span>
        </a>
    @endif
    @if ($product->cats->count() > 1)
        <a href="{{ route('site.product.list', ['id' => $product->cats[1]->url]) }}"
            class="fm-b m-0 font-small text-dark me-2">
            <span class="fm-re">
                {{ @$product->cats[1]->title }}
            </span>
        </a>
    @endif

    @if ($product->brands)
        <span class="mx-2 text-secondary fm-li">|</span>
        <a href="{{ route('site.brand.detail', ['id' => @$product->brands->url]) }}"
            class="fm-b m-0 font-small text-dark">
            برند : <span class="fm-re"> {{ @$product->brands->title }}</span>
        </a>
    @endif
    <span class="mx-2 text-secondary fm-li">|</span>
    <div class="d-flex align-items-center">
        <i class="bi bi-star-fill fs-6 text-warning d-flex"></i>
        <span class="fm-re ms-1">
            {{ @$averageRating . ' ' . ' ' }}
        </span>
    </div>
    <span class="mx-2 text-secondary fm-li">|</span>
    <div class="d-flex align-items-center">
        <i class="bi bi-chat-left-text fs-6 d-flex"></i>
        <span class="font-small  fm-re ms-2">
            ({{ @$comments_count . ' ' . 'نظر' }} )
        </span>
    </div>


</div>
