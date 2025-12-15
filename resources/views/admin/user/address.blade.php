@extends('layouts.admin.master')
@section('title','آدرس ها')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row w-100 m-0">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0">
                <div class="page-header">
                    <h3 class="bg-white py-2 px-4 rounded-lg">
                       آدرس های {{$user->name . '  ',$user->family}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="card">



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
                                            <table class="table table-striped table-bordered first dataTable"
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
                                                        ردیف
                                                    </th>
                                                    <th>استان</th>
                                                    <th>شهر</th>
                                                    <th class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1"
                                                        style="width: 80.0667px;"
                                                        aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">
                                                        آدرس
                                                    </th>
                                                    <th class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1"
                                                        style="width: 80.0667px;"
                                                        aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">
                                                        آدرس پیش فرض
                                                    </th>
                                                    <th class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1"
                                                        style="width: 80.0667px;"
                                                        aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">
                                                        عملیات
                                                    </th>



                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(@$addresses as $key=> $row)
                                                    <tr role="row" class="odd">

                                                        <td class="sorting_1">
                                                            {{$key+1}}</td>
                                                        <td class="sorting_1">{{@$row->state->name}}</td>
                                                        <td class="sorting_1">{{@$row->city->name}}</td>
                                                        <td class="sorting_1">
                                                            {{@$row->location}}</td>
                                                        <td class="sorting_1">
                                                        @if(@$row->default_address == 1) پیشفرض @else غیرفعال @endif
                                                        </td>
                                                        <td class="sorting_1">
                                                            <a href="{{URL::action('Admin\UserController@getEditAddress',@$row->id)}}" class="btn btn-warning btn-xs">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        </td>

                                                    </tr>
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
            {{--		</form>--}}
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
    </script>
@stop
