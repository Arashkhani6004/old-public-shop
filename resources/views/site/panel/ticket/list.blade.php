@extends('site.panel.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/panel/panel.css?0.03') }}">
@stop
@section('content')
    <div class="header d-flex align-items-end justify-content-between p-3">
        <p class="font-md m-0 d-flex align-items-center h3">
            <i class="bi bi-mailbox me-2 d-flex"></i>
            تیکت ها 
        </p>
        <a href="{{route('panel.new-tickets')}}" class="btn btn-text btn-sm border-0 p-0 text-success d-flex align-items-center">
            <i class="bi bi-plus d-flex me-1"></i>
            تیکت جدید
        </a>
    </div>
    <div class="content px-xl-3 py-2">
        @if($tickets->count() > 0)
        <div class="tickets p-2">
            <div class="header border-bottom mb-2">
                <div class="row w-100 m-0">
                    <div class="col-1 p-1 text-center">
                        <p class="font-bold font-small m-0">شماره</p>
                    </div>
                    <div class="col p-1 text-center">
                        <p class="font-bold font-small m-0">عنوان</p>
                    </div>
                    <div class="col p-1 text-center">
                        <p class="font-bold font-small m-0">وضعیت</p>
                    </div>
                    <div class="col-1 p-1 text-center d-md-block d-none">
                        <p class="font-bold font-small m-0">نمایش</p>
                    </div>
                </div>
            </div>
            @foreach($tickets as $key=> $row)
            <div class="item">
                <a href="{{URL::action('Panel\TicketController@ticketDetail',$row->id)}}" class="font-re small m-0 d-block">
                    <div class="row w-100 m-0">
                        <div class="col-1 p-1 text-center align-self-center">
                            <p class="font-re small m-0">
                                {{@$key+1}}
                            </p>
                        </div>
                        <div class="col p-1 text-center align-self-center">
                            <p class="font-re small m-0">
                                {{@$row->subject}}
                            </p>
                        </div>
                        <div class="col p-1 text-center align-self-center">
                            @if($row->status == 0)
                            <span class="badge bg-transparent border-info border text-info font-re fw-light">
                                در انتظار پاسخ
                            </span>
                            @elseif($row->status == 1)
                            <span class="badge bg-transparent border-success border text-success font-re fw-light">
                                پاسخ داده شده
                            </span>
                            @elseif($row->status == 2)
                            <span class="badge bg-transparent border-danger border text-danger font-re fw-light">
                                بسته شده
                            </span>
                            @elseif($row->status == 3)
                            <span class="badge bg-transparent border-dark border text-dark font-re fw-light">
                                مرجوع شد
                            </span>
                            @endif
                        </div>
                        <div class="col-1 p-1 text-center align-self-center d-md-block d-none">
                            <i class="bi bi-chevron-left"></i>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
@endsection
