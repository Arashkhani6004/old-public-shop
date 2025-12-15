<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg modal-add">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title fs-5" id="exampleModalLabel">افزودن آدرس جدید</p>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="m-0" method="post" action="{{ URL::action('Panel\PanelController@postAddAddress') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row w-100 m-0">
                        <div class="col-md-4 col-6 p-1">
                            <label class="form-label font-small font-re mb-1" for="subject">عنوان
                                آدرس</label>
                            <input class="form-control" placeholder="مثلا خانه" id="subject" name="name">
                        </div>
                        <div class="col-md-4 col-6 p-1">
                            <label class="form-label font-small font-re mb-1" for="postalCode">کدپستی</label>
                            <input class="form-control" placeholder="1234567890" id="postalCode" name="postal_code">
                        </div>
                        <div class="col-md-4 col-6 p-1">
                            <label class="form-label font-small font-re mb-1" for="phone">شماره تماس</label>
                            <input class="form-control" placeholder="09********" id="phone" name="transferee_mobile"
                                required oninvalid='swal("", " شماره تماس اجباری است", "error")'>
                        </div>
                        <div class="col-md-6 col-6 p-1">
                            <label class="form-label font-small font-re mb-1">استان</label>
                            <select class="form-select" aria-label="Default select example" v-model="selectedState"
                                @change="setCities(selectedState)" required name="state_id">
                                <option selected>استان محل سکونت</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-6 p-1">
                            <label class="form-label font-small font-re mb-1">شهر</label>
                            <select class="form-select" aria-label="Default select example" v-model="selectedCity"
                                name="city_id">
                                <option selected>شهر محل سکونت</option>
                                <option v-for="city in cities" :value="city.id">
                                    @{{ city.name }}
                                </option>
                            </select>
                        </div>
                        <div class="col-12 p-1">
                            <label class="form-label font-small font-re mb-1"
                                for="exampleFormControlTextarea1">آدرس</label>
                            <textarea class="form-control small" required oninvalid='swal("", "نشانی پستی اجباری است", "error")'
                                placeholder="خیابان اصلی,خیابان فرعی,کوچه" id="location" name="location" rows="3"></textarea>
                        </div>
                        <div class="d-flex justify-content-end mt-1">
                            <button type="submit" class="btn primary-btn btn-sm rounded-12 px-3">ثبت آدرس</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
