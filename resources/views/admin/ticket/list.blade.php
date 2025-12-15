@extends ("layouts.admin.master")
@section('title','تیکت ها')
@section('content')

    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row w-100 m-0">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0">
                <div class="page-header">
                    <h3 class="bg-white py-2 px-4 rounded-lg">
                تیکت ها
                    </h3>
                </div>
            </div>
        </div>

        <div class="card">

                    <!-- ============================================================== -->
                    <!-- end pageheader -->
                    <!-- ============================================================== -->
                    <div class="row w-100 m-0">
                        <!-- ============================================================== -->
                        <!-- basic table  -->
                        <!-- ============================================================== -->

                        <div class="col-sm-12 col-md-6 d-flex">

                            <button id="myBtn" class="btn-primary btn btn-space ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-2" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                جستجو
                            </button>
                            @foreach($departments as $row2)
                                <form action="{{url()->current()}}">
                                    <input type="hidden" name="department_id" value="{{$row2->id}}">
                                    <button type="submit"  class="btn btn-outline-dark ">{{$row2->name}}</button>

                                </form>
                        @endforeach
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
                                                            <input class="form-control date" autocomplete="off" type="text" id="datepicker1" name="start" placeholder="از تاریخ">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">تا تاریخ:</label>
                                                        <div class="col-lg-9">
                                                            <input class="form-control date" autocomplete="off" type="text" id="datepicker2" name="end" placeholder="تا تاریخ">
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
                                                        <label for="">وضعیت</label>
                                                        <div class="col-lg-9">
                                                            <select class="form-control" type="text"  name="status">
                                                                <option value="">انتخاب وضعیت</option>
                                                                <option value="0">پاسخ داده نشده</option>
                                                                <option value="1">                                                        پاسخ داده شده
                                                                </option>
                                                                <option value="2">                                                        بسته شده
                                                                </option>
                                                                <option value="3">                                                        مرجوع شد
                                                                </option>
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
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">

                                <div class="card-body px-1">
                                    <div class="table-responsive">
                                        <div id="DataTables_Table_0_wrapper"
                                             class="dataTables_wrapper dt-bootstrap4">
{{--                                            <div class="row w-100 m-0">--}}
{{--                                                <div class="col-sm-12 col-md-6">--}}
{{--                                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">--}}
{{--                                                        <label>--}}
{{--                                                            <input type="search"--}}
{{--                                                                   class="form-control form-control-sm"--}}
{{--                                                                   aria-controls="DataTables_Table_0"--}}
{{--                                                                   placeholder="جستجو ...">--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
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
                                                                #
                                                            </th>
                                                            <th class="sorting_asc" tabindex="0"
                                                                aria-controls="DataTables_Table_0"
                                                                rowspan="1" colspan="1"
                                                                style="width: 213.75px;"
                                                                aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending">
                                                                موضوع
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0"
                                                                rowspan="1" colspan="1"
                                                                style="width: 80.0667px;"
                                                                aria-label="Position: activate to sort column ascending">
                                                                کاربر
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0"
                                                                rowspan="1" colspan="1"
                                                                style="width: 80.0667px;"
                                                                aria-label="Position: activate to sort column ascending">
                                                                وضعیت
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0"
                                                                rowspan="1" colspan="1"
                                                                style="width: 80.0667px;"
                                                                aria-label="Position: activate to sort column ascending">
                                                                   نوع
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0"
                                                                rowspan="1" colspan="1"
                                                                style="width: 80.0667px;"
                                                                aria-label="Position: activate to sort column ascending">
                                                                دپارتمان
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

                                                                <td class="sorting_1">{{@$row->id}}</td>
                                                                <td class="sorting_1">{{@$row->subject}}</td>
                                                                <td class="sorting_1">
                                                                    {{@$row->user->name . ' '. @$row->user->family}}
                                                                </td>
                                                                <td class="sorting_1">
                                                                    @if($row->status == 0)
                                                                        پاسخ داده نشده
                                                                    @elseif($row->status == 1)
                                                                        پاسخ داده شده
                                                                    @elseif($row->status == 2)
                                                                        بسته شده
                                                                    @elseif($row->status == 3)
                                                                      مرجوع شد
                                                                    @endif

                                                                </td>
                                                                <td class="sorting_1">
                                                                    @if($row->order_item_id == null)
                                                                        تیکت
                                                                    @else
                                                                        مرجوعی
                                                                    @endif

                                                                </td>

                                                                <td>{{@$row->department->name}}</td>
                                                                <td>
                                                                    <a href="{{URL::action('Admin\TicketController@ticketDetail',$row['id'])}}" data-toggle="tooltip"
                                                                       data-original-title="ویرایش اطلاعات" class="btn btn-space  btn-success"><i
                                                                            class="fa fa-eye"></i> نمایش جزییات </a>

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


        $(document).ready(function() {
            $("#datepicker1").datepicker({
                changeMonth: true,
                changeYear: true
            });
            $("#datepicker2").datepicker({
                changeMonth: true,
                changeYear: true
            });

        });



    </script>

@stop
