<div class="info-name border-bottom d-flex align-items-center justify-content-between">
    <div class="name d-md-block d-none">
        @include('site.product-detail._partials.components.info')
    </div>
    <div class="brand">
        <a href=" {{ @$product->brands->url }}" class="color-title d-flex align-items-start justify-content-end">
            <img src="{{asset('assets/uploads/content/brand/medium/'.@$product->brands->image)}}" width="80px" alt="{{ @$product->brands->title }}"
                title="{{ @$product->brands->title }}" loading="lazy">
        </a>
    </div>
    {{-- {{asset('assets/uploads/brand/medium/'.@$product->brands->image)}} --}}
</div>
