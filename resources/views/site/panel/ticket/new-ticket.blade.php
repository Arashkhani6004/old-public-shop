@extends('site.panel.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/panel/panel.css?0.03') }}">
@stop
@section('content')
    <div class="header p-3">
        <p class="font-md m-0 d-flex align-items-center h3">
            <i class="bi bi-pencil-square me-2 d-flex"></i>
            تیکت جدید
        </p>
    </div>
    <div class="content px-xl-3 py-2">
        <div class="edit-info">
            <div class="login-form">
                <form action="{{ URL::action('Panel\TicketController@postNewTicket') }}" method="post" class="m-0"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row w-100 m-0">
                        <div class="col-6 p-1 mb-2">
                            <label for="name" class="form-label font-small fm-re mb-1">عنوان</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" name="subject" id="full_name">
                            </div>
                        </div>
                        <div class="col-6 p-1 mb-2">
                            <label for="department_id" class="form-label font-small fm-re mb-1">دپارتمان</label>
                            <select name="department_id" class="form-select" aria-label="Default select example"
                                id="department_id">
                                <option value="" selected>انتخاب دپارتمان</option>
                                @foreach ($departments as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 p-1 mb-2">
                            <label for="message" class="form-label font-small fm-re mb-1">متن درخواست خود را بنویسید</label>
                            <textarea rows="3" class="form-control form-control-sm" id="message" name="message" placeholder="متن درخواست" ></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn primary-btn mt-2 ms-auto px-3 rounded-12 d-block">ارسال تیکت</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/site/js/panel/panel.js') }}"></script>
@stop
