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
                        ثبت نام
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
                        <li class="breadcrumb-item active text-dark" aria-current="page"> ثبت نام</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="login-page mt-lg-0 mt-4">
        <div class="container">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8 col-11 p-0 m-auto">
                <div class="login-form">
                    <form class="mb-0" method="post" action="{{ route('register') }}" enctype="multipart/form-data">
						{{ csrf_field() }}

						<input name="product_id" value="{{$product_id}}" type="hidden" />
                        @if(isset($order))
						<input name="order" value="1" type="hidden" />
						@endif

                        <div class="icon mb-4">
                            <img src="{{ asset('assets/site/images/incorporation.png') }}" width="60"
                                class="m-auto d-flex">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label font-small fm-re mb-1">نام و نام
                                خانوادگی</label>
                            <input type="text" class="form-control " name="name" id="exampleFormControlInput1"
                                placeholder="علی موحدی">
                        </div>
                        <div class="mb-2">
                            <label for="floatingSelect" class="form-label font-small fm-re mb-1">
                                جنسیت
                            </label>
                            <select class="form-select" id="floatingSelect" aria-label="Float[ing label select example" name="gender">
                                <option value="" selected disabled>انتخاب کنید</option>
                                @foreach($gender as $key=>$item)
                                <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label font-small fm-re mb-1">شماره همراه
                                خود را وارد کنید</label>
                            <input type="number" class="form-control " name="mobile" id="exampleFormControlInput1"
                                placeholder="09*********">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label font-small fm-re mb-1">ایمیل
                                خود را وارد کنید</label>
                            <input type="email" class="form-control " name="email" id="exampleFormControlInput1"
                                placeholder="example@example.com">
                        </div>
                        <div class="mb-2">
                            {!! \Mews\Captcha\Facades\Captcha::img() !!}
                            <label for="exampleFormControlInput1" class="form-label font-small fm-re mb-1">
                                کد امنیتی را وارد کنید
                            </label>
                            <input type="text" class="form-control " name="captcha" id="exampleFormControlInput1">
                        </div>
                        <button type="submit" class="btn primary-btn rounded-12 w-100">ثبت نام</button>
                        <p class="py-2 small text-secondary rounded-custom w-100">
                            اگر قبلا ثبت نام کرده اید، <a href="{{ route('panel.log') }}" class=" text-primary fm-b">وارد</a>
                            شوید
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
