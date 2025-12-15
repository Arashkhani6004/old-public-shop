@extends('layouts.site.master')
@section('content')
    @include('layouts.message-swal')
<main class="content bg-b-light">
	<div class="container py-3">
		<div class="bg-white rounded-custom px-sm-5 px-xs-2 pt-lg-0 pt-sm-4 pt-xs-4">
			<div class="row w-100 m-0">
				<div class="col-xl-7 col-md-6 d-md-block d-sm-none d-xs-none align-self-center p-1">
					@include('site.auth.lottie-player')
				</div>
				<div class="col-xl-5 col-md-6 align-self-center p-1">
                    <form class="mb-0" method="POST" action="{{URL::action('Panel\LoginController@postPassword')}}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input name="product_id" value="{{$product_id}}" type="hidden" />

                        @if(isset($order))
                            <input name="order" value="1" type="hidden" />
                        @endif
						<div class="card border-0 rounded-custom p-2">
							<div class="row w-100 m-0">
								<div class="col-xxl-12 text-center p-1">
									<p class="ismb h2 text-a">
										وارد شوید
									</p>
								</div>
								<div class="col-sm-12 p-1">
									<div class="form-floating">
										<input type="text" class="form-control" name="mobile" id="floatingInput" placeholder="شماره همراه یا ایمیل خود را وارد کنید">
										<label for="floatingInput">شماره همراه یا ایمیل خود را وارد کنید</label>
									</div>
								</div>
								<div class="col-sm-12 p-1">
									<button type="submit" class="btn btn-success rounded-custom w-100">
										وارد شوید
									</button>
								</div>
								<div class="col-sm-12 text-center p-1">
									<p class="py-2 text-secondary rounded-custom w-100">
										اگر قبلا ثبت نام نکرده اید، <a href="{{ url('/panel/register') }}" class="text-a fw-bolder">ثبت نام</a> کنید
									</p>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="col-xl-7 col-md-6 d-md-none d-sm-block d-xs-block align-self-center p-1">
					@include('site.auth.lottie-player')
				</div>
			</div>
		</div>
	</div>
</main>

@stop
