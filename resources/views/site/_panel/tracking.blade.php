@extends('site.panel.master')
@section('content')
@include('layouts.message-swal')
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
				<div class="col-xxl-7 col-xl-8 col-md-12 col-sm-8 col-xs-12 mx-auto p-0">
                    <form class="m-0" method="GET"
                          action="{{URL::action('Panel\PanelController@track')}}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
						<div class="row w-100 m-0">
							<div class="col-sm-12 p-1">
								<div class="form-floating">
									<input type="text" class="form-control" id="nameInput" name="id" placeholder="کد پیگیری سفارش خود را وارد کنید">
									<label for="nameInput">
										کد پیگیری سفارش خود را وارد کنید
									</label>
								</div>
							</div>
							<div class="col-sm-12 p-1">
								<button type="submit" class="btn btn-success rounded-custom w-100">
									جستجو
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
