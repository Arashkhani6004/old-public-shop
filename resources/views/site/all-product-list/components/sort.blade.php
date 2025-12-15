<div class="sort d-flex align-items-center justify-content-end gap-1 ">
    <p class="m-0 small font-md d-flex align-items-center font-md">
        <i class="bi bi-sort-up d-flex me-1 fs-5"></i>
        مرتب سازی :
    </p>
    <ul class="p-0 m-0 d-flex align-items-center gap-2">
        <li class="list-unstyled">
            <div class="form-check mb-0">
                <input class="form-check-input" type="radio" value="most" name="" v-model="sortBy" id="sort-item1"  @change="filterAll()" v-model = "sortBy">
                <label class="form-check-label font-re w-100" for="sort-item1">
                	پرفروش ترین
                </label>
            </div>
        </li>
        <li class="list-unstyled">
            <div class="form-check mb-0">
                <input class="form-check-input" type="radio" value="cheapest" v-model="sortBy" id="sort-item2"  @change="filterAll()" v-model = "sortBy">
                <label class="form-check-label font-re w-100" for="sort-item2">
                    ارزانترین
                </label>
            </div>
        </li>
        <li class="list-unstyled">
            <div class="form-check mb-0">
                <input class="form-check-input" type="radio" value="expensive" v-model="sortBy" id="sort-item3"  @change="filterAll()" v-model = "sortBy">
                <label class="form-check-label font-re w-100" for="sort-item3">
                    گرانترین
                </label>
            </div>
        </li>
    </ul>
</div>