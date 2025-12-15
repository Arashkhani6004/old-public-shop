@extends('layouts.admin.master')
@section('title','مشخصات')
@section('content')
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row w-100 m-0">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0">
            @if($parent)
            <a href="{{URL::action('Admin\ProductSpecificationTypeController@getList',$parent->parent_id)}}" class="btn btn-default btn-info" style="float: left" data-toggle="tooltip" data-placement="top" title="" data-original-title="بازگشت">
                بازگشت
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle ms-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg>
            </a>
            @endif
            <div class="page-header">
                <h3 class="bg-white py-2 px-4 rounded-lg">
                    @if($parent)
                    {{'مشخصات'.' '.@$parent->title}}
                    @else
                    مشخصات
                    @endif
                </h3>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="py-3 px-2">
            @include('admin.product-specification-type.main')
            <a href="{{URL::action('Admin\ProductSpecificationTypeController@getAdd',$parent_id)}}" type="button" class="btn btn-space btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-dotted me-2" viewBox="0 0 16 16">
                    <path d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                </svg>
                جدید
            </a>
        </div>
        <div class="row w-100 m-0">
            <div class="col-lg-8 p-1">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body px-1">
                            <div class="table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row w-100 m-0">
                                        <div class="col-sm-12 col-md-6">
                                            <button id="myBtn" class="btn-primary btn mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-2" viewBox="0 0 16 16">
                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                </svg>
                                                جستجو
                                            </button>
                                            <!-- The Modal -->
                                            <div id="myModal" class="modal">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                    <div class="modal-content border-0">
                                                        <div class="modal-header py-2 px-4">
                                                            <span class="close">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg text-dark" viewBox="0 0 16 16">
                                                                    <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z" />
                                                                </svg>
                                                            </span>
                                                            <h2 class="m-0">
                                                                جستجو در ویژگی ها
                                                            </h2>
                                                        </div>
                                                        <div class="modal-body p-3">
                                                            <form action="{{URL::current()}}" method="GET" class="m-0">
                                                                <div class="row w-100 m-0">
                                                                    <div class="col-lg-9 p-1">
                                                                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                                            <label class="w-100">
                                                                                <input type="text" name="title" class="form-control form-control-sm" aria-controls="DataTables_Table_0" placeholder="جستجو ...">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 p-1">
                                                                        <button type="submit" class="btn btn-success w-100">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-2" viewBox="0 0 16 16">
                                                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                                            </svg>
                                                                            جستجو
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                جستجو دسته بندی
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"> جستجو</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="border p-1">
                                                                <label for="category_id" class="col-form-label">
                                                                    انتخاب دسته :
                                                                </label>
                                                                <form action="{{URL::current()}}">
                                                                    <div class="bg-light p-3">
                                                                        <div class="sd-checkbox ">
                                                                            <ul id="myUL" class="p-0 m-0" style="list-style-type:none">
                                                                                @foreach ($category as $key => $row2)
                                                                                @php
                                                                                $cat = \App\Models\Category::find($row2['id']);
                                                                                $s =\App\Models\ProductSpecificationTypeCategory::all();
                                                                                @endphp
                                                                                <li>
                                                                                    <label class="custom-ch">
                                                                                        {{ $row2['title'] }}
                                                                                        <input type="radio" value="{{ $row2['id'] }}" name="category_id" class="form-control" @if(@$cat->childs && count(@$cat->childs) > 0) disabled @endif>
                                                                                        <span class="checkmark"></span>
                                                                                    </label>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 p-1">
                                                                        <button type="submit" class="btn btn-success w-100">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-2" viewBox="0 0 16 16">
                                                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                                            </svg>
                                                                            جستجو
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row w-100 m-0">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-bordered first dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                            ردیف
                                                        </th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 213.75px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                            عنوان
                                                        </th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 213.75px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                            نمایش
                                                        </th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 213.75px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                            نمایش در فیلتر ها
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 155.217px;" aria-label="Age: activate to sort column ascending">
                                                            عملیات
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data as $key => $row)
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{$key+1}}</td>
                                                        <td class="sorting_1">{{@$row['title']}} @if($row['status'] == 1) (مشخصه ثابت) @endif</td>
                                                        <td>
                                                            @if($row->parent_id == null)
                                                                @if($row->view==1)
                                                                    <span class='label text-dark'>فعال</span>
                                                                    <a href="{{route('admin.pst.view',['id'=>$row->id])}}" data-toggle="tooltip" class="btn btn-outline-danger  btn-xs">غیرفعال</a>
                                                                @else
                                                                    <span class='label label-info text-dark'>غیرفعال</span>
                                                                    <a href="{{route('admin.pst.view',['id'=>$row->id])}}" data-toggle="tooltip" class="btn btn-outline-success  btn-xs">فعال</a>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($row->parent_id == null)
                                                                @if($row->status==1)
                                                                    <span class='label text-dark'>فعال</span>
                                                                    <a href="{{route('admin.pst.status',['id'=>$row->id])}}" data-toggle="tooltip" class="btn btn-outline-danger  btn-xs">غیرفعال</a>
                                                                @else
                                                                    <span class='label label-info text-dark'>غیرفعال</span>
                                                                    <a href="{{route('admin.pst.status',['id'=>$row->id])}}" data-toggle="tooltip" class="btn btn-outline-success  btn-xs">فعال</a>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{URL::action('Admin\ProductSpecificationTypeController@getEdit',$row['id'])}}" type="button" class="btn btn-space btn-warning" data-toggle="tooltip" title="ویرایش">
                                                                <i class="fa fa-edit"> </i>
                                                            </a>
                                                            <a href="{{URL::action('Admin\ProductSpecificationTypeController@getDelete',$row['id'])}}" type="button" class="btn btn-space btn-danger" data-toggle="tooltip" title="حذف">
                                                                <i class="fa fa-trash"> </i>
                                                            </a>
                                                            @if(@$row->parent_id == null)
                                                            <a href="{{URL::action('Admin\ProductSpecificationTypeController@getList',$row['id'])}}" type="button" class="btn btn-space btn-secondary" data-toggle="tooltip" title="مقادیر">
                                                                <i class="fa fa-puzzle-piece"> </i>
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#messageModal{{$row['id']}}" data-original-title="ویرایش دسته ها" title="ویرایش دسته ها" class="btn btn-space btn-info"><i class="fa fa-list"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-1">
                <div id="list">
                    <div class="alert alert-info alert-dismissable rounded-lg" style="direction: rtl; margin: 0px auto;">
                        <i class="fa fa-check"></i>
                        <span style="font-size: 14px;"> با درگ کردن ترتیب مورد نظر را انتخاب نمایید. </span>
                    </div>
                    <div id="response"></div>
                    <ul>
                        <hr>
                        <div class="alert alert-primary alert-dismissable rounded-lg" style="direction: rtl; margin: 0px auto;">
                            <i class="fa fa-arrow-circle-down"></i>
                            <span style="font-size: 10px;"> ترتیب مشخصه ها </span>
                        </div>
                        @foreach($sortDatas as $key => $row)
                        <li class="list-unstyled  my-2 p-3 shadow-sm rounded-lg" id="arrayorder_{!! stripslashes($row['id']) !!}" style="background-color: #333">
                            <div class="clear">{{$row->title}}</div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <center>
            @if(count($data))
            {!! $data->appends(Request::except('page'))->render() !!}
            @endif
        </center>
    </div>
