<div class="row w-100 m-0">
    @if(\Illuminate\Support\Facades\Auth::check())
    <div class="col-sm-12 p-1">
        <div class="card border-0 rounded-custom p-2">
            <div class="p-1">
                @include('site.cart2.blocks.add-addres')
                @if ($default_address !== null)
                    <hr class="my-2">
                    <div class="card bg-light border-0 shadow-sm rounded-custom p-1">
                        <div class="row w-100 m-0">
                            <div class="col-xxl-12 p-1">
                                <p class="ismb text-dark m-0">
                                    عنوان آدرس
                                </p>
                            </div>
                            <div class="col-xxl-12 p-1">
                                <p class="m-0 d-flex align-items-center">
                                    <i class="bi bi-geo-alt text-a d-flex h5 me-2 my-0"></i>
                                    <span class="text-secondary">
                                        آدرس پستی :
                                        {{ @$default_address->state->name . ' ' . @$default_address->city->name . ' ' . @$default_address->location }}
                                    </span>
                                </p>
                            </div>
                            @if (isset($default_address->postal_code))
                                <div class="col-xxl-12 p-1">
                                    <p class="m-0 d-flex align-items-center">
                                        <i class="bi bi-mailbox text-a d-flex h5 me-2 my-0"></i>
                                        <span class="text-secondary">
                                            کد پستی :
                                            {{ @$default_address->postal_code }}
                                        </span>
                                    </p>
                                </div>
                            @endif
                            <div class="col-xxl-12 p-1">
                                <p class="m-0 d-flex align-items-center">
                                    <i class="bi bi-telephone text-a d-flex h5 me-2 my-0"></i>
                                    <span class="text-secondary">
                                        شماره تماس :
                                        {{ @$default_address->transferee_mobile }}
                                    </span>
                                </p>
                            </div>
                            @if (isset($default_address->recipient_name))
                            <div class="col-xxl-12 p-1">
                                <p class="m-0 d-flex align-items-center">
                                    <i class="bi bi-postcard text-a d-flex h5 me-2 my-0"></i>
                                    <span class="text-secondary">
                                           نام و نام خانوادگی تحویل گیرنده :
                                        {{ @$default_address->recipient_name }}
                                    </span>
                                </p>
                            </div>
                            @endif
                            @if (isset($default_address->recipient_phone))
                            <div class="col-xxl-12 p-1">
                                <p class="m-0 d-flex align-items-center">
                                    <i class="bi bi-mailbox text-a d-flex h5 me-2 my-0"></i>
                                    <span class="text-secondary">
                                        شماره تماس گیرنده : 
                                        {{ @$default_address->recipient_phone }}
                                    </span>
                                </p>
                            </div>
                            @endif
                            <div class="col-xxl-6 p-1">
                                <p
                                    class="m-0 d-flex align-items-center text-success py-1 px-2 me-auto border border-success max-content">
                                    <i class="bi bi-check-square-fill d-flex h5 me-2 my-0"></i>
                                    آدرس پیش فرض
                                </p>
                                <!-- <a href=""
                                    class="m-0 d-flex align-items-center btn btn-outline-info rounded-0 py-1 px-2 me-auto max-content">
                                    <i class="bi bi-square-fill d-flex h5 me-2 my-0"></i>
                                    انتخاب به عنوان پیش فرض
                                </a> -->
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endif
    @if ($setting_header->box_discount == 1)
    <div class="col-sm-12 p-1">
        <div class="card border-0 rounded-custom p-2">

            <label for="inputDis" class="form-label ismb text-secondary">
                آیا کد تخفیف دارید؟
            </label>
            <div class="position-relative border rounded-custom overflow-hidden d-flex">
                <input type="text" name="code" v-model="discountCode" class="form-control border-0 text-start"
                    id="inputDis" placeholder="کد تخفیف خود را وارد کنید">
                <button v-if="loading4 == false" type="submit" @click="addDiscount"
                    class="btn btn-success position-absolute top-0 bottom-0 end-0 rounded-0">
                    <i class="bi bi-check2-circle d-flex"></i>
                </button>
                <div v-else class="card rounded-custom border-0 py-2 pe-4 pro">
                    <div class="text-center">
                        <div class="spinner-border" style="width: 2rem; height: 2rem;" role="status">
                            <span class="visually-hidden">
                                لودینگ
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif


    <div class="col-sm-12 p-1">
        <form action="{{ route('site.cart.post-checkout') }}" method="GET">
            {{ csrf_field() }}
            @if (\Illuminate\Support\Facades\Auth::check())
                @if ($setting_header->status_send == 1)
                    <div class="card flex-row p-3 mb-2">
                        <input type="checkbox" value="1" name="pay_type" id="pay_type" style="width:1.1rem;">
                        <label for="pay_type" class="fw-bolder">پرداخت در محل</label>


                    </div>
                @endif
                <div class="card p-3 border-0 rounded-0 mb-2"v-if="shippingmethods.length > 0">
                    <div >
                        <select id="shipmetn_select" v-model="changePost1"  class="form-select" aria-label="انتخاب روش ارسال" required
                            oninvalid='swal("", "انتخاب روش ارسال اجباری است", "error")'>
                            <option value="" selected>
                                انتخاب روش ارسال
                            </option >
                            <br>
                            {{-- <option v-if="{{intval($shipment->max_price)}} < cartPayment" value="{{number_format(@$shipment->price).'تومان|'. @$shipment->price.'|'.@$shipment->id}}">{{$shipment->title}}</option> --}}
                            <option v-for="shopingmethod in shippingmethods" :value="shopingmethod">@{{shopingmethod.title}}</option>
                        </select>
                    </div>


                    <input name="post_type" type="hidden" value="1" />
                    <input name="shipment_id" v-model="shipmentId" id="shipmentId" type="hidden" value="" />

                    <input type="hidden" name="post_price" value="{{ @$setting_header->post_price1 }}">

                    {{-- <p class="bg-white">روش ارسالی وجود نداره لطفا با پشتیبانی تماس بگیرید</p> --}}
                </div>

                <div class="card p-3 border-0 rounded-0 mb-2">
                    <textarea class="form-control" name="description" placeholder="اگر توضیحی دارید بنویسید" id="floatingTextarea2" style="height: 100px"></textarea>
                </div>

            @endif

            <div class="card border-0 rounded-custom p-2">
                <div class="row w-100 m-0">
                    <div class="col-xl-6 col-lg-12 col-sm-6 col-xs-6 text-start px-1 py-2">
                        <p class="my-0 text-secondary">
                            قیمت محصولات (تعداد: @{{ cartTotal }})
                        </p>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-sm-6 col-xs-6 text-end px-1 py-2">
                        <p class="my-0 text-secondary">
                            @{{ cartSumPrice }} تومان
                        </p>
                    </div>
                </div>

                <div class="row w-100 m-0">
                    <div class="col-xl-6 col-lg-12 col-sm-6 col-xs-6 text-start px-1 py-2">
                        <p class="my-0 text-secondary">
                            هزینه ارسال
                        </p>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-sm-6 col-xs-6 text-end px-1 py-2">
                        <p class="my-0 text-danger">
                            @{{ selectedPost }}
                        </p>
                    </div>
                </div>
                <hr class="my-1">
                <div class="row w-100 m-0">
                    <div class="col-xl-6 col-lg-6 col-sm-6 col-xs-6 text-start px-1 py-2">
                        <p class="my-0 text-dark ismb">
                            جمع سبد خرید
                        </p>
                        @if($setting_header->tax > 0)
                        <p class="mt-2 mb-0 text-center text-danger fw-lighter">
                            ({{ 'با احتساب ' . $setting_header->tax . ' درصد مالیات با ارزش افزوده' }})
                        </p>
                        @endif
                    </div>
                    <div class="col-xl-6 col-lg-6 col-sm-6 col-xs-6 text-end px-1 py-2">
                        <p class="my-0 text-dark fw-bolder">
                            @{{ (cartPayment + selectedPost2 + (selectedTax*cartPayment)).toLocaleString('en') }} تومان

                        </p>
                    </div>

                </div>
                <div class="col-xxl-12 px-1 py-2">
                    @if(Auth::check())
                        @if($setting_header->status_police)
                        <button type="button" class="btn btn-pro-buy w-100 mt-2" data-bs-toggle="modal" data-bs-target="#examplep">
                            ادامه فرایند خرید
                        </button>
                        @else
                        <button type="submit" class="btn btn-pro-buy w-100">
                            ادامه فرایند خرید
                        </button>
                        @endif
                    @else
                    <button type="button" class="btn btn-pro-buy w-100 mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                        ادامه فرایند خرید
                    </button>
                    @endif
                </div>
            </div>
            @if($setting_header->status_police)
            <div class="modal fade" id="examplep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">قوانین سایت</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">آیا <a href="{{route('site.rules')}} ">قوانین سایت</a> رو قبول دارید؟</p>
                            <ul class="d-flex m-0 p-0 justify-content-between">

                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">خیر</button>
                            <button type="submit" class="btn btn-primary"> بله</button>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </form>
        @if(!Auth::check())
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content w-100" style="background: #ffff !important;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">خرید</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <nav>
                            <div class="nav nav-tabs my-2" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">وارد شوید</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">ثبت نام کنید</button>
                            </div>
                        </nav>
                        <div class="tab-content  my-2" id="nav-tabContent">
                            <div class="tab-pane fade show active" v-if="check == 0" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="col-12 p-1">
                                    <div class="form-floating">
                                        <input type="" name="" v-model="mobile" class="form-control" id="floatingInput" placeholder="شماره همراه">
                                        <label for="floatingInput">
                                            شماره همراه یا ایمیل خود را وارد کنید
                                        </label>
                                    </div>
                                </div>
                                <button v-if="loading3 == false" type="button" @click="loginCart()" class="btn btn-success rounded-custom w-100 mt-3">
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
                            <div class="tab-pane fade show active" v-else id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <form action="{{url('/confirm-cart/')}}">
                                    @csrf
                                        <input type="hidden" name="mobile" :value="mobile"  class="form-control" id="floatingInput" >
                                        <div class="col-12 p-1">
                                            <div class="form-floating">
                                                <input type="" name="confirm_code"  class="form-control" id="floatingInput" >
                                                <label for="floatingInput">
                                                کد تایید
                                                </label>
                                                <span>کد تایید به موبایل شما ارسال شد.</span>
                                            </div>
                                        </div>
                                        <button type="submit"  class="btn btn-success rounded-custom w-100 mt-3">
                                            تایید شماره
                                        </button>
                            </form>
                            </div>
                            <div class="tab-pane fade" v-if="check == 0" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="row w-100 m-0 ">
                                    <div class="col-xxl-6 p-1">
                                        <div class="form-floating">
                                            <input type="text" v-model="name" class="form-control" id="floatingInput" name="name" placeholder="نام و نام خانوادگی">
                                            <label for="floatingInput">
                                                نام و نام خانوادگی
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 p-1">
                                        <div class="form-floating">
                                            <select class="form-select" v-model="type" id="floatingSelect" aria-label="Float[ing label select example" name="gender">
                                                <option value="1">آقا</option>
                                                <option value="2">خانم</option>
                                            </select>
                                            <label for="floatingSelect">جنسیت</label>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 p-1">
                                        <div class="form-floating">
                                            <input type="tel" v-model="mobile" class="form-control" id="floatingInput" placeholder="شماره همراه">
                                            <label for="floatingInput">
                                                شماره همراه
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 p-1">
                                        <div class="form-floating">
                                            <input type="email" v-model="email" class="form-control" id="floatingInput" placeholder="ایمیل">
                                            <label for="floatingInput">
                                                ایمیل
                                            </label>
                                        </div>
                                    </div>
                                    <button v-if="loading3 == false" type="button" @click="registerCart" class="btn btn-success rounded-custom w-100 mt-3">
                                        ثبت نام کنید
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
                            </div>
                            <div class="tab-pane fade show active" v-if="check == 2" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="row w-100 m-0 ">
                                    <form action="{{url('/confirm-cart/')}}">
                                        @csrf
                                            <input type="hidden" name="mobile" :value="mobile"  class="form-control" id="floatingInput" >
                                            <div class="col-12 p-1">
                                                <div class="form-floating">
                                                    <input type="" name="confirm_code"  class="form-control" id="floatingInput" >
                                                    <label for="floatingInput">
                                                    کد تایید
                                                    </label>
                                                    <span>کد تایید به موبایل شما ارسال شد.</span>
                                                </div>
                                            </div>
                                            <button type="submit"  class="btn btn-success rounded-custom w-100 mt-3">
                                                تایید شماره
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
    </div>

