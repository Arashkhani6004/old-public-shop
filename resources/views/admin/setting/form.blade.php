@extends('layouts.admin.master')
@section('title', 'تنظیمات')
@section('content')
    <div class="container-fluid dashboard-content">
        <div class="row w-100 m-0">
            <div class="col-lg-12 mx-auto py-1 px-0">
                <h3 class="bg-white py-2 px-4 rounded-lg">
                    تنظیمات
                </h3>
                <div class="card rounded-lg border-0 p-3">
                    <form method="post" action="{{ URL::action('Admin\SettingController@postEditSetting', $data->id) }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <h4 class="bg-warning py-2 text-center">تنظیمات کلی</h4>
                            <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">عنوان</label>
                                <input id="title" name="title" type="text" class="form-control"
                                    value="@if (isset($data->title)) {{ $data->title }} @endif">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">h1</label>
                                <input id="h1" name="h1" type="text" class="form-control"
                                    value="@if (isset($data->h1)) {{ $data->h1 }} @endif">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="abouttitle" class="col-form-label">عنوان درباره ما</label>
                                <input id="abouttitle" name="abouttitle" type="text" class="form-control"
                                    value="@if (isset($data->abouttitle)) {{ $data->abouttitle }} @endif">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 form-group">
                                <label class="col-form-label"> تصویر درباره ما </label>
                                <input class="form-control" type="file" name="aboutimg">
                                @if (isset($data->aboutimg))
                                    <img src="{{ asset('assets/uploads/content/set/medium/' . $data->aboutimg) }}"
                                        class="w-50">
                                @endif
                            </div>
                            <div class="col-lg-4 form-group">
                                <label class="col-form-label"> لوگو </label>
                                <input class="form-control" type="file" name="logo">
                                @if (isset($data->logo))
                                    <img src="{{ asset('assets/uploads/content/set/' . $data->logo) }}" class="w-50">
                                @endif
                            </div>
                            <div class="col-lg-4 form-group">
                                <label class="col-form-label"> فو آیکون </label>
                                <input class="form-control" type="file" name="favicon">
                                @if (isset($data->favicon))
                                    <img src="{{ asset('assets/uploads/content/set/' . $data->favicon) }}" class="w-50">
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="col-form-label">تصویر تخفیف دارها(120*250) </label>
                                <input class="form-control" type="file" name="logo2">
                                @if (isset($data->logo2))
                                    <img src="{{ asset('assets/uploads/content/set/' . $data->logo2) }}" class="w-50">
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="col-form-label"> تصویر پیشنهاد ویژه (218*250)</label>
                                <input class="form-control" type="file" name="special_img">
                                @if (isset($data->special_img))
                                    <img src="{{ asset('assets/uploads/content/set/' . $data->special_img) }}"
                                        class="w-50">
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="col-form-label">بنر بالای صفحه دسکتاپ(75*1900)</label>
                                <div class="input-group">
                                    <input class="form-control" type="file" name="modal_img">
                                    @if(isset($data->modal_img))
                                    <div class="input-group-append">
                                        <a type="button" href="{{ url('adminstrator/setting/delete-modal-img') }}" class="fs-3 ms-2 text-decoration-none" style=" width: 20px; background: transparent; border: none; cursor: pointer; color: red;">&times;</a>
                                    </div>
                                    @endif
                                </div>
                                @if(isset($data->modal_img))
                                    <img src="{{ asset('assets/uploads/content/set/' . $data->modal_img) }}" class="w-50 mt-2">
                                @else
                                    <p class="mt-2">هیچ تصویری برای بنر بالای صفحه انتخاب نشده است.</p>
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="col-form-label">بنر بالای صفحه موبایل(100*1000)</label>
                                <div class="input-group">
                                    <input class="form-control" type="file" name="modal_mobile_img">
                                    @if(isset($data->modal_mobile_img))
                                    <div class="input-group-append">
                                        <a type="button" href="{{ url('adminstrator/setting/delete-modal-mobile-img') }}" class="fs-3 ms-2 text-decoration-none" style=" width: 20px; background: transparent; border: none; cursor: pointer; color: red;">&times;</a>
                                    </div>
                                    @endif
                                </div>
                                @if(isset($data->modal_mobile_img))
                                    <img src="{{ asset('assets/uploads/content/set/' . $data->modal_mobile_img) }}" class="w-50 mt-2">
                                @else
                                    <p class="mt-2">هیچ تصویری برای بنر بالای صفحه موبایل انتخاب نشده است.</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 form-group">
                                <label for="color1" class="col-form-label"> رنگ۱</label>
                                <input id="color1" name="color1" type="color" class="form-control"
                                    value="@if(isset($data->color1)){{$data->color1}}@endif" disabled>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label for="color2" class="col-form-label"> رنگ۲</label>
                                <input id="color2" name="color2" type="color" class="form-control"
                                    value="@if(isset($data->color2)){{$data->color2}}@endif" disabled>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label for="color3" class="col-form-label"> رنگ۳</label>
                                <input id="color3" name="color3" type="color" class="form-control"
                                    value="@if(isset($data->color3)){{ $data->color3 }}@endif" disabled>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label for="color4" class="col-form-label"> رنگ۴</label>
                                <input id="color4" name="color4" type="color" class="form-control"
                                    value="@if(isset($data->color4)){{ $data->color4 }}@endif" disabled>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label for="color5" class="col-form-label"> رنگ۵</label>
                                <input id="color5" name="color5" type="color" class="form-control"
                                    value="@if(isset($data->color5)){{ $data->color5 }}@endif" disabled>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label for="icon_filter" class="col-form-label"> رنگ آیکن ها</label>
                                <input id="icon_filter" name="icon_filter" type="text" class="form-control"
                                    value="@if(isset($data->icon_filter)){{ $data->icon_filter}}@endif" disabled>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="email" class="col-form-label"> ایمیل</label>
                                <input id="email" name="email" type="text" class="form-control"
                                    value="@if (isset($data->email)){{ $data->email }}@endif">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="contact" class="col-form-label"> تلفن پشتیبانی</label>
                                <input id="contact" name="contact" type="text" class="form-control"
                                    value="@if (isset($data->contact)) {{ $data->contact }} @endif">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="whatsapp" id="title-icon" class="col-form-label"> شماره واتساپ چت</label>
                                <input id="whatsapp" name="whatsapp" type="text" class="form-control"
                                    value="@if (isset($data->whatsapp)) {{ $data->whatsapp }} @endif">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="phone" class="col-form-label"> تلفن</label>
                                <input id="phone" name="phone" type="text" class="form-control"
                                    value="@if (isset($data->phone)) {{ $data->phone }} @endif">
                            </div>
                            <div class="col-lg-6 form-group ">
                                <select class="form-select" name="icon_fix" id="select" onchange="cheangTitle()" aria-label="Default select example">
                                    <option selected>انتخاب ایکون مورد نظر</option>
                                    <option @if (isset($data->icon_fix ) && $data->icon_fix == "whatsapp") selected @endif value="whatsapp">واتساپ</option>
                                    <option @if (isset($data->icon_fix ) && $data->icon_fix == "instagram") selected @endif value="instagram">اینستاگرام</option>
                                    <option @if (isset($data->icon_fix ) && $data->icon_fix == "telegram") selected @endif value="telegram">تلگرام</option>
                                    <option @if (isset($data->icon_fix ) && $data->icon_fix == "ita") selected @endif value="ita">ایتا</option>
                                    <option @if (isset($data->icon_fix ) && $data->icon_fix == "sorosh") selected @endif value="sorosh">سروش</option>
                                    <option @if (isset($data->icon_fix ) && $data->icon_fix == "bale") selected @endif value="bale">بله</option>
                                    <option @if (isset($data->icon_fix ) && $data->icon_fix == "robika") selected @endif value="robika">روبیکا</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="kave_phonenumber" class="col-form-label"> شماره دریافت پیام کاوه
                                    نگار</label>
                                <input id="kave_phonenumber" name="kave_phonenumber" type="text" class="form-control"
                                    value="@if (isset($data->kave_phonenumber)) {{ $data->kave_phonenumber }} @endif">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="kave_api" class="col-form-label"> api کاوه نگار</label>
                                <input id="kave_api" name="kave_api" type="text" class="form-control"
                                    value="@if (isset($data->kave_api)) {{ $data->kave_api }} @endif">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="address" class="col-form-label">آدرس</label>
                                <textarea class="form-control" id="address" name="address" rows="3">@if (isset($data->address)){!! $data->address !!}@endif</textarea>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="tax"  class="col-form-label">مالیات(درصد)</label>
                                <input id="tax" onkeyup="chekTax(this.id)" name="tax" id="tax" type="text" class="form-control"
                                    value="@if(isset($data->tax)){{$data->tax}}@endif">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="head_enamd" class="col-form-label"> شماره اینماد در هد </label>
                                <input id="head_enamd" name="head_enamd" type="text" class="form-control"
                                    value="@if (isset($data->head_enamd)) {{ $data->head_enamd }} @endif">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="footer_enamd" class="col-form-label">کد اینماد در فوتر</label>
                                <input id="footer_enamd" name="footer_enamd" type="text" class="form-control"
                                    value="@if (isset($data->footer_enamd)) {{ $data->footer_enamd }} @endif">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="code1" class="col-form-label">کد ساماندهی در فوتر</label>
                                <input id="code1" name="code1" type="text" class="form-control"
                                    value="@if (isset($data->code1)) {{ $data->code1 }} @endif">
                            </div>
                            <div class="form-group">
                                <label for="about" class="col-form-label">متن درباره ما </label>
                                <a href="{{ url('/about-us') }}" target="_blank" type="button" data-toggle="tooltip"
                                    title="مشاهده در سایت" class="btn btn-outline-primary btn-circle"><i
                                        class="fa fa-eye"></i></a>
                                <textarea class="form-control ckeditor" id="about" name="about" rows="3">@if (isset($data->about)){!! $data->about !!}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="rules" class="col-form-label">قوانین </label>
                                <a href="{{ url('/privacy-policy') }}" target="_blank" type="button"
                                    data-toggle="tooltip" title="مشاهده در سایت"
                                    class="btn btn-outline-primary btn-circle"><i class="fa fa-eye"></i></a>
                                <textarea class="form-control ckeditor" id="rules" name="rules" rows="3">@if (isset($data->rules)){!! $data->rules !!}@endif</textarea>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="about2" class="col-form-label">متن درباره مای صفحه اول</label>
                                <textarea class="form-control" id="about2" name="about2" rows="3">@if (isset($data->about2)){!! $data->about2 !!}@endif</textarea>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="description_seo" class="col-form-label">توضیحات سئو</label>
                                <textarea class="form-control" id="description_seo" name="description_seo" rows="3">@if (isset($data->description_seo)){!! $data->description_seo !!}@endif</textarea>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="alert" class="col-form-label">اخطار بالای سبد خرید</label>
                                <textarea class="form-control" id="alert" name="alert" rows="3">@if (isset($data->alert)){!! $data->alert !!}@endif</textarea>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="maps" class="col-form-label"> نقشه</label>
                                <a href="{{ url('/contact-us') }}" target="_blank" type="button" data-toggle="tooltip"
                                    title="مشاهده در سایت" class="btn btn-outline-primary btn-circle"><i
                                        class="fa fa-eye"></i></a>
                                <textarea class="form-control" id="maps" name="maps" rows="3" dir="ltr">@if (isset($data->maps)){!! $data->maps !!}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="rules" class="col-form-label">متن تماس بگیرید</label>
                                {{-- <a href="{{ url('/privacy-policy') }}" target="_blank" type="button"
                                    data-toggle="tooltip" title="مشاهده در سایت"
                                    class="btn btn-outline-primary btn-circle"><i class="fa fa-eye"></i></a> --}}
                                <textarea class="form-control ckeditor" id="call-description" name="call_description" rows="3">@if (isset($data->call_description)){!! $data->call_description !!}@endif</textarea>
                            </div>
                            <h4 class="bg-warning py-2 text-center">تنظیمات عنوان های صفحه اول سایت</h4>
                            <div class="col-lg-6 form-group">
                                <label for="title_1" class="col-form-label">عنوان 1</label>
                                <input id="title_1" name="title_1" type="text" class="form-control"
                                    value="@if (isset($data->title_1)) {{ $data->title_1 }} @endif">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="title_2" class="col-form-label">عنوان 2</label>
                                <input id="title_2" name="title_2" type="text" class="form-control"
                                    value="@if (isset($data->title_2)) {{ $data->title_2 }} @endif">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="title_3" class="col-form-label">عنوان 3</label>
                                <input id="title_3" name="title_3" type="text" class="form-control"
                                    value="@if (isset($data->title_3)) {{ $data->title_3 }} @endif">
                            </div>
                            <br>
                            <hr>
                            <br>
                            <h4 class="bg-warning py-2 text-center">تنظیمات سئو و هد سایت</h4>
                            <div class="col-lg-6 form-group">
                                <label for="analytics" class="col-form-label"> تگ های هد گوگل</label>
                                <textarea class="form-control" id="analytics" name="analytics" rows="3" dir="ltr">@if (isset($data->analytics)){!! $data->analytics !!}@endif</textarea>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="tagmanager" class="col-form-label"> تگ نواسکریپت بادی گوگل</label>
                                <textarea class="form-control" id="tagmanager" name="tagmanager" rows="3" dir="ltr">@if (isset($data->tagmanager)){!! $data->tagmanager !!}@endif</textarea>
                            </div>
                            @if ($data->noindex == 1)
                                <div class="col-lg-3 form-group">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">
                                        noindex
                                    </label>
                                    <div class="col-12 col-sm-8 col-lg-6 pt-1">
                                        <div class="switch-button switch-button-yesno">
                                            <input type="checkbox" value="1"
                                                @if (isset($data->noindex) && $data->noindex == 1) checked="checked" @endif name="noindex"
                                                id="noindex">
                                            <span>
                                                <label for="noindex"></label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-3 form-group">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">
                                    غیرفعالسازی سایت
                                </label>
                                <div class="col-12 col-sm-8 col-lg-6 pt-1">
                                    <div class="switch-button switch-button-yesno">
                                        <input type="checkbox" value="1"
                                            @if (isset($data->disable) && $data->disable == 1) checked="checked" @endif name="disable"
                                            id="disable">
                                        <span>
                                            <label for="disable"></label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="row">
                                <h4 class="bg-warning py-2 text-center">صفحات داخلی لیست</h4>
                                <div class="col-lg-6 form-group">
                                    <div class=" form-group">
                                        <label for="title_artcat" class="col-form-label">عنوان سئو دسته بندی
                                            مقالات</label>
                                        <input class="form-control" id="title_artcat" name="title_artcat"
                                            value="@if (isset($data->title_artcat)) {!! $data->title_artcat !!} @endif">
                                    </div>
                                    <label for="des_artcat" class="col-form-label"> توضیحات سئو دسته بندی مقالات</label>
                                    <textarea class="form-control" id="des_artcat" name="des_artcat" rows="3">@if (isset($data->des_artcat)){!! $data->des_artcat !!}@endif</textarea>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <div class=" form-group">
                                        <label for="title_brand" class="col-form-label">عنوان سئو برند </label>
                                        <input class="form-control" id="title_brand" name="title_brand"
                                            value="@if (isset($data->title_brand)) {!! $data->title_brand !!} @endif">
                                    </div>
                                    <label for="des_artcat" class="col-form-label"> توضیحات سئو برند </label>
                                    <textarea class="form-control" id="des_brand" name="des_brand" rows="3"> @if (isset($data->des_brand)){!! $data->des_brand !!}@endif</textarea>
                                </div>
                                <br>
                                <hr>
                                <br>
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <div class=" form-group">
                                            <label for="title_offers" class="col-form-label">عنوان سئو پیشنهادات
                                                ویژه </label>
                                            <input class="form-control" id="title_offers" name="title_offers"
                                                value="@if (isset($data->title_offers)) {!! $data->title_offers !!} @endif">
                                        </div>
                                        <label for="des_artcat" class="col-form-label"> توضیحات سئو پیشنهادات
                                            ویژه </label>
                                        <textarea class="form-control" id="des_offers" name="des_offers" rows="3"> @if (isset($data->des_offers)){!! $data->des_offers !!}@endif</textarea>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <div class=" form-group">
                                            <label for="title_contact" class="col-form-label">عنوان سئو تماس با
                                                ما </label>
                                            <input class="form-control" id="title_contact" name="title_contact"
                                                value="@if (isset($data->title_contact)) {!! $data->title_contact !!} @endif">
                                        </div>
                                        <label for="des_artcat" class="col-form-label"> توضیحات سئو تماس با ما </label>
                                        <textarea class="form-control" id="des_contact" name="des_contact" rows="3"> @if (isset($data->des_contact)){!! $data->des_contact !!}@endif</textarea>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <br>
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <div class=" form-group">
                                            <label for="title_rules" class="col-form-label">عنوان سئو قوانین </label>
                                            <input class="form-control" id="title_rules" name="title_rules"
                                                value="@if (isset($data->title_rules)) {!! $data->title_rules !!} @endif">
                                        </div>
                                        <label for="des_rules" class="col-form-label"> توضیحات سئو قوانین </label>
                                        <textarea class="form-control" id="des_rules" name="des_rules" rows="3"> @if (isset($data->des_rules)){!! $data->des_rules !!}@endif</textarea>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <div class="group">
                                            <label for="description_type" class="col-form-label">مکان توضیحات دسته بندی
                                                محصولات</label>
                                            <select id="optlist" class="form-control h-100" name="description_type"
                                                value="">
                                                <option value="2"
                                                    @if (isset($data->description_type)) @if ($data->description_type == 2) selected @endif
                                                    @endif >
                                                    پایین صفحه
                                                </option>
                                                <option value="1"
                                                    @if (isset($data->description_type)) @if ($data->description_type == 1) selected @endif
                                                    @endif >
                                                    بالا صفحه
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4 class="bg-warning py-2 text-center">بانک</h4>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bank_type" class="col-form-label">نوع درگاه </label>
                                    <select class="form-control h-100" name="bank_type">
                                        <option value="1" @if (isset($data) && $data->bank_type == '1') selected @endif> آی
                                            دی پی
                                        </option>
                                        <option value="2" @if (isset($data) && $data->bank_type == '2') selected @endif>
                                            زرین پال
                                        </option>
                                        <option value="3" @if (isset($data) && $data->bank_type == '3') selected @endif>
                                     سداد
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class=" form-group">
                                    <label for="merchent" class="col-form-label">مرچنت </label>
                                    <input class="form-control" id="merchent" name="merchent"
                                        value="@if (isset($data->merchent)) {!! $data->merchent !!} @endif">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class=" form-group">
                                    <label for="meli_bank_terminal_key" class="col-form-label">کد ترمینال سداد </label>
                                    <input class="form-control" id="meli_bank_terminal_key" name="meli_bank_terminal_key"
                                           value="@if (isset($data->meli_bank_terminal_key)) {!! $data->meli_bank_terminal_key !!} @endif">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class=" form-group">
                                    <label for="meli_bank_terminal_id" class="col-form-label">آیدی ترمینال سداد </label>
                                    <input class="form-control" id="meli_bank_terminal_id" name="meli_bank_terminal_id"
                                            value="@if (isset($data->meli_bank_terminal_id)) {!! $data->meli_bank_terminal_id !!} @endif">
                                </div>
                            </div>
                            <hr>
                            <h4 class="bg-warning py-2 text-center">تنظیمات سبد خرید</h4>
                            <div class="col-lg-4">
                                <div class=" form-group">
                                    <label class="col-12 col-sm-4 col-form-label text-sm-right">
                                        پرداخت در محل
                                    </label>
                                    <div class="col-12 col-sm-8 col-lg-6 pt-1">
                                        <div class="switch-button switch-button-yesno">
                                            <input @if (isset($data->status_send) && $data->status_send == 1) checked="checked" @endif
                                                type="checkbox" value="0" name="status_send" id="special">
                                            <span>
                                                <label for="special"></label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class=" form-group">
                                    <label class="col-12 col-sm-4 col-form-label text-sm-right">
                                        باکس تخفیف
                                    </label>
                                    <div class="col-12 col-sm-8 col-lg-6 pt-1">
                                        <div class="switch-button switch-button-yesno">
                                            <input @if (isset($data->box_discount) && $data->box_discount == 1) checked="checked" @endif
                                                type="checkbox" value="0" name="box_discount" id="newest">
                                            <span>
                                                <label for="newest"></label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-12 col-sm-4 col-form-label text-sm-right">
                                        تایید قوانین هنگام سفارش
                                    </label>
                                    <div class="col-12 col-sm-8 col-lg-6 pt-1">
                                        <div class="switch-button switch-button-yesno">
                                            <input @if (isset($data->status_police) && $data->status_police == 1) checked="checked" @endif
                                                type="checkbox" value="0" name="status_police" id="police">
                                            <span>
                                                <label for="police"></label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="bg-warning py-2 text-center">تنظیمات بازیابی رمز عبور  </h4>
                            <div class="col-lg-6">
                                <div class=" form-group">
                                    <label for="owner_mobile" class="col-form-label"> شماره همراه </label>
                                    <input class="form-control" id="owner_mobile" name="owner_mobile"
                                        value="@if (isset($data->owner_mobile)) {!! $data->owner_mobile !!} @endif">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class=" form-group">
                                    <label for="owner_email" class="col-form-label">ایمیل  </label>
                                    <input class="form-control" id="owner_email" type="email" name="owner_email"
                                            value="@if (isset($data->owner_email)) {!! $data->owner_email !!} @endif">
                                </div>
                            </div>
                            <h4 class="bg-warning py-2 text-center">  فاکتورها  </h4>
                            <div class="col-lg-6">
                                <div class=" form-group">
                                    <label for="factor_name" class="col-form-label"> نام فروشگاه در فاکتور </label>
                                    <input class="form-control" id="factor_name" name="factor_name"
                                        value="@if (isset($data->factor_name)) {!! $data->factor_name !!} @endif">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class=" form-group">
                                    <label for="factor_address" class="col-form-label"> ادرس فروشگاه در فاکتور </label>
                                    <input class="form-control" id="factor_address" name="factor_address"
                                            value="@if (isset($data->factor_address)) {!! $data->factor_address !!} @endif">
                                </div>
                            </div>

                            <div class="col-lg-12 p-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-space btn-success m-0 px-5">ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function cheangTitle()
        {
            title = document.getElementById('title-icon');
            value = document.getElementById('select').value;
            console.log(title);
            console.log(value);
            switch(value)
            {
                case 'whatsapp':
                title.textContent = 'شماره واتساپ چت';
                    break;
                case 'sorosh':
                    title.textContent = 'شماره سروش چت';
                    break;
                case 'instagram':
                    title.textContent = 'شماره اینستاگرام چت';
                    break;
                case 'telegram':
                    title.textContent = 'شماره تلگرام چت';
                    break;
                case 'ita':
                    title.textContent = 'شماره ایتا چت';
                    break;
                case 'bale':
                    title.textContent = 'شماره بله چت';
                    break;
                case 'robika':
                    title.textContent = 'شماره روبیکا چت';
                    break;
            }
        }

        function chekTax(id) {
        const numberpattern = /^[1-9+۱-۹]+$/;
        let el = document.getElementById(id)
        if (!numberpattern.test(el.value.trim())) {
            new swal("خطا","مقدار مالیات باید عدد باشد", "error");
            el.value = "";
            return false;
        }
    }



    </script>
@stop
