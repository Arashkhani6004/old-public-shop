@extends('layouts.admin.master')
@section('title',' جزییات فاکتور')
@section('content')
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row w-100 m-0">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0">
            <div class="page-header">
                <h3 class="bg-white py-2 px-4 rounded-lg">
                    جزییات فاکتور
                </h3>
            </div>
        </div>
    </div>
    <div class="row w-100 m-0">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header" style="color: #3c8dbc;"><i class="fa fa-user" aria-hidden="true"></i>
                    اطلاعات کاربر</h5>
                <div class="card-body px-1">
                    <div class="table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row w-100 m-0">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered first dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">نام کاربر
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{@$order->user->name . ' ' . @$order->user->family}}</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">کد کاربر
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{@$order->user->id}}</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">نام گیرنده
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending"> {{@$order->address->transferee_name . ' ' . @$order->address->transferee_family}}</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">شماره همراه
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{@$order->user->mobile}}</th>
                                        </tr>
                                         @if($order->recipient_name != NULL)
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">نام و نام خانوادگی تحویل گیرنده
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{@$order->address->recipient_name}}</th>
                                        </tr>
                                        @endif
                                        @if($order->recipient_phone  != NULL )
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending"> شماره تماس تحویل گیرنده
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{@$order->address->recipient_phone}}</th>
                                        </tr>
                                        @endif
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">کد پستی
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{@$order->address->postal_code}}</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">آدرس
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                {{@$order->address->location}}
                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">استان و شهر
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                               {{@$order->state->name}} / {{@$order->city->name}}
                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">تاریخ فاکتور
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{jdate(' Y/m/d - H:i',@$order->created_at->timestamp)}}</th>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <h5 class="card-header" style="color: #3c8dbc;"><i class="fa fa-user" aria-hidden="true"></i>
                    توضیحات کاربر</h5>
                <div class="card-body px-1">
                    <div class="table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row w-100 m-0">
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>{{ $order->description }}</textarea>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header" style="color: #3c8dbc;"><i class="fa fa-file" aria-hidden="true"></i>
                    اطلاعات فاکتور</h5>
                <div class="card-body px-1">
                    <div class="table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row w-100 m-0">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered first dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">شماره سفارش
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{@$order->id}}</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">روش ارسال
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                {{@$order->shipment->title}}
                                                {{-- @if($order->post_type == 1)  {{ @$setting_header->post_name1 }} @endif
                                                @if($order->post_type == 2)  {{ @$setting_header->post_name2 }} @endif --}}
                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">روش پرداخت
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                @if($order->pay_type == 1) پرداخت حضوری @else پرداخت آنلاین @endif
                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">مبلغ کل
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{number_format(@$order->total_prices)}}</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">حمل و نقل
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{number_format(@$order->post_price)}}</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">مبلغ محاسبه شده
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{number_format(@$order->total_calculated)}}</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">مالیات
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{number_format(@$setting_header->tax)}}</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">مبلغ پرداختی
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{number_format(@$order->payment)}}</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">کد پیگیری
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{@$order->tracking_code}}</th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">وضعیت پرداخت
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                <span class=''>{{$order->orderStatusName}}</span>
                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <form action="{{URL::action('Admin\OrderController@orderStatus',$order->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">وضعیت
                                                    فاکتور
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                    <select name="order_status_id" class="form-control">
                                                        @foreach($status as $key=>$item)
                                                        <option value="{{$item->id}}" @if($order->order_status_id == $item->id) selected @endif>{{$item->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="btn btn-primary">ذخیره</button>

                                                </th>
                                            </form>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    <a href="{{URL::action('Admin\OrderController@getfactor',$order->id)}}" type="button" class="btn btn-space btn-info" data-toggle="tooltip" target="_blank" title="نسخه قابل چاپ">
                        <i class="fa fa-print"> نسخه قابل چاپ</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader -->
    <!-- ============================================================== -->
    <div class="row w-100 m-0">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">

                <div class="card-body px-1">
                    <div class="table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">

                            <div class="row w-100 m-0">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered first dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                    ردیف
                                                </th>

                                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                    کد محصول
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 213.75px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                    تصویر محصول
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-label="Position: activate to sort column ascending">
                                                    عنوان محصول
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-label="Position: activate to sort column ascending">
                                                    عنوان متغیر محصول
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80.0667px;" aria-label="Position: activate to sort column ascending">
                                                    عنوان انگلیسی محصول
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 155.217px;" aria-label="Age: activate to sort column ascending">
                                                    مبلغ واحد
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 155.217px;" aria-label="Age: activate to sort column ascending">
                                                    تعداد
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 155.217px;" aria-label="Age: activate to sort column ascending">
                                                    مبلغ کل
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 155.217px;" aria-label="Age: activate to sort column ascending">
                                                    وضعیت مرجوعی
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->orderItems as $key=> $item)
                                            @if($item->quantity > 0)
                                            @php
                                            $var = App\Models\ProductVariable::where('id', $item->product_variable_id)->first();
                                            @endphp
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{@$key+1}}</td>
                                                <td class="sorting_1"> @if(isset($item->product->id)){{@$item->product->id}}@endif</td>
                                                <td class="sorting_1">
                                                    <a href="@if($item->product !== null){{ route('site.product.detail', ['id' => @$item->product->url]) }}  @endif">
                                                        @if (isset($var))
                                                        <img src="{{asset('assets/uploads/content/pro/big/'.@$var->image)}}" height="70" width="70">
                                                        @else
                                                        <img src="{{asset('assets/uploads/content/pro/big/'.@$item->product->image[0]->file)}}" height="70" width="70">
                                                        @endif
                                                    </a>
                                                </td>
                                                <td class="sorting_1">{{@$item->product->title . ' | '.@$item->productSpecificationValue->title  }} </td>
                                                @if(isset($var) > 0)
                                                <td class="sorting_1">{{@$var->title }} </td>
                                                @else
                                                <td class="sorting_1">متغیر وجود ندارد</td>
                                                @endif
                                                <td class="sorting_1">
                                                    {{@$item->product->title_en}}
                                                </td>
                                                <td class="sorting_1">
                                                    {{number_format($item->price)}}تومان
                                                </td>
                                                <td class="sorting_1">
                                                    {{$item->quantity}}
                                                </td>
                                                <td class="sorting_1">
                                                    {{number_format(@$item->quantity * @$item->price)}} تومان
                                                </td>
                                                <td class="sorting_1">
                                                    @if($item->order_item_status_id == 5)<span class='label label-danger'>مرجوع شد@else<span class='label label-warning'>--</span>@endif
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
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
