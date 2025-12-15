<div class="price-range-block">
    <div class="py-1">
        <div class="row w-100 m-0">
            <div class="col-md-12 p-1">
                <div id="slider-range" class="price-filter-range" name="priceRange"></div>
                <div class="row w-100 mx-0 mt-3">
                    <div class="col-sm-6 col-xs-6 p-0">
                        <div class="row w-100 m-0">
                            <div class="col-xl-12 text-center align-self-center p-1">
                                <small class="m-0 text-secondary">
                                    تا
                                </small>
                            </div>
                            <div class="col-xl-12 align-self-center p-1">
                                <input type="number" min=0 max="10000000" oninput="validity.valid||(value='1000000');" id="max_price" class="price-range-field w-100 text-center rounded-custom border text-secondary" />
                            </div>
                            <div class="col-xl-12 text-center align-self-center p-1">
                                <small class="m-0 text-secondary">
                                    تومان
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6 p-0">
                        <div class="row w-100 m-0">
                            <div class="col-xl-12 text-center align-self-center p-1">
                                <small class="m-0 text-secondary">
                                    از
                                </small>
                            </div>
                            <div class="col-xl-12 align-self-center p-1">
                                <input type="number" min=0 max="10000000" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field w-100 text-center rounded-custom border text-secondary" />
                            </div>
                            <div class="col-xl-12 text-center align-self-center p-1">
                                <small class="m-0 text-secondary">
                                    تومان
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 p-1">
                <button type="submit" @click="filterProducts()" class="btn btn-success w-100 rounded-custom">
                    اعمال فیلتر
                </button>
            </div>
        </div>
    </div>
</div>
