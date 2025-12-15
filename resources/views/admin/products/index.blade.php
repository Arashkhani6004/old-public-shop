@extends('layouts.admin.master')
@section('title','محصولات')
@section('content')
    <div class="container-fluid dashboard-content">
        <div class="row w-100 m-0">
            <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12 col-12 px-0">
                <div class="page-header">
                    <h3 class="bg-white py-2 px-4 rounded-lg">
                        محصولات
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card col-lg-12">

                <div class="px-2 py-3">
                    <a href="{{url('adminstrator/products/add')}}" type="button" class="btn btn-space btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-plus-circle-dotted me-2" viewBox="0 0 16 16">
                            <path
                                d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg>
                        جدید
                    </a>

                    <button id="myBtn2" class="btn-success btn btn-space">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                            <path d="M6 12v-2h3v2H6z"/>
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3V9z"/>
                        </svg>
                        خروجی اکسل
                    </button>

                    <!-- The Modal -->
                    <div id="myModal2" class="modal">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content border-0">
                                <div class="modal-header py-2 px-4">
                            <span class="close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                     class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path
                                        d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                                </svg>
                            </span>
                                    <h2 class="m-0">
                                        خروجی اکسل
                                    </h2>
                                </div>
                                <div class="modal-body p-3">
                                    <form method="GET" action="{{URL::action('Admin\ProductController@export')}}" class="m-0">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">برند</label>
                                            <div class="col-lg-9">
                                                <select name="brand_id" id="brand_id" class="form-control">
                                                    <option value="">انتخاب برند </option>
                                                    @foreach($brands as $key=>$item)
                                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">دسته بندی</label>
                                            <div class="col-lg-9">
                                                <select name="cat_id" id="cat_id" class="form-control">
                                                    <option value="">انتخاب دسته بندی </option>
                                                    @foreach($category as $key=>$cat_item)
                                                        <option value="{{ $cat_item->id }}">{{ $cat_item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-1">
                                            <button type="submit" class="btn btn-success w-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-search me-2" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                                </svg>
                                                خروجی
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a type="button" href="{{URL::action('Admin\ExcelController@getImport')}}"
                       class="btn-success btn btn-space">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                            <path d="M6 12v-2h3v2H6z"/>
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3V9z"/>
                        </svg>
                        ورودی اکسل
                    </a>
                    <a type="button" href="{{asset('assets/site/images/sample.xlsx')}}"
                       class="btn-success btn btn-space" target="_blank" download>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                            <path d="M6 12v-2h3v2H6z"/>
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3V9z"/>
                        </svg>
                        نمونه ورودی اکسل
                    </a>
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

                    <a type="button" href="{{URL::action('Admin\VariableController@getImportVar')}}"
                       class="btn-info btn btn-space">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                            <path d="M6 12v-2h3v2H6z"/>
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3V9z"/>
                        </svg>
                        ورودی اکسل با متغییر
                    </a>
                </div>

                <div class="row w-100 m-0">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body px-1">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row w-100 m-0">
                                            <div class="col-sm-12 col-md-6">

                                                <button id="myBtn" class="btn-primary btn mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-search me-2"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
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
                                                                        <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                                                                    </svg>
                                                                </span>
                                                                <h2 class="m-0">
                                                                    جستجو در محصولات
                                                                </h2>
                                                            </div>
                                                            <div class="modal-body p-3">
                                                                <form action="{{URL::current()}}" method="GET" class="m-0">
                                                                    <div class="row w-100 m-0">
                                                                        <div class="col-lg-9 p-1">
                                                                            <div id="DataTables_Table_0_filter"
                                                                                 class="dataTables_filter">
                                                                                <label class="w-100">
                                                                                    <input type="text" name="title" class="form-control form-control-sm" aria-controls="DataTables_Table_0" placeholder="جستجو ...">
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-lg-3 control-label">دسته بندی</label>
                                                                            <div class="col-lg-9">
                                                                                <select name="category_id" id="category_id" class="form-control">
                                                                                    <option value="">انتخاب دسته بندی </option>
                                                                                    @foreach($category as $key=>$cat_item)
                                                                                        <option value="{{ $cat_item->id }}">{{ $cat_item->title }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 p-1">
                                                                            <button type="submit" class="btn btn-success w-100">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-2" viewBox="0 0 16 16">
                                                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
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
                                            </div>
                                        </div>
                                        <div class="row w-100 m-0">
                                            <div class="col-sm-12">
                                                <table class="table table-striped table-bordered first dataTable"
                                                       id="DataTables_Table_0" role="grid"
                                                       aria-describedby="DataTables_Table_0_info">
                                                    <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc text-center">
                                                            {{--															<input id="check-all"--}}
                                                            {{--																style="opacity: 1;position:static;"--}}
                                                            {{--																type="checkbox" class="me-1" />--}}
                                                            ردیف
                                                        </th>
                                                        <th class="sorting_asc text-center">
                                                            تصویر
                                                        </th>
                                                        <th class="sorting_asc text-center">
                                                            عنوان
                                                        </th>

                                                        <th class="sorting_asc text-center">
                                                            url
                                                        </th>
                                                        <th class="sorting text-center">
                                                            برند
                                                        </th>
                                                        <th class="sorting text-center">
                                                            وضعیت
                                                        </th>
                                                        <th class="sorting text-center">
                                                            وضعیت موجودی
                                                        </th>
                                                        <th class="sorting text-center">
                                                            تغییر وضعیت موجودی و قیمت
                                                        </th>
                                                        <th class="sorting text-center">
                                                            عملیات
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php $urls=[];
                                                    @endphp

                                                    @foreach($products as $key=> $product)
                                                        <tr role="row" class="odd"
                                                            @if(in_array(@$product->url,$urls)) style="background-color: #0dcaf0" @endif>
                                                            <td class="sorting_1 text-center">
                                                                {{($products->appends(Request::except('page'))->currentPage() - 1) *
                                                                ($products->appends(Request::except('page'))->perPage()) + $key+1}}
                                                            </td>
                                                            <td class="sorting_1 text-center">
                                                                <img src="{!! $product->pro_image !!}" width="50"
                                                                     class="mx-auto swiper-lazy">
                                                            </td>
                                                            <td class="sorting_1 text-center">
                                                                {{@$product->title}}
                                                            </td>

                                                            <td class="sorting_1 text-center">
                                                                {{@$product->url}}
                                                            </td>
                                                            <td class="sorting_1 text-center">
                                                                {{@$product->brands->title}}
                                                            </td>
                                                            <td class="sorting_1 text-center">
                                                                {{$product->status  ? 'فعال' : 'غیرفعال'}}
                                                                @if($product->special ==1)
                                                                    /{{$product->special  ? '  پرفروش ترین' : ''}}
                                                                @endif @if($product->newest ==1)
                                                                    /{{$product->newest  ? '  جدید ترین' : ''}}
                                                                @endif @if($product->popular ==1)
                                                                    /{{$product->popular  ? '  محبوب ترین' : ''}}
                                                                @endif
                                                                @if($product->timer ==1)
                                                                    /{{$product->timer  ? '  نمایش ویژه تایمر ' : ''}}
                                                                @endif
                                                            </td>
                                                            <td class="sorting_1 text-center">

                                                                @if (count($product->variable) > 0)
                                                                    @foreach ($product->variable as $var)

                                                                        <label
                                                                            class="bg-primary d-flex justify-content-center align-items-center">{{$var->title}}
                                                                            : {{$var->stock}}</label>

                                                                    @endforeach
                                                                @else
                                                                    {{$product->count}}
                                                                @endif

                                                            </td>
                                                            <td class="sorting_1 text-center">
                                                                <a type="button" class="btn btn-space btn-info"
                                                                   data-toggle="modal"
                                                                   data-target="#exampleModal-{{$product->id}}"> <i
                                                                        class="fa fa-clipboard-list"></i>قیمت</a>
                                                                <a type="button" class="btn btn-space btn-success" id="moal-st" data-toggle="modal" data-target="#stokid-{{$product->id}}">
                                                                    <i class="bi bi-question-circle"></i>موجودی

                                                                </a>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="d-flex">
                                                                    <a href="{{URL::action('Admin\ProductController@getEditProduct',$product->id)}}"
                                                                       type="button" target="_blank"
                                                                       class="btn btn-space btn-warning my-0 ms-0 me-1"
                                                                       data-toggle="tooltip" title="ویرایش">
                                                                        <i class="fa fa-edit "></i>
                                                                    </a>
                                                                    <button
                                                                        onclick="document.getElementById('id0{{$product->id}}').style.display='block'"
                                                                        class="w3-button w3-black">
                                                                        عملیات
                                                                    </button>
                                                                    <div id="id0{{$product->id}}"
                                                                         class="w3-modal w3-animate-opacity">
                                                                        <div
                                                                            class="w3-modal-content w3-card-4 bg-transparent shadow-none"
                                                                            style="min-height: calc(100% - 3.5rem);height: calc(100% - 3.5rem);display: flex;align-items: center;">
                                                                            <div class="modal-content">
                                                                                <header
                                                                                    class="w3-container w3-teal modal-header"
                                                                                    style="display: flex;height: 3rem;">
                                                                                    <span
                                                                                        onclick="document.getElementById('id0{{$product->id}}').style.display='none'"
                                                                                        class="w3-button w3-large w3-display-topright">&times;</span>
                                                                                    {{@$product->title}}
                                                                                </header>
                                                                                <div
                                                                                    class="w3-container w-100 d-flex align-items-center justify-content-center py-5 overflow-scroll">
                                                                                    <div class="row w-100 m-0">
                                                                                        <div class="row w-100 m-0">
                                                                                            <div class="col p-1">
                                                                                                <a href="{{URL::action('Admin\ProductSpecificationController@getIndex',$product->id)}}" type="button" target="_blank" class="btn btn-space btn-info m-0 w-100" data-toggle="tooltip" title="لیست مشخصات">
                                                                                                    <i class="fa fa-clipboard-list"></i>
                                                                                                    مشخصات
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="col p-1">
                                                                                                <a href="{{URL::action('Admin\ProductController@getImage',$product->id)}}" type="button" target="_blank" class="btn btn-space btn-secondary m-0 w-100" data-toggle="tooltip" title="تصاویر بیشتر">
                                                                                                    <i class="fa fa-images"></i>
                                                                                                    تصاویر
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="col p-1">
                                                                                                <a href="{{URL::action('Admin\ProductController@getTimer',$product->id)}}" type="button" target="_blank" class="btn btn-space btn-dark m-0 w-100" data-toggle="tooltip" title="فروش ویژه">
                                                                                                    <i class="bi bi-shop"></i>
                                                                                                    فروش ویژه
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="col p-1">
                                                                                                <a href="{{URL::action('Admin\QuestionController@get',$product->id)}}" type="button" target="_blank" class="btn btn-space btn-success m-0 w-100" data-toggle="tooltip" title="اختصاص سوالات متداول">
                                                                                                    <i class="bi bi-question-circle"></i>
                                                                                                    سوالات متداول
                                                                                                    @php
                                                                                                        $faqcount =App\Models\Question::where('product_id',$product->id)->whereNull('answer')->count();
                                                                                                    @endphp
                                                                                                    <span class="badge badge-danger rounded-circle ms-2">
                                                                                                        {{@$faqcount}}
                                                                                                    </span>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row w-100 m-0">
                                                                                            <div class="col p-1">
                                                                                                <a href="{{ url('adminstrator/products/variables/'.$product->id) }}" type="button" target="_blank" class="btn btn-space btn-twitter m-0 w-100" data-toggle="tooltip" title="اختصاص متغیر">
                                                                                                    <i class="bi bi-bookmark"></i>
                                                                                                    متغیرها
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="col p-1">
                                                                                                <a href="{{URL::action('Admin\PropertiesController@get',$product->id)}}" type="button" target="_blank" class="btn btn-space btn-instagram m-0 w-100" data-toggle="tooltip" title="اختصاص  سایر مشخصات">
                                                                                                    <i class="bi bi-list-stars"></i>
                                                                                                    سایر مشخصات
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="col p-1">
                                                                                                <a href="{{url('/pro/'.@$product->url)}}" target="_blank" type="button" class="btn btn-space btn-primary m-0 w-100" data-toggle="tooltip" title="مشاهده در سایت">
                                                                                                    <i class="fa fa-eye"></i>
                                                                                                    مشاهده در سایت
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="col p-1">
                                                                                                <a href="{{URL::action('Admin\ProductController@getDeleteProduct',$product->id)}}" type="button" onclick="return confirm('آیا از حذف اطلاعات مطمئن هستید؟');" class="btn btn-space btn-danger m-0 w-100" data-toggle="tooltip" title="حذف">
                                                                                                    <i class="fa fa-trash"></i>
                                                                                                    حذف
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $urls[]=$product['url'];
                                                        @endphp
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row w-100 m-0">
                                            <div class="col-sm-12 col-md-5">
                                                <div class="dataTables_info" id="DataTables_Table_0_info"
                                                     role="status" aria-live="polite">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="pagii">
                                                    @if(count($products))
                                                        {!! $products->appends(Request::except('page'))->render() !!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @foreach($products as $key=> $product)
        {{-- modal price --}}
        <div class="modal fade" id="exampleModal-{{$product->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="{{URL::action('Admin\ProductController@changePrice')}}"
                      id="send-form-price">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تغیر قیمت</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @if (count($product->variable) > 0)
                                @foreach ($product->variable as $variables )
                                    <h6>{{$variables->title}}</h6>
                                    <input type="hidden" name="var_id" value="{{$variables->id}}">
                                    <input type="hidden" name="pro_id" value="{{$product->id}}">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">قیمت فعلی</label>
                                                <input type="text" class="form-control" name="price[]"
                                                       value="{{$variables->price}}" id="now_price">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">قیمت بعد
                                                    تخفیف</label>
                                                <input type="text" name="new_price[]"
                                                       value="{{ $variables->discounted_price }}" class="form-control"
                                                       id="dis_price">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h6>{{$product->title}}</h6>
                                <input type="hidden" name="pro_id" value="{{$product->id}}">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">قیمت فعلی</label>
                                            <input type="text" class="form-control" name="old_price"
                                                   value="{{$product->old_price}}" id="now_price">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">قیمت بعد تخفیف</label>
                                            <input type="text" name="price" class="form-control"
                                                   value="{{$product->price}}" id="dis_price">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                            <button type="submit" class="btn btn-primary">ذخیره</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- modal stoke --}}
        <div class="modal fade" id="stokid-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="stokeid"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="{{URL::action('Admin\ProductController@changeStock')}}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تغیر موجودی / جمع موجوی
                                : {{$product->count}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @if (count($product->variable) > 0)
                                @foreach ($product->variable as $variables )
                                    <h6>{{$variables->title}}</h6>
                                    <input type="hidden" name="var_id" value="{{$variables->id}}">
                                    <input type="hidden" name="pro_id" value="{{$product->id}}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">تعداد موجودی
                                                    فعلی</label>
                                                <input type="text" onkeyup="sum()" name="stock[]" class="form-control"
                                                       value="{{$variables->stock}}" id="now-st">
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            @else
                                <h6>{{$product->title}}</h6>
                                <input type="hidden" name="pro_id" value="{{$product->id}}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">موجودی فعلی</label>
                                            <input type="text" onkeyup="notCahr()" name="stock" class="form-control"
                                                   value="{{$product->count}}" id="stoke">
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                            <button type="submit" class="btn btn-primary">ذخیره</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- modal stoke --}}
    @endforeach

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

@section('js')

    <script>

        // my modal
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        $('.close').click(function() {
            $('#myModal').hide();
        });
        $('.close').click(function() {
            $('#myModal2').hide();
        });
        // my modal2
        var modal2 = document.getElementById("myModal2");
        var btn2 = document.getElementById("myBtn2");
        var span2 = document.getElementsByClassName("close2")[0];
        btn2.onclick = function() {
            modal2.style.display = "block";
        }
        span2.onclick = function() {
            modal2.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal2) {
                modal2.style.display = "none";
            }
        }
        function notCahr() {
            let filds = document.getElementById('stoke');
            if (isNaN(filds.value)) {
                filds.value = ""
                sweetAlert("خطا", "مقدار موجودی باید عدد انگلیسی باشد", "error");
            }
        }
    </script>
    <script>
        const modal_st = document.getElementById('moal-st')
        function sum() {
            let now_sts = document.querySelectorAll('#now-st');
            let new_st = document.getElementById('new-st');
            let span = document.getElementById('sum');
            let list_sum = [];
            let sum = 0;
            for (let now_st of now_sts) {
                list_sum.push(parseInt(now_st.value));
            }
            for (let item of list_sum) {
                sum += item
                span.innerHTML = sum;
            }
        }
        modal_st.addEventListener("click", function () {
            sum()
        })
    </script>
    <script>
        $(document).ready(function () {
            $('#check-all').change(function () {
                $(".delete-all").prop('checked', $(this).prop('checked'));
            });
        });
    </script>
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <script type="text/javascript">
        $(document).ready(function () {
            function slideout() {
                setTimeout(function () {
                    $("#response").slideUp("slow", function () {
                    });

                }, 2000);
            }
            $("#response").hide();
            $(function () {
                $("#list ul").sortable({
                    opacity: 0.8,
                    cursor: 'move',
                    update: function () {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        var order = $(this).sortable("serialize") + '&update=update' +
                            '&_token=' + CSRF_TOKEN;
                        $.post("{!!URL::action('Admin\ProductController@postSort')!!} ",
                        order,
                        function(theResponse) {
                            $("#response").html(theResponse);
                            $("#response").slideDown('slow');
                            slideout();
                        });
                }
            });
        });
    });
</script>
@stop
