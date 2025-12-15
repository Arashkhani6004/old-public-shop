@extends('site.panel.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/panel/panel.css?0.03') }}">
@stop
@section('content')
    <div class="header p-3 d-flex align-items-end justify-content-between">
        <p class="fm-md m-0 d-flex align-items-center h3">
            <i class="bi bi-handbag me-2 d-flex"></i>
            سفارش شماره {{ @$order->id }}
        </p>
        <div class="d-flex align-items-center gap-2">
            <a href="#factor" class="d-flex align-items-center btn primary-btn rounded-12 btn-sm fm-li px-3">مشاهده فاکتور</a>
            <a href="{{URL::action('Panel\PanelController@getfactor',$order->id)}}" class="d-flex align-items-center btn dark-btn  shadow-sm rounded-12 btn-sm fm-li px-3">چاپ
                فاکتور</a>

        </div>
    </div>
    <div class="content px-xl-3 py-2">
        <div class="order-detail">
            <div class="row w-100 m-0">
                <div class="col-xl-6 col-lg-12 col-md-6 p-1">
                    <div class="order-info">
                        <p class="fm-md">
                            اطلاعات سفارش
                        </p>
                        <div class="info-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar4 d-flex me-2"></i>
                                |
                                <p class="m-0 fm-re m-0 small ms-2">
                                    تاریخ سفارش
                                </p>
                            </div>

                            <p class="fm-md m-0">
                                {{ jdate('d F Y', @$order->created_at->timestamp) }}
                            </p>
                        </div>
                        <div class="info-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-truck d-flex me-2"></i>
                                |
                                <p class="m-0 fm-re m-0 small ms-2">
                                    نحوه ارسال
                                </p>
                            </div>

                            <p class="fm-md m-0 small">
                                {{ @$order->shipment->title }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-6 p-1">
                    <div class="user-info">
                        <p class="fm-md">
                            اطلاعات مشتری
                        </p>
                        <div class="info-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person d-flex me-2"></i>
                                |
                                <p class="m-0 fm-re m-0 small ms-2">
                                    نام
                                </p>
                            </div>

                            <p class="fm-md m-0">
                                {{ @$order->user->name }}
                            </p>
                        </div>
                        <div class="info-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person d-flex me-2"></i>
                                |
                                <p class="m-0 fm-re m-0 small ms-2">
                                    نام خانوادگی
                                </p>
                            </div>

                            <p class="fm-md m-0 small">
                                {{ @$order->user->family }}
                            </p>
                        </div>
                        <div class="info-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-telephone d-flex me-2"></i>
                                |
                                <p class="m-0 fm-re m-0 small ms-2">
                                    تلفن
                                </p>
                            </div>

                            <p class="fm-md m-0 small">
                                {{ @$order->user->mobile }}
                            </p>
                        </div>
                        <div class="info-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-envelope d-flex me-2"></i>
                                |
                                <p class="m-0 fm-re m-0 small ms-2">
                                    گد پستی
                                </p>
                            </div>

                            <p class="fm-md m-0 small">
                                {{ @$order->address->postal_code }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 p-1">
                    <div class="address-info">
                        <p class="fm-md">
                            اطلاعات آدرس
                        </p>
                        <div class="row w-100 m-0">
                            <div class="col-xl-6 p-1">
                                <div class="info-item d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-geo-alt d-flex me-2"></i>
                                        |
                                        <p class="m-0 fm-re m-0 small ms-2">
                                            شهر و استان
                                        </p>
                                    </div>

                                    <p class="fm-md m-0 small">
                                        {{ @$order->city->state->name }}-{{ @$order->city->name }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-6 p-1">
                                <div class="info-item d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-mailbox-flag d-flex me-2"></i>
                                        |
                                        <p class="m-0 fm-re m-0 small ms-2">
                                            کدپستی
                                        </p>
                                    </div>

                                    <p class="fm-md m-0 small">
                                        {{ @$order->address->postal_code }}
                                    </p>
                                </div>
                            </div>
                            @if (@$order->address->recipient_name != null)
                                <div class="col-xl-6 p-1">
                                    <div class="info-item d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person d-flex me-2"></i>
                                            |
                                            <p class="m-0 fm-re m-0 small ms-2">
                                                نام گیرنده
                                            </p>
                                        </div>

                                        <p class="fm-md m-0 small">
                                            {{ @$order->address->recipient_name }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            @if (@$order->address->recipient_phone != null)
                                <div class="col-xl-6 p-1">
                                    <div class="info-item d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-telephone d-flex me-2"></i>
                                            |
                                            <p class="m-0 fm-re m-0 small ms-2">
                                                تلفن گیرنده
                                            </p>
                                        </div>

                                        <p class="fm-md m-0 small">
                                            {{ @$order->address->recipient_phone }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            <div class="col-xl-12 p-1">
                                <div class="info-item d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-map d-flex me-2"></i>
                                        |
                                        <p class="m-0 fm-re m-0 small ms-2">
                                            آدرس
                                        </p>
                                    </div>

                                    <p class="fm-md m-0 small">
                                        {{ @$order->address->location }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 p-1 mt-3" id="factor">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">ردیف</th>
                                    <th scope="col">محصول</th>
                                    <th scope="col">تصویر</th>
                                    <th scope="col">تعداد</th>
                                    <th scope="col">قبمت(واحد)</th>
                                    <th scope="col">قیمت</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($order->orderItems as $key => $o)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>
                                            {{ @$o->product->title }} @if ($o->product_variable_id != null)
                                                ({{ @$o->variable->title }})
                                            @endif
                                        </td>
                                        <td>
                                            <img @if ($o->product_variable_id != null && file_exists('assets/uploads/content/pro/big/' . @$o->variable->image)) src="{{ asset('assets/uploads/content/pro/big/' . @$o->variable->image) }}" @elseif(file_exists('assets/uploads/content/pro/big/' . @$o->product->image[0]->file)) src="{{ asset('assets/uploads/content/pro/big/' . @$o->product->image[0]->file) }}" @else src="{{ asset('assets/site/images/notfound.png') }}" @endif
                                                width="50" alt="pro" title="pro" loading="lazy">
                                        </td>
                                        <td>{{ $o->quantity }}</td>
                                        <td>
                                            @if ($o->discount > 0)
                                                {{ number_format($o->discount) }}
                                            @else
                                                {{ number_format($o->price) }}
                                            @endif
                                            <span class="fm-li font-small">تومان</span>
                                        </td>
                                        <td>
                                            @if ($o->discount > 0)
                                                {{ number_format(@$o->quantity * @$o->discount) }}
                                            @else
                                                {{ number_format(@$o->quantity * @$o->price) }}
                                            @endif
                                            <span class="fm-li font-small">تومان</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="text-center">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>جمع کل</td>
                                    <td>{{ number_format(@$order->total_prices) }} تومان</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>هزینه ارسال</td>
                                    <td>{{ number_format(@$order->post_price) }} تومان</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <th>مبلغ پرداختی</th>
                                    <th>{{ number_format(@$order->payment) }} تومان</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
