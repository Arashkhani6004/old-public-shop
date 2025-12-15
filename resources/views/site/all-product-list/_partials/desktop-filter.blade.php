<div class="col-xl-3 col-lg-4 p-1 d-lg-block d-none">
    <div class="sidebar">
        <div class="filter">
            <p class="d-flex align-items-center mb-2 fm-b">
                <i class="bi bi-funnel d-flex fs-5 me-1"></i>
                فیلتر محصولات
            </p>

            {{-- @include('site.all-product-list.components.filtered-item') --}}
            <div class="accordion accordion-flush mt-2" id="accordionFilter">
                <div class="accordion-item">
                    <p class="accordion-header">
                        <button class="accordion-button " type="button" data-bs-toggle="collapse"
                            data-bs-target="#filter-one" aria-expanded="true" aria-controls="filter-one">
                            فیلتر قیمت
                        </button>
                    </p>
                    <div id="filter-one" class="accordion-collapse collapse show" data-bs-parent="#accordionFilter">
                        <div class="accordion-body">
                            <div class="row w-100 mx-0 mt-0">
                                <div class="col-6 p-1">
                                    <div class="d-flex align-items-center">
                                        <small class="m-0 color-title">
                                            از
                                        </small>
                                        <input name="min" type="text" min="0" max="1000000"
                                            id="min_price" readonly
                                            oninput="validity.valid||(value='0');"
                                            class="price-range-field fm-re shadow-none form-control form-control-sm border-0 text-center p-2">
                                    </div>
                                </div>
                                <div class="col-6 p-1">
                                    <div class="d-flex align-items-center">
                                        <small class="m-0 color-title">
                                            تا
                                        </small>
                                        <input name="max" type="text" min="0" max="1000000"
                                            id="max_price" readonly
                                            oninput="validity.valid||(value='1000000');"
                                            class="price-range-field fm-re shadow-none form-control form-control-sm border-0 text-center p-2 ">
                                        <small class="m-0 color-title">
                                            تومان
                                        </small>
                                    </div>
                                </div>
                                <div class="col-12 p-1 mt-2 my-auto">
                                    <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                                </div>
                                <button  @click="filterAll()" class="btn primary-btn rounded-3 py-2 btn-submit-filter btn-sm mt-3"
                                    type="submit">
                                    اعمال فیلتر قیمت
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @include('site.all-product-list.components.filters')

            </div>
        </div>

    </div>
</div>