</div>
<!-- mobile btn buy -->
{{-- <div class="position-fixed bg-white border-top shadow d-md-none d-sm-block d-xs-block bottom-0 end-0 start-0 py-0">
    <div class="row w-100 m-0">
        <div class="col-sm-3 col-xs-5 align-self-end px-1 py-2">
            @if(Auth::check())
            <button type="submit" class="btn btn-sm btn-pro-buy w-100">
                ادامه فرایند خرید
            </button>
            @else
            <button type="button" class="btn btn-sm btn-pro-buy w-100" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                ادامه فرایند خرید
            </button>
            @endif
        </div>

        <div class="col-sm-9 col-xs-7 align-self-end p-1">
            <form action="{{ route('site.cart.post-checkout') }}" method="POST">
                {{ csrf_field() }}
                <ul class="p-0 m-0">
                    <li class="py-1 list-unstyled">
                        <p class="m-0 d-flex align-items-center justify-content-between text-secondary">
                            <span>
                                قیمت محصولات (تعداد: @{{ cartTotal }})
                            </span>
                            <span>
                                @{{ cartSumPrice }} تومان
                            </span>
                        </p>
                        <p class="m-0 ismb d-flex align-items-center justify-content-between text-dark">
                            <span>
                                جمع سبد
                            </span>
                            @if(isset($setting_header->tax))
                            <span class="mt-2 mb-0 text-center text-danger fw-lighter">
                                ({{ 'با احتساب ' . $setting_header->tax . ' درصد مالیات با ارزش افزوده' }})
                            </span>

                            <span>
                                @{{ cartPayment + selectedPost2 + selectedTax }} تومان
                            </span>
                            @endif
                        </p>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div> --}}

@section('js')
    @if(session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'خطا در پرداخت',
                text: '{{ session('error') }}',
                confirmButtonText: 'باشه'
            });
        </script>
    @endif
@endsection