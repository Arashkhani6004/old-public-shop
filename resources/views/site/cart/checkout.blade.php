@extends('layouts.site.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/cart/checkout.css?v0.02') }}" />
@stop

@section('content')
    <section class="cart mx-md-4 mt-md-5 mt-4 mb-5" v-if="loding == true && cartItems.length > 0">
        <div class="container">
            <div class="bg-white p-3 h-100 d-flex justify-content-center align-items-center">
                @include('layouts.site.components.loading')
            </div>
        </div>
    </section>
    <section class="cart mx-md-4 mt-md-5 mt-4 mb-5" v-else>
        <template v-if="order && cartItems.length > 0">
            <div class="container">

                <div class="checkout row w-100 m-0">
                    <div class="col-xl-9 col-lg-8 ps-0 pe-0 pe-lg-2 mt-4">
                        @if (strlen($setting_header->alert) > 1)
                            <div class="alert alert-warning alert-dismissible rounded-custom my-1 fade small position-relative show p-2 mb-3"
                                role="alert">
                                {{ @$setting_header->alert }}
                                <button type="button"
                                    class="btn-close shadow-none small position-absolute top-0 bottom-0 h-100 px-2 p-0 align-content-center"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="d-lg-none d-block">
                            @include('site.cart._partials.checkout.addresses')
                        </div>
                  
                        <div class="products">
                            <div class="d-flex align-items-center justify-content-end mb-1">
                                <p class="text-end m-0 fm-re small text-black-50">
                                    (@{{ cartTotal }} کالا)
                                </p>
                            </div>
                            <div class="product-item shadow-sm bg-white rounded-4 overflow-hidden position-relative mb-3"
                                v-for="cartItem in cartItems">
                                @include('site.cart._partials.checkout.item-list')
                            </div>
                        </div>
                        @if (App\Library\Helper::isMobile())
                            <div class="d-lg-none d-block">
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
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-4 pe-0 ps-0 ps-lg-2 mt-4 d-lg-block d-none">
                        @include('site.cart._partials.checkout.price-box')
                    </div>
                </div>
                <div class="mobile-checkout-btn d-lg-none d-block">
                    <ul class="p-0 m-0">
                        <li class=" list-unstyled d-flex align-items-center gap-1">
                            @if (!Auth::check())
                                <button class="btn primary-btn py-2 w-100 btn-sm font-small fm-md rounded-10" type="button"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal3">
                                    ادامه خرید
                                </button>
                            @else
                                <button
                                    class="btn
                                    primary-btn py-2 w-100 btn-sm font-small fm-md rounded-10"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                                    aria-expanded="false" aria-controls="collapseExample">
                                    ادامه خرید
                                </button>
                            @endif
                        </li>
                    </ul>
                    <div class="collapse mt-2" id="collapseExample">
                        @include('site.cart._partials.checkout.price-box')
                    </div>
                </div>


            </div>

            @include('site.cart._partials.checkout.add-address-modal')
            @include('site.cart._partials.checkout.change-address-modal')
        </template>
        <template v-else>
            <div class="container">
                <div
                    class="bg-white rounded-16 shadow-sm d-flex pb-3 flex-column justify-content-center align-items-center">
                    <img src="{{ asset('assets/site/images/empty-states/pro.png') }}"
                        class="col-xxl-2 col-xl-4 col-lg-5 col-md-6 col-8 m-auto" />
                    <p class="text-center fm-b mt-3 mb-0">
                        سبد خرید شما خالی است...!
                    </p>
                </div>
            </div>

        </template>
    </section>
    @include('site.cart._partials.checkout..auth-modal')
@stop
@section('scripts')
    @if(session('error'))
        <script>
              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            Swal.fire({
                icon: 'error',
                title: 'خطا در پرداخت',
                text: '{{ session('error') }}',
                confirmButtonText: 'باشه'
            });
        </script>
    @endif
@endsection
@section('scripts')
    <script>
        document.querySelectorAll('.number').forEach(counter => {
            const decreaseBtn = counter.querySelector('.decrease');
            const increaseBtn = counter.querySelector('.increase');
            const input = counter.querySelector('.number-input');

            increaseBtn.addEventListener('click', () => {
                let value = parseInt(input.value, 10);
                input.value = isNaN(value) ? 0 : value + 1;
            });

            decreaseBtn.addEventListener('click', () => {
                let value = parseInt(input.value, 10);
                input.value = isNaN(value) || value <= 0 ? 0 : value - 1;
            });
        });
    </script>
@stop
