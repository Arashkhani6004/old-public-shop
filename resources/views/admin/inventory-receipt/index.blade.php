@extends('layouts.admin.master')
@section('title', 'رسید جدید')
@section('content')
    <div class="container-fluid dashboard-content" role="main" id="feature">
        <div class="row w-100 m-0">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0">
                <div class="section-block" id="basicform" tabindex="-1">
                    <div class="page-header">
                        <h3 class="bg-white py-2 px-4 rounded-lg">
                            اضافه کردن رسید
                        </h3>
                    </div>
                </div>

            </div>
        </div>
        <div class="row w-100 m-0">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0">
                <div class="card">
                    <div class="row w-100 m-0">
                        <div class="col-sm-12 col-md-6 pt-2 px-1">
                            <a type="button" href="{{ URL::action('Admin\InventoryController@export') }}"
                                class="btn-success btn btn-space">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                                    <path d="M6 12v-2h3v2H6z" />
                                    <path
                                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3V9z" />
                                </svg>
                                خروجی اکسل
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 pt-2 px-1">
                        <button id="myBtn" class="btn-primary btn mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search me-2" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                            جستجو
                        </button>
                    </div>


                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content border-0">
                                <div class="modal-header py-2 px-4">
                                    <span class="close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-x-lg text-dark" viewBox="0 0 16 16">
                                            <path
                                                d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z" />
                                        </svg>
                                    </span>
                                    <h2 class="m-0">
                                        جستجو در انبار
                                    </h2>
                                </div>
                                <div class="modal-body p-3">
                                    <form action="{{ URL::current() }}" method="GET" class="m-0">
                                        <div class="row w-100 m-0">
                                            <div class="col-lg-9 p-1">
                                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                    <label class="w-100">
                                                        <input type="text" name="title"
                                                            class="form-control form-control-sm"
                                                            aria-controls="DataTables_Table_0" placeholder="جستجو ...">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 p-1">
                                                <button type="submit" class="btn btn-success w-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-search me-2" viewBox="0 0 16 16">
                                                        <path
                                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
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




                    <!-- ============================================================== -->
                    <!-- end pageheader -->
                    <!-- ============================================================== -->
                    <div class="row w-100 m-0">
                        <!-- ============================================================== -->
                        <!-- basic table  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">لیست رسید انبار</h5>
                                <div class="card-body px-1 py-3">
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
                                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                                    colspan="1" style="width: 80.0667px;"
                                                                    aria-sort="ascending"
                                                                    aria-label="Name: activate to sort column descending">
                                                                    ردیف
                                                                </th>
                                                                <th class="sorting_asc" tabindex="0"
                                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                                    colspan="1" style="width: 213.75px;"
                                                                    aria-sort="ascending"
                                                                    aria-label="Name: activate to sort column descending">
                                                                    محصول
                                                                </th>

                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                                    colspan="1" style="width: 155.217px;"
                                                                    aria-label="Office: activate to sort column ascending">
                                                                    تعداد
                                                                </th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                                    colspan="1" style="width: 155.217px;"
                                                                    aria-label="Office: activate to sort column ascending">
                                                                    نوع
                                                                </th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                                    colspan="1" style="width: 155.217px;"
                                                                    aria-label="Office: activate to sort column ascending">
                                                                    تاریخ
                                                                </th>
                                                                {{-- <th class="sorting" tabindex="0"
                                                                    aria-controls="DataTables_Table_0"
                                                                    rowspan="1" colspan="1"
                                                                    style="width: 155.217px;"
                                                                    aria-label="Office: activate to sort column ascending">
                                                                    وضعیت
                                                                </th> --}}


                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($data as $key => $row)
                                                                <tr role="row" class="odd">

                                                                    <td class="sorting_1">{{ $key + 1 }}</td>
                                                                    <td class="sorting_1">
                                                                        {{ @$row->product->title }} @if($row->product_variable_id != null) ({{@$row->variable->title}}) @endif
                                                                    </td>

                                                                    <td class="sorting_1">
                                                                        {{ @$row->count }}
                                                                    </td>

                                                                    <td class="sorting_1">
                                                                        {{ @$row->inventoryType->title }}
                                                                    </td>
                                                                    <td>{{ jdate('Y/m/d H:i', @$row->created_at->timestamp) }}
                                                                    </td>
                                                                    {{-- <td class="sorting_1">{{$row->status  ? 'نمایش در صفحه' : 'عدم نمایش در صفحه'}}</td> --}}
                                                                    {{-- <td>
                                                                    <button  type="button" class="btn btn-info" data-toggle="modal" data-target="#edit{{$row->id}}"> اصلاح وضعیت
                                                                    </button>
                                                                </td> --}}

                                                                </tr>
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
                                                    {{--                                                <div class="pagii"> --}}
                                                    {{--                                                    @if (count($products)) --}}
                                                    {{--                                                        {!! $products->appends(Request::except('page'))->render() !!} --}}
                                                    {{--                                                    @endif --}}
                                                    {{--                                                </div> --}}
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
        </div>
    </div>
    @foreach ($data as $row)
        <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1" role="dialog"
            aria-labelledby="messageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close btn btn-sm" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="messageModalLabel">
                            تغییر وضعیت
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form method="post"
                            action="{{ URL::action('Admin\InventoryController@postEditReceiptStatus', $row->id) }}">
                            {{ csrf_field() }}
                            <div class="col-lg-3 form-group">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">
                                    نمایش
                                </label>
                                <div class="col-12 col-sm-8 col-lg-6 pt-1">
                                    <div class="switch-button switch-button-yesno">
                                        <input type="checkbox" value="1"
                                            @if (isset($row->status) && $row->status == 1) checked="checked" @endif name="status"
                                            id="status{{ $row->id }}">
                                        <span>
                                            <label for="status{{ $row->id }}"></label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 px-1 pt-3 align-self-center">
                                <button type="submit" class="btn btn-success"> اصلاح </button>
                            </div>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach

