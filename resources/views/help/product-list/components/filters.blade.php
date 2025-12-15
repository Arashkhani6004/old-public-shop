<div class="sort-form mb-2">
    <ul class="p-0 m-0">
        <li class="list-unstyled">
            <div class="form-check form-switch">
                <input class="form-check-input" value="1" type="checkbox" role="switch" id="discounted"
                    @change="filterProducts()" v-model = "discount" />
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
                    @change="filterProducts()" v-model = "available" />
                <label class="form-check-label w-100 small" for="available">محصولات موجود</label>
            </div>
        </li>
    </ul>
</div>

<div class="accordion-item">
    <p class="accordion-header">
        <button class="accordion-button collapsed dynamic-color" type="button" data-bs-toggle="collapse"
            data-bs-target="#filter-1" aria-expanded="false" aria-controls="filter-1">
            رنگ
        </button>
    </p>
    <div id="filter-1" class="accordion-collapse collapse" data-bs-parent="#accordionFilter">
        <div class="accordion-body p-2">
            <ul class="p-0 m-0 px-2">
                <li class="list-unstyled m-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-red" @change="filterProducts()" v-model="selected2"
                        name="CheckRed">
                        <label class="form-check-label small" for="filter-red">
                            قرمز
                        </label>
                    </div>
                </li>
                <li class="list-unstyled m-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-blue" @change="filterProducts()" v-model="selected2"
                        name="CheckBlue">
                        <label class="form-check-label small" for="filter-blue">
                            آبی
                        </label>
                    </div>
                </li>
                <li class="list-unstyled m-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-green" @change="filterProducts()" v-model="selected2"
                        name="CheckGreen">
                        <label class="form-check-label small" for="filter-green">
                            سبز
                        </label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="accordion-item">
    <p class="accordion-header">
        <button class="accordion-button collapsed dynamic-color" type="button" data-bs-toggle="collapse"
            data-bs-target="#filter-2" aria-expanded="false" aria-controls="filter-2">
            سایز
        </button>
    </p>
    <div id="filter-2" class="accordion-collapse collapse" data-bs-parent="#accordionFilter">
        <div class="accordion-body p-2">
            <ul class="p-0 m-0 px-2">
                <li class="list-unstyled m-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-small" @change="filterProducts()" v-model="selected2"
                        name="CheckSmall">
                        <label class="form-check-label small" for="filter-small">
                            کوچک
                        </label>
                    </div>
                </li>
                <li class="list-unstyled m-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-medium" @change="filterProducts()" v-model="selected2"
                        name="CheckMedium">
                        <label class="form-check-label small" for="filter-medium">
                            متوسط
                        </label>
                    </div>
                </li>
                <li class="list-unstyled m-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-large" @change="filterProducts()" v-model="selected2"
                        name="CheckLarge">
                        <label class="form-check-label small" for="filter-large">
                            بزرگ
                        </label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
