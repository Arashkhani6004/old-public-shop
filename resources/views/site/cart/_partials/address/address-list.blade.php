<div class="row w-100 m-0 p-0">
    <div class="col-sm-12 p-1">
        <div class="address-item p-2 border">
            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="address_id" id="flexCheckDefault">
                    <label class="form-check-label small fm-re" for="flexCheckDefault">
                        آدرس جهت ارسال
                    </label>
                </div>
                <a class="text-secondary d-flex align-items-center font-small fm-re" data-bs-toggle="collapse"
                    href="#editAdress-1" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="bi bi-pencil d-flex me-1"></i>
                    ویرایش
                </a>
            </div>
            <p class="fm-md m-0 mt-2">

                خراسان رضوی
                |
                مشهد
            </p>
            <p class="fm-re m-0 small mt-1">
                مشهد,بلوار رضوی , کوجه سوم , پلاگ ۴
            </p>
            <div class="collapse mt-2" id="editAdress-1">
                <div class="card card-body p-2 edit-card">
                    @include('site.cart._partials.address.edit-form')
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 p-1">
        <div class="address-item p-2 border">
            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="address_id" id="flexCheckDefault2">
                    <label class="form-check-label small fm-re" for="flexCheckDefault2">
                        آدرس جهت ارسال
                    </label>
                </div>
                <a class="text-secondary d-flex align-items-center font-small fm-re" data-bs-toggle="collapse"
                    href="#editAdress-2" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="bi bi-pencil d-flex me-1"></i>
                    ویرایش
                </a>
            </div>
            <p class="fm-md m-0 mt-2">

                تهران
                |
                تهران
            </p>
            <p class="fm-re m-0 small mt-1">
                تهران،تهرانپارس،فلکه سوم
            </p>
            <div class="collapse mt-2" id="editAdress-2">
                <div class="card card-body p-2 edit-card">
                    @include('site.cart._partials.address.edit-form')
                </div>
            </div>
        </div>
    </div>
</div>
