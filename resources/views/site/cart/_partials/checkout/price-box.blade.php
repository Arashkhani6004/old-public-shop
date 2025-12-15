<div class="sidebar-cart bg-white rounded-12 shadow-sm px-md-2 py-md-3 pt-2 pb-1">
    @if (!App\Library\Helper::isMobile())
        <div class="d-lg-block d-none">
            @include('site.cart._partials.checkout.addresses')
            @if ($setting_header->box_discount == 1)
                <div class="col-sm-12 p-1 mb-2">
                    <div class="modal-add">

                        <label for="inputDis" class="form-label font-small text-secondary">
                            آیا کد تخفیف دارید؟
                        </label>
                        <div class="position-relative border overflow-hidden d-flex">
                            <input type="text" name="code" v-model="discountCode"
                                class="form-control border-0 text-start" id="inputDis"
                                placeholder="کد تخفیف خود را وارد کنید">
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
        </div>
    @endif
    <form action="{{ route('site.cart.post-checkout') }}" method="GET">
        {{ csrf_field() }}
        @if (\Illuminate\Support\Facades\Auth::check())
            @if ($setting_header->status_send == 1)
                <div class="p-1">
                    <div class="d-flex align-items-center mb-2">
                        <input type="checkbox" value="1" class="me-1" name="pay_type" id="pay_type"
                            style="width:1.1rem;">
                        <label for="pay_type" class="small">پرداخت در محل</label>
                    </div>
                </div>
            @endif
            <div class="mb-2 modal-add" v-if="shippingmethods.length > 0">
                <select id="shipmetn_select" v-model="changePost1" class="form-select" aria-label="انتخاب روش ارسال"
                    required oninvalid='swal("", "انتخاب روش ارسال اجباری است", "error")'>
                    <option value="" selected>
                        انتخاب روش ارسال
                    </option>
                    <br>
                    {{-- <option v-if="{{intval($shipment->max_price)}} < cartPayment" value="{{number_format(@$shipment->price).'تومان|'. @$shipment->price.'|'.@$shipment->id}}">{{$shipment->title}}</option> --}}
                    <option v-for="shopingmethod in shippingmethods" :value="shopingmethod">@{{ shopingmethod.title }}
                    </option>
                </select>
                <input name="post_type" type="hidden" value="1" />
                <input name="shipment_id" v-model="shipmentId" id="shipmentId" type="hidden" value="" />

                <input type="hidden" name="post_price" value="{{ @$setting_header->post_price1 }}">

                {{-- <p class="bg-white">روش ارسالی وجود نداره لطفا با پشتیبانی تماس بگیرید</p> --}}
            </div>

            <div class="modal-add mb-2">
                <textarea class="form-control form-control-sm" name="description" placeholder="اگر توضیحی دارید بنویسید"
                    id="floatingTextarea2" rows="3"></textarea>
            </div>

        @endif
        <ul class="m-0 p-0">
            <li class="list-unstyled d-flex justify-content-between mb-3">
                <p class="fm-md m-0 small">
                    قیمت کالاها
                </p>
                <p class="fm-re m-0 small">
                    @{{ cartSumPrice }} تومان
                </p>
            </li>
            @if (\Illuminate\Support\Facades\Auth::check())
            <li class="list-unstyled d-flex justify-content-between mb-3">
                <p class="fm-md m-0 small">
                    هزینه ارسال
                </p>
                <p class="fm-re m-0 small">
                    @{{ selectedPost }}
                </p>
            </li>
            @endif
            <li class="list-unstyled d-flex justify-content-between mb-md-3">
                <p class="fm-md m-0 small">
                    مبلغ کل
                </p>
                <p class="fm-re m-0 small">
                    @{{ (cartPayment + selectedPost2 + (selectedTax * cartPayment)).toLocaleString('en') }} تومان
                </p>
            </li>

            <li class="list-unstyled d-flex justify-content-between mt-lg-0 mt-3">
                @if (Auth::check())
                    <button type="submit" class="btn primary-btn btn-sm rounded-12 py-2 w-100">
                        تایید و تکمیل سفارش
                    </button>
                @else
                    <button type="button" class="btn primary-btn btn-sm rounded-12 py-2 w-100" data-bs-toggle="modal"
                        data-bs-target="#exampleModal3">
                        تایید و تکمیل سفارش
                    </button>
                @endif
            </li>



        </ul>
    </form>
</div>
