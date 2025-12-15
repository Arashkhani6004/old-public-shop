<div class="row w-100 m-0">
    <div class="col-md-4 col-6 p-1">
        <label class="form-label font-small fm-re mb-1" for="subject">نام تحویل گیرنده</label>
        <input class="form-control" placeholder="مثلا رامین جوادی" id="subject" value="" required>
    </div>
    <div class="col-md-4 col-6 p-1">
        <label class="form-label font-small fm-re mb-1" for="subject">شماره تحویل گیرنده</label>
        <input class="form-control" placeholder="مثلا ۰۹۱۲۱۲۳۴۵۶۷" id="subject" value="" required>
    </div>
    <div class="col-md-4 col-6 p-1">
        <label class="form-label font-small fm-re mb-1" for="postalCode">کدپستی</label>
        <input class="form-control" placeholder="1234567890" id="postalCode" value="">
    </div>
    <div class="col-md-6 col-6 p-1">
        <label class="form-label font-small fm-re mb-1">استان</label>
        <select class="form-select" aria-label="Default select example">
            <option value="">استان محل سکونت</option>
            <option>تهران</option>
            <option>آذربایجان شرقی</option>
            <option>آذربایجان غربی</option>
            <option>خراسن رضوی</option>
        </select>
    </div>
    <div class="col-md-6 col-6 p-1">
        <label class="form-label font-small fm-re mb-1">
            شهر
        </label>

        <select class="form-select" aria-label="Default select example">
            <option value="">شهر محل سکونت</option>
            <option>تهران</option>
            <option>تبریز</option>
            <option>ارومیه</option>
            <option>مشهد</option>
        </select>
    </div>
    <div class="col-12 p-1">
        <label class="form-label font-small fm-re mb-1" for="exampleFormControlTextarea1">آدرس</label>
        <textarea class="form-control small" placeholder="خیابان اصلی,خیابان فرعی,کوچه" id="exampleFormControlTextarea1"
            rows="3"></textarea>
    </div>
    <div class="d-flex justify-content-center mt-1">
        <button type="submit" class="btn dark-btn rounded-12 btn-sm px-3">ثبت
        </button>
    </div>
</div>
