@extends('layouts.admin.master')
@section('title',' فاکتورها')
@section('content')
<div class="container-fluid  dashboard-content">
	<!-- ============================================================== -->
	<!-- pageheader -->
	<!-- ============================================================== -->
	<div class="row w-100 m-0">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0">
			<div class="page-header">
				<h3 class="bg-white py-2 px-4 rounded-lg">
					فاکتور ها
				</h3>
			</div>
		</div>
	</div>
	<div class="card">
        <div class="row w-100 m-0">
            <div class="col-sm-12 col-md-6">

                <button id="myBtn" class="btn-primary btn btn-space">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-2" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    جستجو
                </button>

                <!-- The Modal -->
                <div id="myModal" class="modal">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content border-0">
                            <div class="modal-header py-2 px-4">
                                    <span class="close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                                        </svg>
                                    </span>
                                <h2 class="m-0">
                                    جستجو
                                </h2>
                            </div>
                            <div class="modal-body p-3">
                                <form method="GET" action="{{URL::current()}}" class="m-0">

                                    <div class="row w-100 m-0">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">از تاریخ:</label>
                                            <div class="col-lg-9">
                                                <input autocomplete="off" class="form-control date" type="text" id="datepicker1" name="start" placeholder="از تاریخ">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">تا تاریخ:</label>
                                            <div class="col-lg-9">
                                                <input autocomplete="off" class="form-control date" type="text" id="datepicker2" name="end" placeholder="تا تاریخ">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">نام:</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" id="name" name="name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">شماره فاکتور:</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" id="id" name="id">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">نام خانوادگی:</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" id="family" name="family">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">ایمیل:</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="email" id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">تلفن:</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" id="mobile" name="mobile">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">مبلغ پرداختی:</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" id="payment" name="payment">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">وضعیت</label>
                                            <div class="col-lg-9">
                                                <select name="order_status_id" id="order_status_id" class="form-control">
                                                    @foreach($status as $key=>$item)
                                                        <option value=""
                                                        >انتخاب وضعیت</option>
                                                        <option value="{{$item->id}}"
                                                        >{{$item->title}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 p-1">
                                        <button type="submit" class="btn btn-success w-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                            </svg>
                                            جستجو
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-6">

                <button id="myBtn2" class="btn-success btn btn-space">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                        <path d="M6 12v-2h3v2H6z"/>
                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3V9z"/>
                    </svg>
                 خروجی اکسل
                </button>

                <!-- The Modal -->
                <div id="myModal2" class="modal">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content border-0">
                            <div class="modal-header py-2 px-4">
                                <span class="close2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                                    </svg>
                                </span>
                                <h2 class="m-0">
                                    خروجی اکسل
                                </h2>
                            </div>
                            <div class="modal-body p-3">
                                <form method="GET" action="{{URL::action('Admin\OrderController@export')}}" class="m-0">

                                    <div class="row w-100 m-0">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">از تاریخ:</label>
                                            <div class="col-lg-9">
                                                <input autocomplete="off" class="form-control date" type="text" id="datepicker3" name="start" placeholder="از تاریخ">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">تا تاریخ:</label>
                                            <div class="col-lg-9">
                                                <input autocomplete="off" class="form-control date" type="text" id="datepicker4" name="end" placeholder="تا تاریخ">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">نام:</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" id="name" name="name">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">نام خانوادگی:</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" id="family" name="family">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">ایمیل:</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="email" id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">تلفن:</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" id="mobile" name="mobile">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">مبلغ پرداختی:</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" id="payment" name="payment">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">وضعیت</label>
                                            <div class="col-lg-9">
                                                <select name="order_status_id" id="order_status_id" class="form-control">
                                                    @foreach($status as $key=>$item)
                                                        <option value="{{$item->id}}"
                                                        >{{$item->title}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 p-1">
                                        <button type="submit" class="btn btn-success w-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                            </svg>
                                            خروجی
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="px-4">
                <div class="p-1 border shadow-sm">
                    <div class="row w-100 m-0">
                        @foreach($status as $key=>$item)
                            @php $ordercount =App\Models\Order::where('order_status_id',$item->id)->count();
                            @endphp
                            <div class="col-xl-3 col-md-4 col-sm-6 col-6 p-1">
                                <form action="{{URL::current()}}">
                                    <input type="hidden" name="order_status_id" value="{{$item->id}}">
                                    <button type="submit"
                                            @if($item->id == 1) class="btn w-100 btn-instagram" @endif
                                            @if($item->id == 3) class="btn w-100 btn-success" @endif
                                            @if($item->id == 4) class="btn w-100 btn-warning" @endif
                                            @if($item->id == 5) class="btn w-100 " style="background-color:#6c757d" @endif
                                            @if($item->id == 6) class="btn w-100 bg-primary" @endif
                                            @if($item->id == 10) class="btn w-100 btn-danger" @endif
                                            @if($item->id == 9) class="btn w-100 btn-dark" @endif
                                            @if($item->id == 2) class="btn w-100 btn-info" @endif>
                                        {{$item->title}}({{$ordercount}})
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
		<form method="post" action="{{URL::action('Admin\OrderController@postDelete')}}" style="float: left">
			{{ csrf_field() }}
			<div class="">


                    <div class="px-2 py-3">
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" name="order_status_id">
                                    <option value="" selected>
                                        انتخاب کنید
                                    </option>
                                    @foreach($status as $key=>$item)
                                        <option value="{{$item->id}}">
                                            تغییر وضعیت :        {{$item->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 px-3 pt-2">
                                <button type="submit"
                                        data-toggle="tooltip" data-original-title="اعمال"
                                        class="btn btn-space btn-secondary m-0">

                                    اعمال
                                </button>
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
									<div id="DataTables_Table_0_wrapper"
										class="dataTables_wrapper dt-bootstrap4">

										<div class="row w-100 m-0">
											<div class="col-sm-12">
												<table
													class="table table-striped table-bordered first dataTable"
													id="DataTables_Table_0" role="grid"
													aria-describedby="DataTables_Table_0_info">
													<thead>
														<tr role="row">
															<th class="sorting_asc" tabindex="0"
																aria-controls="DataTables_Table_0"
																rowspan="1" colspan="1"
																style="width: 80.0667px;"
																aria-sort="ascending"
																aria-label="Name: activate to sort column descending">
																<input id="check-all"
																	style="opacity: 1;position:static;"
																	type="checkbox" />
																انتخاب همه
															</th>
															<th class="sorting_asc" tabindex="0"
																aria-controls="DataTables_Table_0"
																rowspan="1" colspan="1"
																style="width: 80.0667px;"
																aria-sort="ascending"
																aria-label="Name: activate to sort column descending">
																شماره فاکتور
															</th>
															<th class="sorting_asc" tabindex="0"
																aria-controls="DataTables_Table_0"
																rowspan="1" colspan="1"
																style="width: 213.75px;"
																aria-sort="ascending"
																aria-label="Name: activate to sort column descending">
																نام کاربر
															</th>
															<th class="sorting" tabindex="0"
																aria-controls="DataTables_Table_0"
																rowspan="1" colspan="1"
																style="width: 80.0667px;"
																aria-label="Position: activate to sort column ascending">
																 مبلغ فاکتور
															</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0"
                                                                rowspan="1" colspan="1"
                                                                style="width: 80.0667px;"
                                                                aria-label="Position: activate to sort column ascending">
                                                                وضعیت فاکتور
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0"
                                                                rowspan="1" colspan="1"
                                                                style="width: 80.0667px;"
                                                                aria-label="Position: activate to sort column ascending">
                                                                نوع پرداخت
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0"
                                                                rowspan="1" colspan="1"
                                                                style="width: 80.0667px;"
                                                                aria-label="Position: activate to sort column ascending">
                                                                تاریخ فاکتور
                                                            </th>
															<th class="sorting" tabindex="0"
																aria-controls="DataTables_Table_0"
																rowspan="1" colspan="1"
																style="width: 155.217px;"
																aria-label="Age: activate to sort column ascending">
																عملیات
															</th>

														</tr>
													</thead>
													<tbody>

														@foreach($data as $row)
														
                                                        <tr role="row" class="odd">
															<td class="sorting_1">
																<input
																	style="opacity: 1;position:static;"
																	name="deleteId[]"
																	class="delete-all" type="checkbox"
																	value="{{@$row['id']}}" />
															</td>
															<td class="sorting_1">{{@$row['id']}}</td>
															<td class="sorting_1">{{@$row->user->name . ' ' .@$row->user->family}}</td>
															<td class="sorting_1">{{number_format(@$row->payment)}} </td>
															<td class="sorting_1">{{@$row->orderStatus->title}} </td>
                                                            <td class="sorting_1">@if($row->pay_type==1)پرداخت حضوری @else پرداخت آنلاین @endif</td>
															<td class="sorting_1">{{jdate('Y/m/d',@$row->created_at->timestamp)}} </td>
															<td>
																<a href="{{URL::action('Admin\OrderController@getDetail',$row['id'])}}"
																	type="button"
																	class="btn btn-space btn-info"
																	data-toggle="tooltip"
																	title="جزئیات فاکتور">
																	<i class="fa fa-eye"> </i>
																</a>

															</td>
														</tr>

														@endforeach
													</tbody>
												</table>
												<div class="pagii">
													@if(count($data))
													{!!
													$data->appends(Request::except('page'))->render()
													!!}
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
		</form>
	</div>
</div>

@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('#check-all').change(function () {
                $(".delete-all").prop('checked', $(this).prop('checked'));
            });
        });



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

        $(document).ready(function() {
            $("#datepicker1").datepicker({
                changeMonth: true,
                changeYear: true
            });
            $("#datepicker2").datepicker({
                changeMonth: true,
                changeYear: true
            });
            $("#datepicker3").datepicker({
                changeMonth: true,
                changeYear: true
            });
            $("#datepicker4").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });



    </script>
@stop
