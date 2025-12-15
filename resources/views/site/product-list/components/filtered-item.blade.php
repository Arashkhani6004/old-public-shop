<div class="filtered">
    <ul class="p-0 m-0 d-flex align-items-center gap-1 flex-wrap">
        <li class="list-unstyled d-flex align-items-center font-re small m-0">
            نام برند
            <button type="button" class="btn btn-filter ms-2 p-0 bg-transparent border-0 shadow-none rounded-0">
                <i class="bi bi-x d-flex"></i>
            </button>
        </li>
        <li class="list-unstyled d-flex align-items-center font-re small m-0">
            آیتم فیلتر شده
            <button  type="button" class="btn btn-filter ms-2 p-0 bg-transparent border-0 shadow-none rounded-0">
                <i class="bi bi-x d-flex"></i>
            </button>
        </li>
        <li class="list-unstyled d-flex align-items-center font-re small m-0" v-if="discounted_price == 1">
            محصولات تخفیف دار
            <button type="button" class="btn btn-filter ms-2 p-0 bg-transparent border-0 shadow-none rounded-0">
                <i class="bi bi-x d-flex"></i>
            </button>
        </li>
        <li class="list-unstyled d-flex align-items-center font-re small m-0" v-if="stock == 1">
            محصولات موجود
            <button type="button" class="btn btn-filter ms-2 p-0 bg-transparent border-0 shadow-none rounded-0">
                <i class="bi bi-x d-flex"></i>
            </button>
        </li>
    </ul>
</div>
