@extends('layouts.site.master')
@section('content')
    @include('layouts.message-swal')
<main class="content bg-b-light conf">
	<div class="container py-3">
		<div class="bg-white rounded-custom px-sm-5 px-xs-2 pt-lg-0 pt-sm-4 pt-xs-4">
			<div class="row w-100 m-0">
				<div class="col-xl-7 col-md-6 d-md-block d-sm-none d-xs-none align-self-center p-1">
					@include('site.auth.lottie-player')
				</div>
				<div class="col-xl-5 col-md-6 align-self-center p-1">
                    <form class="mb-0" method="post" action="{{URL::action('Panel\LoginController@postPanelLogin')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input name="product_id" value="{{$product_id}}" type="hidden" />

                        @if(isset($order))
                            <input name="order" value="1" type="hidden" />
                        @endif
                        <input type="hidden" name="mobile" value="{{$user->mobile}}"/>
						<div class="card border-0 rounded-custom p-2">
							<div class="row w-100 m-0">
								<div class="col-xxl-12 text-center p-1">
									<p class="ismb h2 text-a">
						ورود
									</p>
								</div>
								<div class="col-sm-12 p-1">
									<div class="form-floating">
										<input type="password" name="temp_password" class="form-control text-center" value="" id="number" placeholder="کدی که برای شما ارسال کرده ایم را وارد کنید">
										<label for="number">کدی که برای شما ارسال کرده ایم را وارد کنید</label>
									</div>
								</div>
								<div class="col-sm-6 col-xs-6 align-self-center text-start px-1 py-2">
									<label for="showPass">
										<input type="checkbox" id="showPass" onclick="myFunction()">
										نمایش رمز
									</label>
								</div>

								<div class="col-sm-12 p-1">
									<button type="submit" class="btn btn-success rounded-custom w-100">
										وارد شوید
									</button>
								</div>

{{--								<div class="col-sm-12 text-center p-1">--}}
{{--									<p class="py-2 text-secondary rounded-custom w-100">--}}
{{--										اگر قبلا ثبت نام نکرده اید، <a href="" class="text-a fw-bolder">ثبت نام</a> کنید--}}
{{--									</p>--}}
{{--								</div>--}}
							</div>
						</div>
					</form>
                    <form class="mb-0" method="post" action="{{URL::action('Panel\LoginController@postRePassword',[$user->mobile])}}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="mobile" value="{{$user->mobile}}">
                        <div class="col-sm-12 text-center px-1 py-2">
                            <button type="submit"  class="btn btn-outline-success rounded-custom w-100">
                                ارسال مجدد رمز عبور
                            </button>
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
