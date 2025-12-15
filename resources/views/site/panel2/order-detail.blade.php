@extends('site.panel.master')
@section('content')

<div class="col-12 order-detail h-100 p-3">
<div class="col-sm-12 p-1">
			<p class="ismb h5 m-0 d-flex align-items-center justify-content-between">
				جزئیات سفارشات
				<i class="bi bi-handbag me-2 d-flex"></i>
			</p>
			<hr class="hr-panel">
</div>
<div class="col-sm-12 p-1">
    <ul class="row m-0 p-0 row-cols-1 row-cols-sm-2">
    <li class="col mb-2 pb-3 p-0 list-unstyled">کد پیگیری : <span>{{$order->traking_code}}</span></li>
	<li class="col mb-2 pb-3 p-0 list-unstyled">کد پستی : <span>{{$order->address->postal_code}}</span></li>
	<li class="col mb-2 pb-3 p-0 list-unstyled">تاریخ ثبت : <span>{{jdate('d F Y',@$order->created_at->timestamp)}}</span></li>
	<li class="col mb-2 pb-3 p-0 list-unstyled"> نحوه ارسال : <span>{{@$order->shipment->title}}</span></li>
	<li class="col mb-2 pb-3 p-0 list-unstyled"> قیمت کل : <span>{{number_format($order->payment)}}</span>تومان</li>
	<li class="col mb-2 pb-3 p-0 list-unstyled"> سود شما : <span>{{number_format($order->total_prices - $order->payment)}} </span>تومان</li>
	<li class="col mb-2 pb-3 p-0 list-unstyled">  نام تحویل گیرنده : <span>{{$order->user->name.' '.$order->user->family}}</span></li>
	<li class="col mb-2 pb-3 p-0 list-unstyled"> تلفن : <span>{{$order->address->transferee_mobile }}</span></li>
	<li class="col-12 mb-2 pb-3 p-0 list-unstyled">  آدرس : <span>	{{$order->address->location}}</span></li>
	@if($order->order_status_id  >= 3 && $order->order_status_id < 10)
        <li class="col-12 mb-2 pb-3 p-0 list-unstyled">
            <a href="{{URL::action('Panel\PanelController@getfactor',$order->id)}}" type="button" class="btn btn-space btn-info" data-toggle="tooltip" target="_blank" title="نسخه قابل چاپ">
                <i class="fa fa-print"> نسخه قابل چاپ</i>
            </a>
        </li>
        @endif

    </ul>
		<hr class="hr-panel mt-0">
</div>
@if($order->description != null)
<div class="col-sm-12 p-1">
	<p class="ismb h6 m-0">
		 توضیحات
	</p>
	<div class="col-12 pt-2">
 <p>
{{$order->description}}
</p>
	</div>
	<hr class="hr-panel">
</div>
@endif
@foreach($order->orderItems as $o)
    <div class="col-sm-12 p-1">
        <div class="col-12">
            <div class="col-12 row m-0 border p-2 rounded-4">
                <div class="col-xl-2 col-lg-3 col-md-6 col-sm-3 col-4 align-self-center p-2">
                    <img class="w-100" @if($o->product_variable_id != null && file_exists('assets/uploads/content/pro/big/'.@$o->variable->image)) src="{{asset('assets/uploads/content/pro/big/'.@$o->variable->image)}}" @elseif(file_exists('assets/uploads/content/pro/big/'.@$o->product->image[0]->file)) src="{{asset('assets/uploads/content/pro/big/'.@$o->product->image[0]->file)}}" @else src="{{asset('assets/site/images/notfound.png')}}" @endif alt="">
                </div>
                <div class="col-12 col-xl-10 col-md-12 col-sm-9 align-self-center position-relative pt-4 pb-3">
                    <div class="row w-100 m-0">
                        <div class="col-xl-9 align-self-center p-1">
                            <p class="m-0 fw-bold mb-2 h6">{{@$o->product->title}} @if($o->product_variable_id != null ) ({{@$o->variable->title}}) @endif</p>
                            <p class="m-0">تعداد : <span>{{$o->quantity}}</span></p>
                        </div>
                        <div class="col-xl-3 align-self-center p-1">
                            <p class="price-off m-0 m-auto me-0">@if($o->discount > 0) {{number_format($o->discount)}} @else {{number_format($o->price)}} @endif تومان</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endforeach
</div>


@stop
