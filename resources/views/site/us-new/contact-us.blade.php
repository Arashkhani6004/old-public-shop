@extends('layouts.site.master')
@section('title'){{ @$setting_header->title_contact ? $setting_header->title_contact : $setting_header->title }} @stop

@section('description')
    @if ($setting_header->des_contact != null)
        {!! $setting_header->des_contact !!}
    @else
        {!! $setting_header->description_seo !!}
    @endif
@stop
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/us/us.css') }}" />
@stop

@section('content')
    <section class="header-inner mt-lg-5 mt-4">
        <div class="container">
            <div class="title ">
                <div class="right d-flex align-items-center">
                    <span class="icon me-sm-2 me-1"></span>
                    <h1 class="m-0 fm-eb">
                        تماس با ما
                    </h1>
                </div>
                <nav aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="d-flex align-items-center color-title font-re">
                                <i class="bi bi-house d-flex me-1"></i>
                                خانه
                            </a>
                        </li>
                        <li class="breadcrumb-item active color-title" aria-current="page"> تماس با ما</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="contact-us mt-4">
        <div class="container">
            <div class="row w-100 m-0 align-items-start">
                <div class="col-lg-6 p-0 pe-lg-3 pe-0 ps-0 mb-lg-0 mb-4">
                    <div class="contact-info">
                        <p class="h5 mb-3 fm-b">راه های ارتباط باما</p>
                        <ul class="p-0 m-0 info">
                            <li class="list-unstyled">
                                <a href="tel:{{ @$setting_header->phone }}" class="d-flex align-items-center text-dark">
                                    <img src="assets/site/images/tel-dark-icon.svg" class="me-2" width="25"
                                        height="25" loading="lazy" alt="tel">
                                    <div class="">
                                        <p class="font-th small mb-0">
                                            تلفن
                                        </p>
                                        <p class="m-0" dir="ltr">
                                            {{ @$setting_header->phone }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li class="list-unstyled">
                                <a href="tel:{{ @$setting_header->contact }}" class="d-flex align-items-center text-dark">
                                    <i class="bi bi-headset d-flex fs-3 me-2"></i>
                                    <div class="">
                                        <p class="font-th small mb-0">
                                            ارتباط با پشتیبانی
                                        </p>
                                        <p class="m-0" dir="ltr">
                                            {{ @$setting_header->contact }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li class="list-unstyled">
                                <div class="d-flex align-items-center text-dark">
                                    <i class="bi bi-geo-alt-fill d-flex fs-3 me-2"></i>
                                    <div class="">
                                        <p class="font-th small mb-0">
                                            آدرس
                                        </p>
                                        <p class="m-0" dir="ltr">
                                            {{ @$setting_header->address }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-unstyled d-flex align-items-center text-dark">
                                <i class="bi bi-chat-left-quote-fill d-flex fs-3 me-3"></i>
                                <div class="">
                                    <p class="font-th small mb-2">
                                        ما را در شبکه های اجتماعی دنبال کنید
                                    </p>
                                    <ul class="p-0 m-0 d-flex align-items-center">
                                        @foreach ($socials as $social)
                                            <li class="list-unstyled me-4 mb-0">
                                                <a href="{{ $social->address }}">
                                                    <img src="{{ asset('assets/site/images/socials/' . $social->icon . '.png') }}"
                                                        width="20" height="20" alt="{{ $social->icon }}"
                                                        title="{{ $social->icon }}" />
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 p-0 ps-lg-3 ps-0 pe-0">
                    <div class="contact-form">
                        <form action="{{ URL::action('Site\HomeController@postContact') }}" method="POST" class="m-0">
                            {{ csrf_field() }}
                            <input type="hidden" name="type" value="4">
                            <div class="input-box">
                                <input type="text" placeholder="نام ونام خانوادگی"
                                    class="form-control border-0 shadow-none" required
                                    oninvalid="swal('ارور',' کاربرگرامی نام و نام خانوادگی الزامیست','error')"
                                    name="name">
                            </div>
                            <div class="input-box">
                                <input type="number" required
                                    oninvalid="swal('ارور',' کاربرگرامی شماره همراه الزامیست','error')" name="phone"
                                    dir="rtl" placeholder="شماره تماس" class="form-control border-0 shadow-none">
                            </div>
                            <div class="input-box">
                                <input type="text" name="subject" placeholder="عنوان پیام"
                                    class="form-control border-0 shadow-none">
                            </div>
                            <div class="input-box">
                                <textarea placeholder="متن پیام" name="message" class="form-control border-0 shadow-none" rows="3"></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn dark-btn px-5 py-1 rounded-10">ثبت</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (@$setting_header->maps != null)
                    <div class="col-sm-12 p-1">
                        <div class="bg-white product-details-header p-3">
                            {!! @$setting_header->maps !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@stop
