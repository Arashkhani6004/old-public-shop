@extends('site.panel.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/panel/panel.css?0.03') }}">
@stop
@section('content')

    <div class="header p-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
        <p class="fm-md m-0 d-flex align-items-center h3">
            <i class="bi bi-map me-2 d-flex"></i>
            آدرس ها
        </p>
        <!-- Button for new address modal -->
        <button type="button" class="btn dark-btn rounded-10 btn-sm px-3 d-flex align-items-center" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            <i class="bi bi-plus d-flex me-1"></i>
            افزودن آدرس جدید
        </button>
    </div>
    <div class="content px-xl-3 py-2">
        <div class="addresses">
            <div class="row w-100 m-0">
                @foreach ($addresses as $row)
                    <div class="col-sm-12 p-1">
                        <div class="address-item p-2 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between">
                                @if ($row->default_address == 1)
                                    <a href="{{ URL::action('Site\ShopController@defaultAddress', $row->id) }}"
                                        class="m-0 d-flex align-items-center form-check small text-dark me-auto max-content">
                                        <i class="bi bi-check-square d-flex me-1 my-0"></i>
                                        آدرس پیش فرض
                                    </a>
                                @else
                                    <a href="{{ URL::action('Site\ShopController@defaultAddress', $row->id) }}"
                                        class="m-0 d-flex align-items-center form-check small text-dark me-auto max-content">
                                        <i class="bi bi-circle d-flex me-1 my-0"></i>
                                        انتخاب به عنوان پیش فرض
                                    </a>
                                @endif
                            </div>
                            <p class="fm-md m-0 mt-2">
                                {{ @$row->state->name }}
                                |
                                {{ @$row->name }}
                            </p>
                            <p class="fm-li m-0 small mt-1">
                                {{ @$row->location }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- add adress modal -->
            @include('site.panel.addresses._partials.add-modal')
        </div>
    </div>
@endsection
