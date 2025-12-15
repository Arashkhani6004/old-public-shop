@extends('site.panel.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/panel/panel.css?0.03') }}">
@stop
@section('content')
    <div class="header p-3">
        <p class="font-md m-0 d-flex align-items-center h3">
            <i class="bi bi-pencil-square me-2 d-flex"></i>
            ویرایش اطلاعات
        </p>
    </div>
    <div class="content px-xl-3 py-2">
        <div class="edit-info">
            <div class="login-form">
                <form class="m-0"method="post" action="{{URL::action('Panel\PanelController@postEditInfo')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row w-100 m-0">
                        <div class="col-6 p-1 mb-2">
                            <label for="name" class="form-label font-small fm-re mb-1">نام و نام خانوادگی</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" name="name" value="@if(isset($user->name)){{$user->name}}@endif" readonly id="full_name">
                                <button type="button" id="editButton" class="btn btn-edit fm-re btn-sm">
                                    <i class="bi bi-pencil d-flex"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-6 p-1 mb-2">
                            <label for="mobile" class="form-label font-small fm-re mb-1">شماره همراه</label>
                            <div class="position-relative">
                                <input type="text" name="mobile" value="@if(isset($user->mobile)){{$user->mobile}}@endif" class="form-control text-start" readonly
                                    id="mobile">
                                <button type="button" id="editButton" class="btn btn-edit fm-re btn-sm">
                                    <i class="bi bi-pencil d-flex"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-6 p-1 mb-2">
                            <label for="mobile" class="form-label font-small fm-re mb-1">ایمیل</label>
                            <div class="position-relative">
                                <input type="email" name="email" value="@if(isset($user->email)){{$user->email}}@endif" class="form-control text-start" readonly
                                    id="mobile">
                                <button type="button" id="editButton" class="btn btn-edit fm-re btn-sm">
                                    <i class="bi bi-pencil d-flex"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn primary-btn mt-2 ms-auto px-3 rounded-12 d-block">ثبت تغییرات</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/site/js/panel/panel.js') }}"></script>
@stop
