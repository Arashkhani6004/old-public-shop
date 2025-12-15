<div class="sidebar-cart bg-white rounded-4 shadow-sm px-2 py-3">
    <div class=" form-group position-relative">
        <input type="text" placeholder="کد تخفیف" class="form-control form-control-sm shadow-none code">
        <button class="btn btn-sm py-1 px-3 dark-btn position-absolute top-0 bottom-0 end-0 rounded-3">
            ثبت
        </button>
    </div>
    <form action="" method="">
        <ul class="m-0 p-0 mt-3">
            <li class="list-unstyled d-flex justify-content-between mb-3">
                <p class="fm-md m-0 small">
                    مبلغ کل کالا
                </p>
                <p class="fm-re m-0 small">
                    250،000 تومان
                </p>
            </li>
            <li class="list-unstyled d-flex justify-content-between mb-3">
                <p class="fm-md m-0 small">
                    هزینه ارسال
                </p>
                <p class="fm-re m-0 small">
                    25،000 تومان
                </p>
            </li>
            <li class="list-unstyled d-flex justify-content-between mb-3">
                <p class="fm-md m-0 small">
                    ارزش افزوده
                </p>
                <p class="fm-re m-0 small">
                    28,000 تومان
                </p>
            </li>
            <li class="list-unstyled d-flex justify-content-between mb-3">
                <p class="fm-md m-0 small">
                    تخفیف
                </p>
                <p class="fm-re m-0 small">
                    1,179,000 تومان
                </p>
            </li>
            <li class="list-unstyled d-flex justify-content-between ">
                <p class="fm-md m-0 small">
                    مبلغ پرداختی
                </p>
                <p class="fm-re m-0 small">
                    275،000 تومان
                </p>
            </li>
            <hr>
            <li class="list-unstyled">
                <p class="small fm-b mb-1">توضیحات</p>
                <textarea rows="2" class="form-control shadow-none" placeholder="توضیحات اضافه..."></textarea>
            </li>
            <hr>
            <li class=" list-unstyled">
                <p class="small fm-b mb-1">روش پرداخت</p>
                <ul class="d-flex align-items-center p-0 m-0 mb-2 gap-2">
                    <li class="list-unstyled pay-item rounded-3 d-flex flex-column align-items-center p-1">
                        <input class="form-check-input" required type="radio" name="bank_id" id="flexRadioDefault1">
                        <label class="form-check-label mt-2" for="flexRadioDefault1">
                            <img src="{{ asset('assets/site/images/zarinPal.png') }}" width="60"
                                class="rounded-2" />
                        </label>

                    </li>
                    <li class="list-unstyled pay-item rounded-3 d-flex flex-column align-items-center p-1">
                        <input class="form-check-input" required type="radio" name="bank_id" id="flexRadioDefault2">
                        <label class="form-check-label mt-2" for="flexRadioDefault2">
                            <img src="{{ asset('assets/site/images/sep.png') }}" width="60" class="rounded-2" />
                        </label>

                    </li>
                </ul>
            </li>
            <li class="list-unstyled d-flex justify-content-between">
                <button type="submit" class="btn primary-btn btn-sm rounded-12 py-2 w-100">
                    تایید اطلاعات و پرداخت
                </button>
            </li>
        </ul>
    </form>
</div>
