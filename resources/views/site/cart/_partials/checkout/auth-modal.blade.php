@if (!Auth::check())
    <div class="modal fade" id="exampleModal3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered auth-modal">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <p class="modal-title" id="exampleModalLabel">ورود</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}
                <div class="modal-body">
                    <nav class="border-0">
                        <div class="nav nav-tabs my-2" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">ورود</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">ثبت نام</button>
                            {{-- <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                                aria-label="Close"></button> --}}
                        </div>

                    </nav>
                    <div class="tab-content  my-2" id="nav-tabContent">
                        <div class="tab-pane fade show active" v-if="check == 0" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="col-12 p-0">
                                <div class="form-floating">
                                    <input type="" name="" v-model="mobile"
                                        class="form-control form-control-sm shadow-none" id="floatingInput"
                                        placeholder="شماره همراه">
                                    <label for="floatingInput" class="small">
                                        شماره همراه یا ایمیل خود را وارد کنید
                                    </label>
                                </div>
                            </div>
                            <button v-if="loading3 == false" type="button" @click="loginCart()"
                                class="btn dark-btn rounded-12 small w-100 mt-2">
                                وارد شوید
                            </button>
                            <div v-else class="card rounded-custom border-0 pt-4 pro">
                                <div class="text-center">
                                    <div class="spinner-border" style="width: 2rem; height: 2rem;" role="status">
                                        <span class="visually-hidden">
                                            لودینگ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" v-else id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <form action="{{ url('/confirm-cart/') }}">
                                @csrf
                                <input type="hidden" name="mobile" :value="mobile" class="form-control"
                                    id="floatingInput">
                                <div class="col-12 p-0">
                                    <div class="form-floating">
                                        <input type="" name="confirm_code"
                                            class="form-control form-control-sm shadow-none" id="floatingInput">
                                        <label for="floatingInput" class="small">
                                            کد تایید
                                        </label>
                                        <span class="font-small text-success">کد تایید به موبایل شما ارسال شد.</span>
                                    </div>
                                </div>
                                <button type="submit" class="btn dark-btn rounded-12 small w-100 mt-2">
                                    تایید
                                </button>
                            </form>
                        </div>
                        <div class="tab-pane fade" v-if="check == 0" id="nav-profile" role="tabpanel"
                            aria-labelledby="nav-profile-tab">
                            <div class="row w-100 m-0 ">
                                <div class="col-xxl-6 p-1">
                                    <div class="form-floating">
                                        <input type="text" v-model="name"
                                            class="form-control form-control-sm shadow-none" id="floatingInput"
                                            name="name" placeholder="نام و نام خانوادگی">
                                        <label for="floatingInput" class="small">
                                            نام و نام خانوادگی
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xxl-6 p-1">
                                    <div class="form-floating">
                                        <select class="form-select form-select-sm shadow-none" v-model="type"
                                            id="floatingSelect" aria-label="Float[ing label select example"
                                            name="gender">
                                            <option value="1">آقا</option>
                                            <option value="2">خانم</option>
                                        </select>
                                        <label for="floatingSelect" class="small">جنسیت</label>
                                    </div>
                                </div>
                                <div class="col-xxl-6 p-1">
                                    <div class="form-floating">
                                        <input type="tel" v-model="mobile"
                                            class="form-control form-control-sm shadow-none" id="floatingInput"
                                            placeholder="شماره همراه">
                                        <label for="floatingInput" class="small">
                                            شماره همراه
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xxl-6 p-1">
                                    <div class="form-floating">
                                        <input type="email" v-model="email"
                                            class="form-control form-control-sm shadow-none" id="floatingInput"
                                            placeholder="ایمیل">
                                        <label for="floatingInput" class="small">
                                            ایمیل
                                        </label>
                                    </div>
                                </div>
                                <button v-if="loading3 == false" type="button" @click="registerCart"
                                    class="btn dark-btn rounded-12 small w-100 mt-2 mx-1">
                                    ثبت نام کنید
                                </button>
                                <div v-else class="card rounded-custom border-0 pt-4 pro">
                                    <div class="text-center">
                                        <div class="spinner-border" style="width: 2rem; height: 2rem;"
                                            role="status">
                                            <span class="visually-hidden">
                                                لودینگ
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" v-if="check == 2" id="nav-profile" role="tabpanel"
                            aria-labelledby="nav-profile-tab">
                            <div class="row w-100 m-0 ">
                                <form action="{{ url('/confirm-cart') }}">
                                    @csrf
                                    <input type="hidden" name="mobile" :value="mobile" class="form-control"
                                        id="floatingInput">
                                    <div class="col-12 p-0">
                                        <div class="form-floating">
                                            <input type="" name="confirm_code"
                                                class="form-control form-control-sm shadow-none" id="floatingInput">
                                            <label for="floatingInput" class="small">
                                                کد تایید
                                            </label>
                                            <span class="font-small text-success">کد تایید به موبایل شما ارسال شد.</span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn dark-btn rounded-12 small w-100 mt-2">
                                        تایید
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
