@extends('site.panel.master')
@section('content')

<div class="card rounded-custom p-3 border-0 h-100">
	<div class="row w-100 m-0">
		<div class="col-sm-12 p-1">
			<p class="ismb h5 m-0 d-flex align-items-center justify-content-between">
				ویرایش اطلاعات کاربری
				<i class="bi bi-pencil-square text-a h4 my-0 me-2 d-flex"></i>
			</p>
			<hr class="hr-panel">
		</div>
		<div class="col-sm-12 p-1">
			<div class="row w-100 m-0">
				<div class="col-xxl-7 col-xl-8 col-md-12 col-sm-8 col-xs-12 mx-auto p-0">
					<form class="m-0"method="post" action="{{URL::action('Panel\PanelController@postEditInfo')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
						<div class="row w-100 m-0">
							<div class="col-sm-12 px-0 py-2">
								<div class="upload-pn">
									@include('site.panel.blocks.uploader')
								</div>
							</div>
							<div class="col-sm-12 p-1">
								<div class="form-floating">
									<input type="text" class="form-control" id="nameInput" name="name" value="@if(isset($user->name)){{$user->name}}@endif"
										placeholder="نام و نام خانوادگی">
									<label for="nameInput">
										نام و نام خانوادگی
									</label>
								</div>
							</div>
							<div class="col-sm-12 p-1">
								<div class="form-floating">
									<input type="tel" class="form-control" id="telInput" name="mobile"
										placeholder="شماره همراه" value="@if(isset($user->mobile)){{$user->mobile}}@endif">
									<label for="telInput">
										شماره همراه
									</label>
								</div>
							</div>
							<div class="col-sm-12 p-1">
								<div class="form-floating">
									<input type="email" class="form-control" id="telInput" placeholder="ایمیل" name="email" value="@if(isset($user->email)){{$user->email}}@endif">
									<label for="telInput">
										ایمیل
									</label>
								</div>
							</div>
{{--							<div class="col-sm-12 p-1">--}}
{{--								<div class="form-floating">--}}
{{--									<input type="snumber" class="form-control" id="telInput"--}}
{{--										placeholder="کد پستی">--}}
{{--									<label for="telInput">--}}
{{--										کد پستی--}}
{{--									</label>--}}
{{--								</div>--}}
{{--							</div>--}}
{{--							<div class="col-sm-12 p-1">--}}
{{--								<div class="form-floating">--}}
{{--									<input type="number" class="form-control" id="telInput"--}}
{{--										placeholder="کد ملی">--}}
{{--									<label for="telInput">--}}
{{--										کد ملی--}}
{{--									</label>--}}
{{--								</div>--}}
{{--							</div>--}}
							<div class="col-sm-12 p-1">
								<button type="submit" class="btn btn-success rounded-custom w-100">
									ثبت اطلاعات
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
@section('js')
    <script>
        $(document).ready(function () {
            var readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $(".file-upload").on('change', function () {
                readURL(this);
            });
            $(".upload-button").on('click', function () {
                $(".file-upload").click();
            });
        });

    </script>
@endsection