@endsection

@section('js')

    <script src="{{ asset('asset/site/js/lodash.min.js') }}"></script>
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>
    <script src="https://unpkg.com/element-ui/lib/umd/locale/fa.js"></script>
    <script>
        var app = new Vue({
            el: '#app34534567',
            data: {
                numbers: [{
                    title: 'someinput' + 1,
                    title2: 'optlist' + 1,
                }],
                number: 1
            },
            methods: {
                plusMe: function() {
                    this.number = this.number + 1;
                    this.numbers.push({
                        title: 'someinput' + this.number,
                        title2: 'optlist' + this.number
                    });
                },
                search: function() {


                    @for ($i = 0; $i < 10; $i++)


                        var opts = $('#optlist{{ $i }} option').map(function() {
                            return [
                                [this.value, $(this).text()]
                            ];
                        });
                        console.log('heeelp');
                        var rxp = new RegExp($('#someinput{{ $i }}').val(), 'i');
                        var optlist = $('#optlist{{ $i }}').empty();
                        opts.each(function() {
                            if (rxp.test(this[1])) {
                                optlist.append($('<option/>').attr('value', this[0]).text(this[1]));
                            }
                        });
                    @endfor

                },

            }
        })
    </script>


    {{--        <script type="text/javascript"> --}}

    {{--            $(function() { --}}



    {{--                @for ($i = 0; $i < 10; $i++) --}}

    {{--                    var opts = $('#optlist{{$i}} option').map(function(){ --}}
    {{--                        return [[this.value, $(this).text()]]; --}}
    {{--                    }); --}}

    {{--                    $('#someinput{{$i}}').keyup(function(){ --}}
    {{--                        console.log('heeelp'); --}}
    {{--                        var rxp = new RegExp($('#someinput{{$i}}').val(), 'i'); --}}
    {{--                        var optlist = $('#optlist{{$i}}').empty(); --}}
    {{--                        opts.each(function(){ --}}
    {{--                            if (rxp.test(this[1])) { --}}
    {{--                                optlist.append($('<option/>').attr('value', this[0]).text(this[1])); --}}
    {{--                            } --}}
    {{--                        }); --}}
    {{--                    }); --}}
    {{--                @endfor --}}
    {{--            }); --}}
    {{--        </script> --}}


@endsection
