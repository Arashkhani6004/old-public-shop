@extends('site.panel.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/panel/panel.css?0.03') }}">
@stop
@section('content')

    <div class="header p-3">
        <p class="fm-md m-0 d-flex align-items-center h3">
            <i class="bi bi-handbag me-2 d-flex"></i>
            سفارشات
        </p>
    </div>
    <div class="content px-xl-3 py-2">
        <div class="row w-100 m-0">
            <div class="col-xl-12 p-0">
                <div class="orders">
                    <div class="header border-bottom mb-2 d-md-block d-none">
                        <div class="row w-100 m-0">
                            <div class="col-2 p-1 text-center">
                                <p class="fm-b font-small m-0">شماره</p>
                            </div>
                            <div class="col p-1 text-center">
                                <p class="fm-b font-small m-0">اقلام</p>
                            </div>
                            <div class="col p-1 text-center">
                                <p class="fm-b font-small m-0">مبلغ سفارش</p>
                            </div>
                            <div class="col-3 p-1 text-center">
                                <p class="fm-b font-small m-0">وضعیت</p>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 m-0">
                        <div class="col-xxl-12 col-12 p-1">
                            @foreach ($on_orders as $on_order)
                                <div class="order-item">
                                    <a href="{{ url('panel/order-detail/' . $on_order->id) }}" class="text-dark">
                                        <div class="d-md-block d-none">
                                            <div class="row w-100 m-0">
                                                <div class="col-2 p-1 align-self-center text-center">
                                                    <p class="fm-re m-0 small">
                                                        {{ $on_order->id }}
                                                    </p>
                                                </div>
                                                <div class="col p-1">
                                                    <ul class="p-0 m-0 d-flex align-items-center justify-content-center">
                                                        @foreach ($on_order->orderItems as $item)
                                                            <li class="order-img">
                                                                @if (file_exists('assets/uploads/content/pro/big/' . @$item->variable->image) && $item->product_variable_id != null)
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item->variable->image) }}"
                                                                        alt="{{ @$item->product->title }}"
                                                                        title="{{ @$item->product->title }}" loading="lazy">
                                                                @elseif(file_exists('assets/uploads/content/pro/big/' . @$item->product->image[0]->file))
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item->product->image[0]->file) }}"
                                                                        alt="{{ @$item->product->title }}"
                                                                        title="{{ @$item->product->title }}" loading="lazy">
                                                                @else
                                                                    <img src="{{ asset('assets/site/images/notfound.png') }}"
                                                                        alt="{{ @$item->product->title }}"
                                                                        title="{{ @$item->product->title }}"
                                                                        loading="lazy">
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col p-1 align-self-center text-center">
                                                    <p class="fm-re fw-bold m-0">
                                                        {{ number_format($on_order->payment) }} تومان
                                                    </p>
                                                </div>
                                                <div class="col-3 p-1 align-self-center text-center">
                                                    <span
                                                        class="badge bg-transparent border-warning border text-warning fm-re fw-light">
                                                        در حال پردازش
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-md-none d-block">
                                            <div class="row w-100 m-0">
                                                <div class="col-6 p-1">
                                                    <p class="small fm-re m-0">
                                                        شماره : <span class="fm-re"> {{ $on_order->id }}</span>
                                                    </p>
                                                </div>
                                                <div class="col-6 p-1">
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <span
                                                            class="badge bg-transparent border-warning border text-warning fm-re fw-light">
                                                            در حال پردازش
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-1 mt-2">
                                                    <ul class="p-0 m-0 d-flex align-items-center justify-content-center">
                                                        @foreach ($on_order->orderItems as $item)
                                                            <li class="order-img">
                                                                @if (file_exists('assets/uploads/content/pro/big/' . @$item->variable->image) && $item->product_variable_id != null)
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item->variable->image) }}"
                                                                        alt="{{ @$item->product->title }}"
                                                                        title="{{ @$item->product->title }}"
                                                                        loading="lazy">
                                                                @elseif(file_exists('assets/uploads/content/pro/big/' . @$item->product->image[0]->file))
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item->product->image[0]->file) }}"
                                                                        alt="{{ @$item->product->title }}"
                                                                        title="{{ @$item->product->title }}"
                                                                        loading="lazy">
                                                                @else
                                                                    <img src="{{ asset('assets/site/images/notfound.png') }}"
                                                                        alt="{{ @$item->product->title }}"
                                                                        title="{{ @$item->product->title }}"
                                                                        loading="lazy">
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-9 p-1 mt-2">
                                                    <p class="fm-re m-0 fw-bolder">
                                                        مبلغ سفارش :
                                                        <span class="fm-re">
                                                            {{ number_format($on_order->payment) }} تومان
                                                        </span>

                                                    </p>
                                                </div>
                                                <div class="col-3 p-1 align-self-center mt-2">
                                                    <p
                                                        class="font-small btn btn-one btn-sm px-2 py-1 m-0 d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-eye d-flex me-1"></i>
                                                        مشاهده
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            @foreach ($before_orders as $before_order)
                                <div class="order-item">
                                    <a href="{{ url('panel/order-detail/' . $before_order->id) }}" class="text-dark">
                                        <div class="d-md-block d-none">
                                            <div class="row w-100 m-0">
                                                <div class="col-2 p-1 align-self-center text-center">
                                                    <p class="fm-re m-0 small">
                                                        {{ $before_order->id }}
                                                    </p>
                                                </div>
                                                <div class="col p-1">
                                                    <ul class="p-0 m-0 d-flex align-items-center justify-content-center">
                                                        @foreach ($before_order->orderItems as $item4)
                                                            <li class="order-img">
                                                                @if (file_exists('assets/uploads/content/pro/big/' . @$item4->variable->image) && $item4->product_variable_id != null)
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item4->variable->image) }}"
                                                                        alt="{{ @$item4->product->title }}"
                                                                        title="{{ @$item4->product->title }}"
                                                                        loading="lazy">
                                                                @elseif(file_exists('assets/uploads/content/pro/big/' . @$item4->product->image[0]->file))
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item4->product->image[0]->file) }}"
                                                                        alt="{{ @$item4->product->title }}"
                                                                        title="{{ @$item4->product->title }}"
                                                                        loading="lazy">
                                                                @else
                                                                    <img src="{{ asset('assets/site/images/notfound.png') }}"
                                                                        alt="{{ @$item4->product->title }}"
                                                                        title="{{ @$item4->product->title }}"
                                                                        loading="lazy">
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col p-1 align-self-center text-center">
                                                    <p class="fm-re fw-bold m-0">
                                                        {{ number_format($before_order->payment) }} تومان
                                                    </p>
                                                </div>
                                                <div class="col-3 p-1 align-self-center text-center">
                                                    <span
                                                        class="badge bg-transparent border-info border text-info fm-re fw-light">
                                                        در انتظار پرداخت
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-md-none d-block">
                                            <div class="row w-100 m-0">
                                                <div class="col-6 p-1">
                                                    <p class="small fm-re m-0">
                                                        شماره : <span class="fm-re"> {{ $before_order->id }}</span>
                                                    </p>
                                                </div>
                                                <div class="col-6 p-1">
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <span
                                                            class="badge bg-transparent border-info border text-info fm-re fw-light">
                                                            در انتظار پرداخت
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-1 mt-2">
                                                    <ul class="p-0 m-0 d-flex align-items-center justify-content-center">
                                                        @foreach ($before_order->orderItems as $item4)
                                                            <li class="order-img">
                                                                @if (file_exists('assets/uploads/content/pro/big/' . @$item4->variable->image) && $item4->product_variable_id != null)
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item4->variable->image) }}"
                                                                        alt="{{ @$item4->product->title }}"
                                                                        title="{{ @$item4->product->title }}"
                                                                        loading="lazy">
                                                                @elseif(file_exists('assets/uploads/content/pro/big/' . @$item4->product->image[0]->file))
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item4->product->image[0]->file) }}"
                                                                        alt="{{ @$item4->product->title }}"
                                                                        title="{{ @$item4->product->title }}"
                                                                        loading="lazy">
                                                                @else
                                                                    <img src="{{ asset('assets/site/images/notfound.png') }}"
                                                                        alt="{{ @$item4->product->title }}"
                                                                        title="{{ @$item4->product->title }}"
                                                                        loading="lazy">
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-9 p-1 mt-2">
                                                    <p class="fm-re m-0 fw-bolder">
                                                        مبلغ سفارش :
                                                        <span class="fm-re">
                                                            {{ number_format($before_order->payment) }} تومان
                                                        </span>

                                                    </p>
                                                </div>
                                                <div class="col-3 p-1 align-self-center mt-2">
                                                    <p
                                                        class="font-small btn btn-one btn-sm px-2 py-1 m-0 d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-eye d-flex me-1"></i>
                                                        مشاهده
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            @foreach ($sent_orders as $sent_order)
                                <div class="order-item">
                                    <a href="{{ url('panel/order-detail/' . $sent_order->id) }}" class="text-dark">
                                        <div class="d-md-block d-none">
                                            <div class="row w-100 m-0">
                                                <div class="col-2 p-1 align-self-center text-center">
                                                    <p class="fm-re m-0 small">
                                                        {{ $sent_order->id }}
                                                    </p>
                                                </div>
                                                <div class="col p-1">
                                                    <ul class="p-0 m-0 d-flex align-items-center justify-content-center">
                                                        @foreach ($sent_order->orderItems as $item2)
                                                            <li class="order-img">
                                                                @if (file_exists('assets/uploads/content/pro/big/' . @$item2->variable->image) && $item2->product_variable_id != null)
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item2->variable->image) }}"
                                                                        alt="{{ @$item2->product->title }}"
                                                                        title="{{ @$item2->product->title }}"
                                                                        loading="lazy">
                                                                @elseif(file_exists('assets/uploads/content/pro/big/' . @$item2->product->image[0]->file))
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item2->product->image[0]->file) }}"
                                                                        alt="{{ @$item2->product->title }}"
                                                                        title="{{ @$item2->product->title }}"
                                                                        loading="lazy">
                                                                @else
                                                                    <img src="{{ asset('assets/site/images/notfound.png') }}"
                                                                        alt="{{ @$item2->product->title }}"
                                                                        title="{{ @$item2->product->title }}"
                                                                        loading="lazy">
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col p-1 align-self-center text-center">
                                                    <p class="fm-re fw-bold m-0">
                                                        {{ number_format($sent_order->payment) }} تومان
                                                    </p>
                                                </div>
                                                <div class="col-3 p-1 align-self-center text-center">
                                                    <span
                                                        class="badge bg-transparent border-success border text-success fm-re fw-light">
                                                        تحویل داده شد
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-md-none d-block">
                                            <div class="row w-100 m-0">
                                                <div class="col-6 p-1">
                                                    <p class="small fm-re m-0">
                                                        شماره : <span class="fm-re"> {{ $sent_order->id }}</span>
                                                    </p>
                                                </div>
                                                <div class="col-6 p-1">
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <span
                                                            class="badge bg-transparent border-success border text-success fm-re fw-light">
                                                            تحویل داده شد
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-1 mt-2">
                                                    <ul class="p-0 m-0 d-flex align-items-center justify-content-center">
                                                        @foreach ($sent_order->orderItems as $item2)
                                                            <li class="order-img">
                                                                @if (file_exists('assets/uploads/content/pro/big/' . @$item2->variable->image) && $item2->product_variable_id != null)
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item2->variable->image) }}"
                                                                        alt="{{ @$item2->product->title }}"
                                                                        title="{{ @$item2->product->title }}"
                                                                        loading="lazy">
                                                                @elseif(file_exists('assets/uploads/content/pro/big/' . @$item2->product->image[0]->file))
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item2->product->image[0]->file) }}"
                                                                        alt="{{ @$item2->product->title }}"
                                                                        title="{{ @$item2->product->title }}"
                                                                        loading="lazy">
                                                                @else
                                                                    <img src="{{ asset('assets/site/images/notfound.png') }}"
                                                                        alt="{{ @$item2->product->title }}"
                                                                        title="{{ @$item2->product->title }}"
                                                                        loading="lazy">
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-9 p-1 mt-2">
                                                    <p class="fm-re m-0 fw-bolder">
                                                        مبلغ سفارش :
                                                        <span class="fm-re">
                                                            {{ number_format($sent_order->payment) }} تومان
                                                        </span>

                                                    </p>
                                                </div>
                                                <div class="col-3 p-1 align-self-center mt-2">
                                                    <p
                                                        class="font-small btn btn-one btn-sm px-2 py-1 m-0 d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-eye d-flex me-1"></i>
                                                        مشاهده
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            @foreach ($cancel_orders as $cancel_order)
                                <div class="order-item">
                                    <a href="{{ url('panel/order-detail/' . $cancel_order->id) }}" class="text-dark">
                                        <div class="d-md-block d-none">
                                            <div class="row w-100 m-0">
                                                <div class="col-2 p-1 align-self-center text-center">
                                                    <p class="fm-re m-0 small">
                                                        {{ $cancel_order->id }}
                                                    </p>
                                                </div>
                                                <div class="col p-1">
                                                    <ul class="p-0 m-0 d-flex align-items-center justify-content-center">
                                                        @foreach ($cancel_order->orderItems as $item3)
                                                            <li class="order-img">
                                                                @if (file_exists('assets/uploads/content/pro/big/' . @$item3->variable->image) && $item3->product_variable_id != null)
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item3->variable->image) }}"
                                                                        alt="{{ @$item3->product->title }}"
                                                                        title="{{ @$item3->product->title }}"
                                                                        loading="lazy">
                                                                @elseif(file_exists('assets/uploads/content/pro/big/' . @$item3->product->image[0]->file))
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item3->product->image[0]->file) }}"
                                                                        alt="{{ @$item3->product->title }}"
                                                                        title="{{ @$item3->product->title }}"
                                                                        loading="lazy">
                                                                @else
                                                                    <img src="{{ asset('assets/site/images/notfound.png') }}"
                                                                        alt="{{ @$item3->product->title }}"
                                                                        title="{{ @$item3->product->title }}"
                                                                        loading="lazy">
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col p-1 align-self-center text-center">
                                                    <p class="fm-re fw-bold m-0">
                                                        {{ number_format($cancel_order->payment) }} تومان
                                                    </p>
                                                </div>
                                                <div class="col-3 p-1 align-self-center text-center">
                                                    <span
                                                        class="badge bg-transparent border-danger border text-danger fm-re fw-light">
                                                        لغو شده
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-md-none d-block">
                                            <div class="row w-100 m-0">
                                                <div class="col-6 p-1">
                                                    <p class="small fm-re m-0">
                                                        شماره : <span class="fm-re"> {{ $cancel_order->id }}</span>
                                                    </p>
                                                </div>
                                                <div class="col-6 p-1">
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <span
                                                            class="badge bg-transparent border-danger border text-danger fm-re fw-light">
                                                            لغو شده
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-1 mt-2">
                                                    <ul class="p-0 m-0 d-flex align-items-center justify-content-center">
                                                        @foreach ($cancel_order->orderItems as $item3)
                                                            <li class="order-img">
                                                                @if (file_exists('assets/uploads/content/pro/big/' . @$item3->variable->image) && $item3->product_variable_id != null)
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item3->variable->image) }}"
                                                                        alt="{{ @$item3->product->title }}"
                                                                        title="{{ @$item3->product->title }}"
                                                                        loading="lazy">
                                                                @elseif(file_exists('assets/uploads/content/pro/big/' . @$item3->product->image[0]->file))
                                                                    <img src="{{ asset('assets/uploads/content/pro/big/' . @$item3->product->image[0]->file) }}"
                                                                        alt="{{ @$item3->product->title }}"
                                                                        title="{{ @$item3->product->title }}"
                                                                        loading="lazy">
                                                                @else
                                                                    <img src="{{ asset('assets/site/images/notfound.png') }}"
                                                                        alt="{{ @$item3->product->title }}"
                                                                        title="{{ @$item3->product->title }}"
                                                                        loading="lazy">
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-9 p-1 mt-2">
                                                    <p class="fm-re m-0 fw-bolder">
                                                        مبلغ سفارش :
                                                        <span class="fm-re">
                                                            {{ number_format($cancel_order->payment) }} تومان
                                                        </span>

                                                    </p>
                                                </div>
                                                <div class="col-3 p-1 align-self-center mt-2">
                                                    <p
                                                        class="font-small btn btn-one btn-sm px-2 py-1 m-0 d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-eye d-flex me-1"></i>
                                                        مشاهده
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
