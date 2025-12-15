@extends ("layouts.admin.master")
@section('title','اکسل')
@section('part','اکسل')
@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center" style="height: 90vh;">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">بارگذاری اکسل محصولات</h3>
                        <hr>
                        <form method="post" action="{{URL::action('Admin\ExcelController@postExcel')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">

                                <div class="col-md-4">
                                    <label>انتخاب فایل:</label>
                                    <input  type="file" name="excel_file" class="form-control"/>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">ذخیره</button>
                            </div>
                        </form>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>

            {{-- 		<div class="col-xs-4">
                        <div id="list">
                            <div class="alert alert-info alert-dismissable" style="direction: rtl; margin: 0px auto;">
                                <i class="fa fa-check"></i>
                                <span style="font-size: 14px;">	با درگ کردن ترتیب مورد نظر را انتخاب نمایید.  </span>
                            </div>

                            <div id="response"></div>
                            <ul>
                                @foreach($categorySort as $rowSort)

                                    <li id="arrayorder_{!! stripslashes($rowSort['id']) !!}">{!! stripslashes($rowSort['title']) !!}
                                        <div class="clear"></div>
                                    </li>

                                @endforeach
                            </ul>
                        </div>
                    </div> --}}

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
    </script>

    {{-- <meta name="csrf-token" content="{!! csrf_token() !!}"/> --}}
    {{--     <script type="text/javascript">
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
                        opacity: 0.8, cursor: 'move', update: function () {
                            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                            var order = $(this).sortable("serialize") + '&update=update' + '&_token=' + CSRF_TOKEN;
                            $.post("{!!URL::action('Admin\ProductController@postSort')!!} ", order, function (theResponse) {
                                $("#response").html(theResponse);
                                $("#response").slideDown('slow');
                                slideout();
                            });

                        }
                    });
                });

            });
        </script> --}}


@stop
