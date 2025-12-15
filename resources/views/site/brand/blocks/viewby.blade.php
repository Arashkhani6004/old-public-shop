<p class="align-self-center my-0 mx-2 d-flex align-items-center">
    <i class="bi bi-sort-down d-flex me-2 my-0 h5"></i>
    مشاهده بر اساس
</p>
<select class="form-select rounded-custom align-self-center max-content ms-auto border-0"
        aria-label="مرتب سازی بر اساس" @change="filterBrands()" v-model = "sortBy">

    <option value="most">
        پرفروش ترین
    </option>
    <option value="like">
        محبوب ترین
    </option>

    <option value="cheapest">
        ارزان ترین
    </option>
    <option value="expensive">
        گرانترین
    </option>
</select>