</div>
@foreach($data as $row)
    <div class="modal fade" id="messageModal{{$row['id']}}" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close btn btn-sm" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="messageModalLabel">
                        {{ @$row->title }}
                    </h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{URL::action('Admin\ProductSpecificationTypeController@postCatAdd')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="pst_id" value="{{$row->id}}">
                        <div class="row w-100 m-0">
                            <div class="col-md-12 col-sm-12 col-xs-12 p-1 align-self-center">
                                <div class="border p-1">
                                    <label for="category_id" class="col-form-label">
                                        انتخاب دسته :
                                    </label>
                                    <div class="bg-light p-3">
                                        <input type="text" class="form-control mb-2" id="myInput{{$row->id}}" onkeyup="myFunction{{$row->id}}()" placeholder="جستجو ..">
                                        <div class="sd-checkbox ">
                                            <ul id="myUL{{$row->id}}" class="p-0 m-0" style="list-style-type:none">
                                                @foreach ($category as $key => $row2)
                                                    @php
                                                        $cat = \App\Models\Category::find($row2['id']);
                                                        $s =\App\Models\ProductSpecificationTypeCategory::where('pst_id', $row['id'])->pluck('category_id')->toArray();
                                                    @endphp
                                                    <li>
                                                        <label class="custom-ch">
                                                            {{ $row2['title'] }}
                                                            <input type="checkbox" value="{{ $row2['id'] }}" @if (in_array($row2['id'], $s)) checked="checked" @endif name="category_id[]" class="form-control" multiple>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 px-1 pt-3 align-self-center">
                                <button type="submit" class="btn btn-success"> اضافه کردن</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">
                                    عنوان
                                </th>
                                <th scope="col">
                                    عملیات
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(@$row->categories as $item)
                                <tr>
                                    <th scope="row">
                                        {{@$item->title}}
                                    </th>
                                    <td class="text-center">
                                        <a href="{{URL::action('Admin\ProductSpecificationTypeController@getCatDelete',[$row->id,$item->id])}}" data-toggle="tooltip" data-original-title="حذف اطلاعات" class="btn btn-danger  btn-xs">
                                            <i class="fa fa-trash"></i>
                                            حذف
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/admin/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/admin/vendor/jQueryUI/jquery-ui.min.js')}}"></script>
    <meta name="csrf-token" content="{!! csrf_token() !!}" />
    <script type="text/javascript">
        $(document).ready(function() {
            function slideout() {
                setTimeout(function() {
                    $("#response").slideUp("slow", function() {});

                }, 2000);
            }
            $("#response").hide();
            $(function() {
                $("#list ul").sortable({
                    opacity: 0.8,
                    cursor: 'move',
                    update: function() {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        var order = $(this).sortable("serialize") + '&update=update' + '&_token=' + CSRF_TOKEN;
                        $.post("{!!URL::action('Admin\ProductSpecificationTypeController@sortSpe')!!} ", order, function(theResponse) {
                            $("#response").html(theResponse);
                            $("#response").slideDown('slow');
                            slideout();
                        });
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        function myFunction{{$row->id}}() {
            var input, filter, ul, li, la, i, txtValue;
            input = document.getElementById("myInput{{$row->id}}");
            filter = input.value.toUpperCase();
            var chek = document.getElementById('chek');
            ul = document.getElementById("myUL{{$row->id}}");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                la = li[i].getElementsByTagName("label")[0];
                txtValue = la.textContent || la.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
@endforeach
@endsection
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
@section('js')
<script>
    $(document).ready(function() {
        $('#check-all').change(function() {
            $(".delete-all").prop('checked', $(this).prop('checked'));
        });
    });
</script>
@stop
