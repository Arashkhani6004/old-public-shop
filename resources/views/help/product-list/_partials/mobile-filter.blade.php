<div class="col-6 p-1 filter-mobile p-0 d-lg-none d-block">
    <button type="button"
        class="btn primary-btn d-flex align-items-center w-100 py-1 px-4 btn-sm text-center justify-content-center rounded-3 dynamic-color"
        data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="bi bi-sliders2 d-flex me-1"></i>
        فیلترها
    </button>

    {{-- mobile filter modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title fs-5" id="exampleModalLabel">فیلترها</p>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body mb-5 pb-5">
                    <div class="filter ">
                        <p class=" d-flex align-items-center mb-2">
                            <i class="bi bi-funnel d-flex fs-5 me-1"></i>
                            فیلتر محصولات
                        </p>
                        {{-- @include('site.product-list.components.filtered-item') --}}
                        <div class="accordion accordion-flush mt-2" id="accordionFlushExampleMobile">
                            <div class="accordion-item">
                                <p class="accordion-header">
                                    <button class="accordion-button dynamic-color" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOneMobile"
                                        aria-expanded="true" aria-controls="flush-collapseOneMobile">
                                        فیلتر قیمت
                                    </button>
                                </p>
                                <div id="flush-collapseOneMobile" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionFlushExampleMobile">
                                    <div class="accordion-body">
                                        <div class="row w-100 mx-0 mt-0">
                                            <div class="col-12 p-1">
                                                <div class="d-flex align-items-center">
                                                    <small class="m-0 color-title">
                                                        از
                                                    </small>
                                                    <input name="min" type="text" min="0" max="10000000"
                                                        id="min_price_mobile" readonly
                                                          oninput="validity.valid||(value='0');"
                                                        class="price-range-field font-num form-control shadow-none border-0 bgcolor3 fs-custom2 rounded-custom1 text-center">
                                                    <small class="m-0 color-title">
                                                        تومان
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12 p-1">
                                                <div class="d-flex align-items-center">
                                                    <small class="m-0 color-title">
                                                        تا
                                                    </small>
                                                    <input name="max" type="text" min="0" max="1000000"
                                                        id="max_price_mobile" readonly
                                                           oninput="validity.valid||(value='1000000');"
                                                        class="price-range-field font-num form-control border-0 shadow-none bgcolor3 fs-custom2 rounded-custom1 text-center">
                                                    <small class="m-0 color-title">
                                                        تومان
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12 p-1 mt-2 my-auto">
                                                <div id="slider-range-mobile" class="price-filter-range"
                                                    name="rangeInput"></div>
                                            </div>
                                            <button  @click="filterProducts()" class="btn primary-btn py-2 btn-submit-filter rounded-3 btn-sm mt-3"
                                                type="button">
                                                اعمال فیلتر قیمت
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('help.product-list.components.filters')

                        </div>
                    </div>
                    <button class="w-100 mt-3 rounded-3 btn primary-btn" data-bs-dismiss="modal"
                    aria-label="Close">اعمال تغییرات</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-6 p-1 filter-mobile d-lg-none d-block">
    <button type="button"
        class="btn primary-btn d-flex align-items-center w-100 py-1 px-4 btn-sm text-center justify-content-center rounded-3 dynamic-color"
        data-bs-toggle="modal" data-bs-target="#sortModal">
        <i class="bi bi-sort-up d-flex me-1"></i>
        مرتب سازی
    </button>

    {{-- sort mobile --}}
    <div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title small" id="sortModal">مرتب سازی</p>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('help.product-list.components.sort')
                    <button type="button" class="btn primary-btn py-2 btn-submit-filter rounded-3 btn-sm mt-3 w-100"
                        data-bs-dismiss="modal" aria-label="Close">اعمال
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
