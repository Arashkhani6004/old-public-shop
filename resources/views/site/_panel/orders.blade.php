@extends('site.panel.master')
@section('content')

<div class="card rounded-custom orders p-3 border-0 h-100">
	<div class="row w-100 m-0">
		<div class="col-sm-12 p-1">
			<p class="ismb h5 m-0 d-flex align-items-center justify-content-between">
				سفارشات
				<i class="bi bi-key text-a h4 my-0 me-2 d-flex"></i>
			</p>
			<!-- <hr class="hr-panel"> -->
		</div>
		<div class="col-sm-12 p-1">
			<ul class="nav nav-tabs p-0 m-0" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="1-tab" data-bs-toggle="tab" data-bs-target="#tab1"
						type="button" role="tab" aria-controls="tab1" aria-selected="true">
						در حال پردازش
						<span class="badge bg-secondary rounded-circle">{{$on_orders->count()}}</span>
					</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="2-tab" data-bs-toggle="tab" data-bs-target="#tab2"
						type="button" role="tab" aria-controls="tab2" aria-selected="false">
						در انتظار پرداخت
						<span class="badge bg-secondary rounded-circle">{{$before_orders->count()}}</span>
					</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="3-tab" data-bs-toggle="tab" data-bs-target="#tab3"
						type="button" role="tab" aria-controls="tab3" aria-selected="false">
						تحویل شده
						<span class="badge bg-secondary rounded-circle">{{$sent_orders->count()}}</span>
					</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="4-tab" data-bs-toggle="tab" data-bs-target="#tab4"
						type="button" role="tab" aria-controls="tab4" aria-selected="false">
						لغو شده
						<span class="badge bg-secondary rounded-circle">{{$cancel_orders->count()}}</span>
					</button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="1-tab">
					<div class="row w-100 m-0">

						@if($on_orders->count() > 0)
                            @foreach($on_orders as $on_order)

                            <div class="col-sm-12 px-0 py-1">
                                <div class="border p-1">
                                    <div class="row w-100 m-0">
                                        <div class="col-xxl-7 align-self-center p-1">
                                            <ul class="p-0 m-0 d-flex align-items-center">
                                                <li class="list-unstyled mx-1">
                                                    {{jdate('d F Y',@$on_order->created_at->timestamp)}}
                                                </li>
                                                <li class="list-unstyled mx-0">
                                                    <i class="bi bi-dot text-secondary"></i>
                                                </li>
                                                <li class="list-unstyled mx-1">
                                                {{$on_order->id}}
                                                </li>
                                                <li class="list-unstyled mx-0">
                                                    <i class="bi bi-dot text-secondary"></i>
                                                </li>
                                                <li class="list-unstyled mx-1">
                                                    <span class="badge bg-warning">در حال پردازش</span>
                                                </li>
                                            </ul>
                                        </div>
    {{--									<div class="col-xxl-5 align-self-center p-1">--}}
    {{--										<a href="{{route('panel.order.details',['id'=>$on_order->id])}}"--}}
    {{--											class="d-flex align-items-center justify-content-end text-a border max-content ms-auto px-2 py-1">--}}
    {{--											مشاهده سفارش <i class="bi bi-arrow-left d-flex ms-2"></i>--}}
    {{--										</a>--}}
    {{--									</div>--}}
                                        <div class="col-sm-12 d-flex justify-content-between align-self-center text-end p-1">
                                            <a href="{{url('panel/order-detail/'.$on_order->id)}}" class="d-flex text-dark fw-bold">
                                                <i class="bi bi-eye d-flex h5 pe-2 ps-2 m-0 align-self-center"></i>
                                                <p class="m-0 align-self-center">دیدن جزئیات</p>
                                            </a>
                                            <p class="my-1 text-secondary">
                                                مبلغ کل :
                                                {{number_format($on_order->payment)}} تومان
                                            </p>
                                        </div>
                                        <div class="col-sm-12 align-self-center p-1 border-top border-bottom">
                                            <div class="row w-100 m-0">
                                                @foreach($on_order->orderItems as $item)
                                                <div class="col-xxl-2 col-xl-3 col-lg-6 col-md-12 col-sm-2 col-xs-4 p-1">
                                                   <a href="">
                                                    <figure class="p-1 shadow-sm border bg-white">
                                                        <div class="figure-inn rounded-0">
                                                            @if(file_exists('assets/uploads/content/pro/big/'.@$item->variable->image) && $item->product_variable_id != null)
                                                            <img src="{{asset('assets/uploads/content/pro/big/'.@$item->variable->image)}}" alt="{{@$item->product->title}}">
                                                        @elseif(file_exists('assets/uploads/content/pro/big/'.@$item->product->image[0]->file))
                                                            <img src="{{asset('assets/uploads/content/pro/big/'.@$item->product->image[0]->file)}}" alt="{{@$item->product->title}}">
                                                        @else
                                                            <img src="{{asset('assets/site/images/notfound.png')}}" alt="">
                                                        @endif
                                                        </div>
                                                    </figure>
                                                   </a>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
    {{--									<div class="col-xxl-12 align-self-center px-1 pt-2 pb-1">--}}
    {{--										<a href="" class="d-flex align-items-center justify-content-end text-a border max-content ms-auto px-2 py-1">--}}
    {{--											مشاهد فاکتور <i class="bi bi-arrow-left d-flex ms-2"></i>--}}
    {{--										</a>--}}
    {{--									</div>--}}
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        @else
                            <div class="col-sm-12 px-0 py-5">
                                @include('site.panel.blocks.empty-orders')
                            </div>
                        @endif

					</div>
				</div>
				<div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="2-tab">
                    <div class="row w-100 m-0">

                        @if($before_orders->count() > 0)
                            @foreach($before_orders as $before_order)
                                <div class="col-sm-12 px-0 py-1">
                                    <div class="border p-1">
                                        <div class="row w-100 m-0">
                                            <div class="col-xxl-7 align-self-center p-1">
                                                <ul class="p-0 m-0 d-flex align-items-center">
                                                    <li class="list-unstyled mx-1">
                                                        {{jdate('d F Y',@$before_order->created_at->timestamp)}}
                                                    </li>
                                                    <li class="list-unstyled mx-0">
                                                        <i class="bi bi-dot text-secondary"></i>
                                                    </li>
                                                    <li class="list-unstyled mx-1">
                                                        {{$before_order->id}}
                                                    </li>
                                                    <li class="list-unstyled mx-0">
                                                        <i class="bi bi-dot text-secondary"></i>
                                                    </li>
                                                    <li class="list-unstyled mx-1">
                                                        <span class="badge bg-warning">در انتظار پرداخت</span>
                                                    </li>
                                                </ul>
                                            </div>
{{--                                            <div class="col-xxl-5 align-self-center p-1">--}}
{{--                                                <a href="{{route('panel.order.details',['id'=>$before_order->id])}}"--}}
{{--                                                   class="d-flex align-items-center justify-content-end text-a border max-content ms-auto px-2 py-1">--}}
{{--                                                    مشاهده سفارش <i class="bi bi-arrow-left d-flex ms-2"></i>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
                                            <div class="col-sm-12 align-self-center text-end p-1">
                                                <a href="{{url('panel/order-detail/'.$before_order->id)}}" class="d-flex text-dark fw-bold">
                                                    <i class="bi bi-eye d-flex h5 pe-2 ps-2 m-0 align-self-center"></i>
                                                    <p class="m-0 align-self-center">دیدن جزئیات</p>
                                                </a>
                                                <p class="my-1 text-secondary">
                                                    مبلغ کل :
                                                    {{number_format($before_order->payment)}} تومان
                                                </p>
                                            </div>
                                            <div class="col-sm-12 align-self-center p-1 border-top border-bottom">
                                                <div class="row w-100 m-0">
                                                    @foreach($before_order->orderItems as $item4)
                                                        <div class="col-xxl-2 col-xl-3 col-lg-6 col-md-12 col-sm-2 col-xs-4 p-1">
                                                            <figure class="p-1 shadow-sm border bg-white">
                                                                <div class="figure-inn rounded-0">
                                                                    @if(file_exists('assets/uploads/content/pro/big/'.@$item4->variable->image) && $item4->product_variable_id != null)
                                                                    <img src="{{asset('assets/uploads/content/pro/big/'.@$item4->variable->image)}}" alt="{{@$item4->product->title}}">
                                                                @elseif(file_exists('assets/uploads/content/pro/big/'.@$item4->product->image[0]->file))
                                                                    <img src="{{asset('assets/uploads/content/pro/big/'.@$item4->product->image[0]->file)}}" alt="{{@$item4->product->title}}">
                                                                @else
                                                                    <img src="{{asset('assets/site/images/notfound.png')}}" alt="">
                                                                @endif
                                                                </div>
                                                            </figure>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            {{--									<div class="col-xxl-12 align-self-center px-1 pt-2 pb-1">--}}
                                            {{--										<a href="" class="d-flex align-items-center justify-content-end text-a border max-content ms-auto px-2 py-1">--}}
                                            {{--											مشاهد فاکتور <i class="bi bi-arrow-left d-flex ms-2"></i>--}}
                                            {{--										</a>--}}
                                            {{--									</div>--}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-sm-12 px-0 py-5">
                                @include('site.panel.blocks.empty-orders')
                            </div>
                        @endif

                    </div>
				</div>
				<div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="3-tab">
                    <div class="row w-100 m-0">

                        @if($sent_orders->count() > 0)
                            @foreach($sent_orders as $sent_order)
                                <div class="col-sm-12 px-0 py-1">
                                    <div class="border p-1">
                                        <div class="row w-100 m-0">
                                            <div class="col-xxl-7 align-self-center p-1">
                                                <ul class="p-0 m-0 d-flex align-items-center">
                                                    <li class="list-unstyled mx-1">
                                                        {{jdate('d F Y',@$sent_order->created_at->timestamp)}}
                                                    </li>
                                                    <li class="list-unstyled mx-0">
                                                        <i class="bi bi-dot text-secondary"></i>
                                                    </li>
                                                    <li class="list-unstyled mx-1">
                                                        {{$sent_order->id}}
                                                    </li>
                                                    <li class="list-unstyled mx-0">
                                                        <i class="bi bi-dot text-secondary"></i>
                                                    </li>
                                                    <li class="list-unstyled mx-1">
                                                        <span class="badge bg-warning">تحویل شده</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <a href="{{url('panel/order-detail/'.$sent_order->id)}}" class="d-flex text-dark fw-bold">
                                                <i class="bi bi-eye d-flex h5 pe-2 ps-2 m-0 align-self-center"></i>
                                                <p class="m-0 align-self-center">دیدن جزئیات</p>
                                            </a>
                                            <div class="col-sm-12 align-self-center text-end p-1">
                                                <p class="my-1 text-secondary">
                                                    مبلغ کل :
                                                    {{number_format($sent_order->payment)}} تومان
                                                </p>
                                            </div>
                                            <div class="col-sm-12 align-self-center p-1 border-top border-bottom">
                                                <div class="row w-100 m-0">
                                                    @foreach($sent_order->orderItems as $item2)
                                                        <div class="col-xxl-2 col-xl-3 col-lg-6 col-md-12 col-sm-2 col-xs-4 p-1">
                                                            <figure class="p-1 shadow-sm border bg-white">
                                                                <div class="figure-inn rounded-0">

                                                                    @if(file_exists('assets/uploads/content/pro/big/'.@$item2->variable->image) && $item2->product_variable_id != null)
                                                                        <img src="{{asset('assets/uploads/content/pro/big/'.@$item2->variable->image)}}" alt="{{@$item2->product->title}}">
                                                                    @elseif(file_exists('assets/uploads/content/pro/big/'.@$item2->product->image[0]->file))
                                                                        <img src="{{asset('assets/uploads/content/pro/big/'.@$item2->product->image[0]->file)}}" alt="{{@$item2->product->title}}">
                                                                    @else
                                                                        <img src="{{asset('assets/site/images/notfound.png')}}" alt="">
                                                                    @endif

                                                                </div>
                                                            </figure>
                                                            <a type="submit" href="{{URL::action('Panel\TicketController@getReturn',$item2->id)}}"  class="btn btn-danger">مرجوع</a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            {{--									<div class="col-xxl-12 align-self-center px-1 pt-2 pb-1">--}}
                                            {{--										<a href="" class="d-flex align-items-center justify-content-end text-a border max-content ms-auto px-2 py-1">--}}
                                            {{--											مشاهد فاکتور <i class="bi bi-arrow-left d-flex ms-2"></i>--}}
                                            {{--										</a>--}}
                                            {{--									</div>--}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-sm-12 px-0 py-5">
                                @include('site.panel.blocks.empty-orders')
                            </div>
                        @endif

                    </div>
				</div>
				<div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="4-tab">
                    <div class="row w-100 m-0">

                        @if($cancel_orders->count() > 0)
                            @foreach($cancel_orders as $cancel_order)
                                <div class="col-sm-12 px-0 py-1">
                                    <div class="border p-1">
                                        <div class="row w-100 m-0">
                                            <div class="col-xxl-7 align-self-center p-1">
                                                <ul class="p-0 m-0 d-flex align-items-center">
                                                    <li class="list-unstyled mx-1">
                                                        {{jdate('d F Y',@$cancel_order->created_at->timestamp)}}
                                                    </li>
                                                    <li class="list-unstyled mx-0">
                                                        <i class="bi bi-dot text-secondary"></i>
                                                    </li>
                                                    <li class="list-unstyled mx-1">
                                                        {{$cancel_order->id}}
                                                    </li>
                                                    <li class="list-unstyled mx-0">
                                                        <i class="bi bi-dot text-secondary"></i>
                                                    </li>
                                                    <li class="list-unstyled mx-1">
                                                        <span class="badge bg-  ">لغو شده</span>
                                                    </li>
                                                </ul>
                                            </div>
{{--                                            <div class="col-xxl-5 align-self-center p-1">--}}
{{--                                                <a href="{{route('panel.order.details',['id'=>$cancel_order->id])}}"--}}
{{--                                                   class="d-flex align-items-center justify-content-end text-a border max-content ms-auto px-2 py-1">--}}
{{--                                                    مشاهده سفارش <i class="bi bi-arrow-left d-flex ms-2"></i>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
                                            <a href="{{url('panel/order-detail/'.$cancel_order->id)}}" class="d-flex text-dark fw-bold">
                                                <i class="bi bi-eye d-flex h5 pe-2 ps-2 m-0 align-self-center"></i>
                                                <p class="m-0 align-self-center">دیدن جزئیات</p>
                                            </a>
                                            <div class="col-sm-12 align-self-center text-end p-1">
                                                <p class="my-1 text-secondary">
                                                    مبلغ کل :
                                                    {{number_format($cancel_order->payment)}} تومان
                                                </p>
                                            </div>
                                            <div class="col-sm-12 align-self-center p-1 border-top border-bottom">
                                                <div class="row w-100 m-0">
                                                    @foreach($cancel_order->orderItems as $item3)
                                                        <div class="col-xxl-2 col-xl-3 col-lg-6 col-md-12 col-sm-2 col-xs-4 p-1">
                                                            <figure class="p-1 shadow-sm border bg-white">
                                                                <div class="figure-inn rounded-0">
                                                                    @if(file_exists('assets/uploads/content/pro/big/'.@$item3->variable->image) && $item3->product_variable_id != null)
                                                                    <img src="{{asset('assets/uploads/content/pro/big/'.@$item3->variable->image)}}" alt="{{@$item3->product->title}}">
                                                                @elseif(file_exists('assets/uploads/content/pro/big/'.@$item3->product->image[0]->file))
                                                                    <img src="{{asset('assets/uploads/content/pro/big/'.@$item3->product->image[0]->file)}}" alt="{{@$item3->product->title}}">
                                                                @else
                                                                    <img src="{{asset('assets/site/images/notfound.png')}}" alt="">
                                                                @endif
                                                                </div>
                                                            </figure>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            {{--									<div class="col-xxl-12 align-self-center px-1 pt-2 pb-1">--}}
                                            {{--										<a href="" class="d-flex align-items-center justify-content-end text-a border max-content ms-auto px-2 py-1">--}}
                                            {{--											مشاهد فاکتور <i class="bi bi-arrow-left d-flex ms-2"></i>--}}
                                            {{--										</a>--}}
                                            {{--									</div>--}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-sm-12 px-0 py-5">
                                @include('site.panel.blocks.empty-orders')
                            </div>
                        @endif

                    </div>
				</div>
			</div>

		</div>
	</div>
</div>

@stop
