@extends('layouts.site.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/auth/auth.css?v.10') }}">
@endsection
@section('content')
    <section class="header-inner mt-lg-5 mt-4">
        <div class="container">
            <div class="title ">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <h1 class="m-0 fm-eb">
                        کد تایید
                    </h1>
                </div>
                <nav aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="" class="d-flex align-items-center text-dark fm-re">
                                <i class="bi bi-house d-flex me-1"></i>
                                خانه
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-dark" aria-current="page"> کد تایید </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section class="login-page mt-lg-0 mt-4">
        <div class="container">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8 col-11 p-0 m-auto">
                <div class="login-form">
                    <form class="mb-0" method="post" action="{{ URL::action('Panel\LoginController@postPanelLogin') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input name="product_id" value="{{ $product_id }}" type="hidden" />

                        @if (isset($order))
                            <input name="order" value="1" type="hidden" />
                        @endif
                        <input type="hidden" name="mobile" value="{{$user->mobile}}"/>
                        <div class="icon mb-4">
                            <img src="{{ asset('assets/site/images/mail.png') }}" width="60" class="m-auto d-flex">
                        </div>

                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label font-small fm-re text-center w-100">کد
                                تایید به شماره
                                شما
                                پیامک شد.
                            </label>
                            <input name="temp_password" type="text" class="form-control text-center"
                                id="exampleFormControlInput1" placeholder="کد تایید پیامک  شده را وارد کنید">
                        </div>
                        <button type="submit" class="btn primary-btn rounded-12 w-100">ورود</button>
                    </form>
                    <form class="mb-0" method="post"
                        action="{{ URL::action('Panel\LoginController@postRePassword', [$user->mobile]) }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="mobile" value="{{ $user->mobile }}">
                        <button type="submit" id="againCode" class="btn btn-again mt-2">ارسال مجدد کد</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('assets/site/js/auth/auth.js?v0.01') }}"></script>
@endsection
