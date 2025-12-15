@extends('layouts.site.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/cart/checkout.css') }}" />
@stop
@section('content')

    <section class="cart mx-md-4 mt-md-3 mt-4 mb-5">
        <div class="container">
            <div class="col-xl-12 p-0">
                <div class="steps">
                    <ul class="p-0 m-0 d-flex align-items-center ">
                        <li class="list-unstyled ">
                            <a href="" class="d-flex flex-column align-items-center">
                                <i class="bi bi-cart d-flex"></i>
                                <span class="mt-2 font-re">سبد خرید</span>
                            </a>
                        </li>
                        <li class="list-unstyled active">
                            <a class="d-flex flex-column align-items-center">
                                <i class="bi bi-truck d-flex"></i>
                                <span class="mt-2 font-re">آدرس</span>
                            </a>
                        </li>
                        <li class="list-unstyled">
                            <a class="d-flex flex-column align-items-center">
                                <i class="bi bi-wallet2 d-flex"></i>
                                <span class="mt-2 font-re">تایید و پرداخت</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="checkout row w-100 m-0">
                <div class="col-xl-9 col-lg-8 ps-0 pe-0 pe-lg-2 mt-4">
                    <div class="addresses bg-white shadow-sm p-3 rounded-4">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <p class="fm-b m-0">آدرس های من</p>
                            <button type="button"
                                class="btn dark-btn py-1 rounded-3 px-2 btn-sm ms-2 font-small d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-plus d-flex"></i>
                                افزودن آدرس جدید
                            </button>
                        </div>
                        <hr class="my-2">
                        <div class="row w-100 m-0 p-0">
                            @include('site.cart._partials.address.address-list')
                        </div>
                        @include('site.cart._partials.address.add-modal')
                        @include('site.cart._partials.address.shipping')
                    </div>

                </div>
                <div class="col-xl-3 col-lg-4 pe-0 ps-0 ps-lg-2 mt-4 d-lg-block d-none">
                    @include('site.cart._partials.address.price-box')
                </div>
            </div>
        </div>
        <div class="mobile-checkout-btn d-lg-none d-block">
            <ul class="p-0 m-0 d-flex align-items-center justify-content-between">
                <li class=" list-unstyled d-flex align-items-center gap-1">
                    <a href="" class="btn primary-btn py-2 w-100 btn-sm font-small fm-md rounded-10">
                        تایید و تکمیل سفارش
                    </a>
                    <button class="btn btn-light text-dark p-1 rounded-circle small" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
                        aria-controls="collapseExample">
                        <i class="bi bi-chevron-down d-flex"></i>
                    </button>
                </li>
                <li class=" list-unstyled">
                    <p class="font-small fm-re text-secondary m-0 text-end">جمع سبد خرید</p>
                    <p class="fm-b m-0">
                        250,000 تومان
                    </p>
                </li>
            </ul>
            <div class="collapse mt-2" id="collapseExample">
                @include('site.cart._partials.address.price-box')
            </div>
        </div>
    

    </section>
@stop
