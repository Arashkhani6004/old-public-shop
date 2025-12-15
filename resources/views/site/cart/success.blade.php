@extends('layouts.site.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/cart/checkout.css') }}" />
@stop

@section('content')

    <div class="refrence my-4">
        <div class=" container">
            <div
                class="col-xxl-3 col-xl-4 col-lg-5 col-md-6 col-8 m-auto d-flex justify-content-center align-items-center flex-column">
                <img src="{{ asset('assets/site/images/Frame 25.png') }}" class="w-100">
                <div class="d-flex align-items-center">
                    <a href="" class="btn primary-btn btn-sm px-4 rounded-12">
                        مشاهده جزئیات سفارش
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
