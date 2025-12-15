<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-custom">
            <div class="modal-header">
                <h5 class="modal-title" id="addAddressModalLabel">
                    اضافه کردن آدرس
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="m-0" method="post" action="{{ URL::action('Panel\PanelController@postAddAddress') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row w-100 m-0">
                        <div class="col-xxl-4 p-1">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" name="name"
                                    placeholder="نام آدرس">
                                <label for="floatingInput">
                                    <i class="bi bi-pencil h6 m-0"></i>
                                    عنوان آدرس

                                </label>
                            </div>
                        </div>
                        <div class="col-xxl-4 p-1">
                            <div class="form-floating">
                                <select required name="state_id" class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example" v-model="selectedState"
                                    @change="setCities(selectedState)">
                                    <option value="">
                                        انتخاب استان
                                    </option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">
                                    استان
                                    <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-xxl-4 p-1">
                            <div class="form-floating">
                                <select required class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example" v-model="selectedCity" name="city_id">
                                    <option value="">
                                        انتخاب شهر
                                    </option>
                                    <option v-for="city in cities" :value="city.id">
                                        @{{ city.name }}
                                    </option>
                                </select>
                                <label for="floatingSelect">
                                    شهر
                                    <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-xxl-4 p-1">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" name="postal_code"
                                    placeholder="کد پستی">
                                <label for="floatingInput">
                                    <i class="bi bi-mailbox h6 m-0"></i>
                                    کد پستی
                                </label>
                            </div>
                        </div>
                        <div class="col-xxl-4 p-1">
                            <div class="form-floating">
                                <input required oninvalid='swal("", " شماره تماس اجباری است", "error")' type="text"
                                    class="form-control" id="floatingInput" name="transferee_mobile"
                                    placeholder="شماره تماس">
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

                            </div>
                        </div>
                        <div class="col-xxl-4 ms-auto p-1">
                            <button type="submit" class="btn btn-success rounded-custom w-100">
                                افزودن آدرس
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
