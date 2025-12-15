@extends('layouts.admin.master')
@section('title','سوالات متداول کاربران')
@section('content')
    <div class="container-fluid dashboard-content">
        <div class="row w-100 m-0">
            <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12 col-12 px-0">
                <div class="page-header">
                    <h3 class="bg-white py-2 px-4 rounded-lg">
                        سوالات متداول کاربران
                    </h3>
                </div>
            </div>
        </div>
        <div class="row w-100 m-0">
            <div class="card">
                <div class="card-body px-1">
                    <div class="table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row w-100 m-0">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered first dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc text-center">
                                                    ردیف
                                                </th>
                                                <th class="sorting_asc text-center">
                                                    سوال
                                                </th>
                                                <th class="sorting_asc text-center">
                                                    نام محصول
                                                </th>
                                                <th class="sorting text-center">
                                                    عملیات
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($questions as $key=>$question)
                                                <tr role="row" class="odd" style="background-color: #0dcaf0">
                                                    <td class="sorting_1 text-center">
                                                        {{$key+1}}
                                                    </td>
                                                    <td class="sorting_1 text-center">
                                                        {{Str::limit($question->question, 30)}}
                                                    </td>
                                                    <td class="sorting_1 text-center">
                                                        {{ $question->product->title }}
                                                    </td>
                                                    <td class="text-center d-flex justify-content-center">
                                                        <!--MODAL BUTTON-->
                                                        <!--<button type="button" class="btn btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#questionModal"> مشاهده جزئیات-->
                                                        <!--</button>-->
                                                        <!--MODAL-->
                                                        <!--<div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="questionModalLabel" aria-hidden="true">-->
                                                        <!--    <div class="modal-dialog modal-lg">-->
                                                        <!--        <div class="modal-content">-->
                                                        <!--            <div class="modal-header">-->
                                                        <!--                <h1 class="modal-title fs-5" id="questionModalLabel">جزئیات درخواست </h1>-->
                                                        <!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                                                        <!--            </div>-->
                                                        <!--            <div class="modal-body">-->
                                                        <!--                <div class="container-fluid">-->
                                                        <!--                    <div class="card-black row w-100 m-0">-->
                                                        <!--                        <div class="col-md-12 col-12 p-2 fs-6">-->
                                                        <!--                        </div>-->
                                                        <!--                    </div>-->
                                                        <!--                </div>-->
                                                        <!--            </div>-->
                                                        <!--            <div class="modal-footer">-->
                                                        <!--                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">بستن</button>-->
                                                        <!--            </div>-->
                                                        <!--        </div>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <a href="{{URL::action('Admin\UsersQuestionController@getAdd', $question->id)}}" type="button" class="btn btn-space btn-warning my-2 ms-0 me-1" data-toggle="tooltip" title="پاسخ دادن">
                                                            <i class="fa fa-edit "></i>
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
