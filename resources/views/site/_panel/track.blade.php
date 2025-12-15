@extends('site.panel.master')
@section('content')

<div class="card rounded-custom p-3 border-0 h-100">
	<div class="row w-100 m-0">
		<div class="col-sm-12 p-1">
			<p class="ismb h5 m-0 d-flex align-items-center justify-content-between">
				پیگیری سفارش
				<i class="bi bi-box-seam text-a h4 my-0 me-2 d-flex"></i>
			</p>
			<hr class="hr-panel">
		</div>
		<div class="col-sm-12 p-1">
			<div class="row w-100 m-0">
				<div class="col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 mx-auto p-0">
					<div class="card p-2 mb-3">
				    <div class="card-header bg-white d-flex justify-content-between">
				        <p class=" m-0">
				           {{jdate('d F Y',@$order->updated_at->timestamp)}}<span></span>
				        </p>

				    </div>
                        @if(@$order->order_status_id == 4)
				    <div class="card-body p-2">
				        <div class="progress m-0">

                          <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated rounded-3" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="text-warning fw-bolder p-1">
                   {{@$order->orderstatus->title}}
                        </span>
				    </div>
                        @endif
                        @if(@$order->order_status_id == 5)
                            <div class="card-body p-2">
                                <div class="progress m-0">
                                    <div class="progress-bar progress-bar-striped bg-success progress-bar-animated rounded-3" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="text-success fw-bolder p-1">
                              {{@$order->orderstatus->title}}
                        </span>
                            </div>
                        @endif

                        @if(@$order->order_status_id == 3)
                            <div class="card-body p-2">
                                <div class="progress m-0">
                                    <div class="progress-bar progress-bar-striped bg-info progress-bar-animated rounded-3" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="text-info fw-bolder p-1">
                              {{@$order->orderstatus->title}}
                        </span>
                            </div>
                        @endif
                        @if(@$order->order_status_id == 2)
                            <div class="card-body p-2">
                                <div class="progress m-0">
                                    <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated rounded-3" role="progressbar" style="width: 25%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="text-danger fw-bolder p-1">
                     {{@$order->orderstatus->title}}
                        </span>
                            </div>
                        @endif

				</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
