<div class="sort-form mb-2">
    <ul class="p-0 m-0">
        <li class="list-unstyled">
            <div class="form-check form-switch">
                <input class="form-check-input" value="1" type="checkbox" role="switch" id="discounted"
                    @change="filterBrands()" v-model = "available" />
                <label class="form-check-label w-100 small" for="discounted">محصولات تخفیف دار</label>
            </div>
        </li>
    </ul>
</div>
<div class="sort-form mb-2">
    <ul class="p-0 m-0">
        <li class="list-unstyled">
            <div class="form-check form-switch">
                <input class="form-check-input" value="1" type="checkbox" role="switch" id="available"
                    @change="filterBrands()" v-model = "discount" />
                <label class="form-check-label w-100 small" for="available">محصولات موجود</label>
            </div>
        </li>
    </ul>
</div>
<div class="accordion-item">
    <p class="accordion-header">
        <button class="accordion-button collapsed dynamic-color" type="button" data-bs-toggle="collapse"
            data-bs-target="#filter-two" aria-expanded="false" aria-controls="filter-two">
            دسته بندی
        </button>
    </p>
    <div id="filter-two" class="accordion-collapse collapse" data-bs-parent="#accordionFilter">
        <div class="accordion-body categories">
            @include('site.brand-detail.components.category')
        </div>
    </div>
</div>