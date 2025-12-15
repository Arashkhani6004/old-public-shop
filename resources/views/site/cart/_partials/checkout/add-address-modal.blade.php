<div class="modal fade" id="addAddresModal" tabindex="-1" aria-labelledby="addAddresModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-custom">
            <div class="modal-header">
                <p class="modal-title fm-b" id="addAddresModalLabel">
                    افرودن آدرس
                </p>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2 modal-add">
                <div class="col-sm-12 p-1">
                    <form class="m-0" method="post"
                        action="{{ URL::action('Site\ShopController@postAddAddress') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="order_id" :value="order.id">
                        <div class="row w-100 m-0">
                            <div class="col-md-4 col-6 p-1">
                                <label class="form-label font-small fm-re mb-1" for="recipient_name">نام تحویل
                                    گیرنده</label>
                                <input class="form-control" placeholder="مثلا رامین جوادی" id="recipient_name"
                                    name="recipient_name" required>
                            </div>
                            <div class="col-md-4 col-6 p-1">
                                <label class="form-label font-small fm-re mb-1" for="recipient_phone">شماره تحویل
                                    گیرنده</label>
                                <input class="form-control" placeholder="مثلا ۰۹۱۲۱۲۳۴۵۶۷" id="recipient_phone"
                                    onkeyup="chakeNumber(this.id)" name="recipient_phone" required>
                            </div>
                            <div class="col-md-4 col-6 p-1">
                                <label class="form-label font-small fm-re mb-1" for="postalCode">کدپستی</label>
                                <input class="form-control" placeholder="1234567890" name="postal_code"
                                    id="postalCode" value="">
                            </div>
                            <div class="col-md-6 col-6 p-1">
                                <label class="form-label font-small fm-re mb-1">استان</label>
                                <select class="form-select" name="state_id" required v-model="selectedState"
                                    aria-label="Default select example"
                                    @change="getEditCities(selectedState)"/>
                                    <option value="">استان
                                    محل سکونت</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-6 p-1">
                                <label class="form-label font-small fm-re mb-1">
                                    شهر
                                </label>

                                <select class="form-select" aria-label="Default select example" required
                                    v-model="selectedCity" name="city_id">
                                    <option value="">شهر محل سکونت</option>
                                    <option v-for="city in cities" :value="city.id">@{{ city.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label font-small fm-re mb-1" for="location">آدرس</label>
                                <textarea class="form-control small" required oninvalid='swal("", "نشانی پستی اجباری است", "error")'
                                    placeholder="خیابان اصلی,خیابان فرعی,کوچه" id="location" name="location" rows="3"></textarea>
                            </div>
                            <div class="d-flex justify-content-end mt-1 p-0">
                                <button type="submit" class="btn dark-btn rounded-12 btn-sm px-5">ثبت
                                </button>
                            </div>
                        </div>
                        {{-- <div class="row w-100 m-0">
                            <div class="col-xxl-6 p-1">
                                <div class="form-floating">
                                    <select name="state_id" class="form-select" id="floatingSelect" required
                                        aria-label="Floating label select example" v-model="selectedState"
                                        @change="getEditCities(selectedState)">
                                        <option value=""> انتخاب استان </option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">
                                        استان<span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-6 p-1">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect"
                                        aria-label="Floating label select example" required v-model="selectedCity"
                                        name="city_id">
                                        <option value="">انتخاب شهر </option>
                                        <option v-for="city in cities" :value="city.id">
                                            @{{ city.name }}
                                        </option>
                                    </select>
                                    <label for="floatingSelect">
                                        شهر<span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-6 p-1">
                                <div class="form-floating">
                                    <input type="text" autocomplete="off" class="form-control"
                                        id="recipient_name" name="recipient_name"
                                        placeholder=" نام و نام خانوادگی تحویل گیرنده">
                                    <label for="floatingInput">
                                        <i class="bi bi-mailbox h6 m-0"></i>
                                        نام و نام خانوادگی تحویل گیرنده

                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-6 p-1">
                                <div class="form-floating">
                                    <input onkeyup="chakeNumber(this.id)" type="text" autocomplete="off"
                                        class="form-control" id="recipient_phone" name="recipient_phone"
                                        placeholder="شماره تماس تحویل گیرنده  ">
                                    <label for="floatingInput">
                                        <i class="bi bi-mailbox h6 m-0"></i>
                                        شماره تماس تحویل گیرنده

                                    </label>
                                </div>
                            </div>

                            <div class="col-xxl-6 p-1">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInput"
                                        name="postal_code" placeholder="کد پستی">
                                    <label for="floatingInput">
                                        <i class="bi bi-mailbox h6 m-0"></i>
                                        کد پستی
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-6 p-1">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInput"
                                        name="transferee_mobile" placeholder="شماره گیرنده" required
                                        oninvalid='swal("", " شماره گیرنده اجباری است", "error")' />
                                    <label for="floatingInput">
                                        <i class="bi bi-telephone h6 m-0"></i>
                                        شماره تماس
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-12 p-1">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="نشانی پستی" required
                                        oninvalid='swal("", "نشانی پستی اجباری است", "error")' id="floatingTextarea" id="location" name="location"></textarea>
                                    <label for="floatingTextarea">
                                        <i class="bi bi-geo-alt h6 m-0"></i>
                                        نشانی پستی
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-4 ms-auto p-1">
                                <button type="submit" class="btn btn-success rounded-custom w-100">
                                    افزودن آدرس
                                </button>
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>