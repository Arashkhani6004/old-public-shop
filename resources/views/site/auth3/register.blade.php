@extends('layouts.site.master')
@section('content')

<main class="content bg-b-light">
	<div class="container py-3">
		<div class="bg-white rounded-custom px-sm-5 px-xs-2 pt-lg-0 pt-sm-4 pt-xs-4">
			<div class="row w-100 m-0">
				<div class="col-xl-7 col-md-6 d-md-block d-sm-none d-xs-none align-self-center p-1">
					@include('site.auth.lottie-player')
				</div>
				<div class="col-xl-5 col-md-6 align-self-center p-1">
					<form class="mb-0" method="post" action="{{ route('register') }}" enctype="multipart/form-data">
						{{ csrf_field() }}

						<input name="product_id" value="{{$product_id}}" type="hidden" />

						@if(isset($order))
						<input name="order" value="1" type="hidden" />
						@endif
						<div class="card border-0 rounded-custom p-2">
							<div class="row w-100 m-0">
								<div class="col-xxl-12 text-center p-1">
									<p class="ismb h2 text-a">
										ثبت نام کنید
									</p>
								</div>
								<div class="col-xxl-6 p-1">
									<div class="form-floating">
										<input type="text" class="form-control" id="floatingInput" name="name" placeholder="نام و نام خانوادگی">
										<label for="floatingInput">
											نام و نام خانوادگی
										</label>
									</div>
								</div>
								<div class="col-xxl-6 p-1">
									<div class="form-floating">
										<select class="form-select" id="floatingSelect" aria-label="Float[ing label select example" name="gender">
											<option value="" selected disabled>انتخاب کنید</option>
											@foreach($gender as $key=>$item)
											<option value="{{$key}}">{{$item}}</option>
											@endforeach
										</select>
										<label for="floatingSelect">جنسیت</label>
									</div>
								</div>
								<div class="col-xxl-6 p-1">
									<div class="form-floating">
										<input type="tel" name="mobile"  class="form-control" id="floatingInput" placeholder="شماره همراه">
										<label for="floatingInput">
											شماره همراه
										</label>
									</div>
								</div>
								<div class="col-xxl-6 p-1">
									<div class="form-floating">
										<input type="email" name="email" class="form-control" id="floatingInput" placeholder="ایمیل">
										<label for="floatingInput">
											ایمیل
										</label>
									</div>
								</div>


								<div class="col-xxl-6 p-1">
									<div class="form-floating captchaImage">
                                        {!! \Mews\Captcha\Facades\Captcha::img() !!}
									</div>
								</div>
								<div class="col-xxl-6 p-1">
									<div class="form-floating">
										<input type="text" name="captcha" class="form-control" id="captcha-input" placeholder="کد امنیتی">
										<label for="captcha-input">کد امنیتی</label>
										<div id="captcha-error" class="invalid-feedback"></div>
									</div>
								</div>
								<div class="col-sm-12 p-1">
									<button type="submit" class="btn btn-success rounded-custom w-100">
										ثبت نام کنید
									</button>
								</div>
								<div class="col-sm-12 text-center p-1">
									<p class="py-2 text-secondary rounded-custom w-100">
										اگر قبلا ثبت نام کرده اید، <a href="{{ route('panel.log') }}" class="text-a fw-bolder">وارد</a>
										شوید
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

@section('js')
<script>
    $(document).ready(function() {
        var typingTimer;
        var doneTypingInterval = 5000;

        $('#captcha-input').on('keyup', function() {
            clearTimeout(typingTimer);
            if ($('#captcha-input').val()) {
                typingTimer = setTimeout(checkCaptcha, doneTypingInterval);
            }
        });

        function checkCaptcha() {
            var captcha = $('#captcha-input').val();
            $.ajax({
                type: 'POST',
                url: '/check-captcha',
                data: {
                    captcha: captcha,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr) {
                    new swal("خطا", "کد امنیتی بدرستی وارد نشده", "error");
                }
            });
        }
    });
</script>



<script>
	function chakeNumber(id) {
		const numberpattern = /^[0-9+۰-۹]+$/;
		let el = document.getElementById(id)
		if (!numberpattern.test(el.value.trim())) {
			new swal("خطا", "لطفا شماره همراه را به عدد وارد کنید", "error");
			el.value = "";
			return false;
		}
	}
</script>
@stop
