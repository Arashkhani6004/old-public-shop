@extends ("layouts.admin.master")
@section('title','اکسل')
@section('part','اکسل')
@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center" style="height: 90vh;">

            <div class="col-md-9">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row w-100">
                    <div class="col-md-8">
                    <h4 class="text-danger"> * قبل از هر بارگذاری مطمئن شوید اخرین تغییرات را خروجی گرفتید</h4>
                    </div>
                        <div class="col-md-4">
                    <a type="button" href="{{URL::action('Admin\VariableController@getExportVar')}}"
                       class="btn-info btn btn-space ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                            <path d="M6 12v-2h3v2H6z"/>
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3V9z"/>
                        </svg>
                        خروجی اکسل با متغییر
                    </a>
                        </div>
                    <div class="col-md-8">
                        <h4 class="text-danger">  * اگر مشخصه ای ویرایش میکنید " کد متغییر " باید تغییر نکرده باشد</h4>
                    </div>
                    <div class="col-md-8">
                        <h4 class="text-danger"> *   اگر مشخصه ای جدید تعریف میکنید " کد متغییر " باید خالی باشد</h4>
                    </div>

                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">بارگذاری اکسل متغیرها
                        </h3>
                        <hr>
                        <form method="post" action="{{URL::action('Admin\VariableController@postExcel')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-md-4">
                                    <label>انتخاب فایل:</label>
                                    <input  type="file" accept=".xlsx" name="excel_file" class="form-control"/>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">ذخیره</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('css')
    <style>
        ul {
            padding: 0px;
            margin: 0px;
        }

        #response {
            padding: 10px;
            background-color: #9F9;
            border: 2px solid #396;
            margin-bottom: 20px;
        }

        #list li {
            margin: 0 0 3px;
            padding: 8px;
            background-color: #333;
            color: #fff;
            list-style: none;
        }
    </style>
@stop


