@extends('site.panel.master')
@section('content')

<div class="card rounded-custom p-3 border-0 h-100">
	<div class="row w-100 m-0">
		<div class="col-sm-12 p-1">
			<p class="ismb h5 m-0 d-flex align-items-center justify-content-between">
				بازیابی رمز عبور
				<i class="bi bi-key text-a h4 my-0 me-2 d-flex"></i>
			</p>
			<hr class="hr-panel">
		</div>
		<div class="col-sm-12 p-1">
			<div class="row w-100 m-0">
				<div class="col-xxl-7 col-xl-8 col-md-12 col-sm-8 col-xs-12 mx-auto p-0">
					<form action="" class="m-0">
						<div class="row w-100 m-0">
							<div class="col-sm-12 p-1">
								<div class="form-floating">
									<input type="password" class="form-control" id="nameInput" placeholder="رمز عبور فعلی را وارد کنید">
									<label for="nameInput">
										رمز عبور فعلی را وارد کنید
									</label>
								</div>
							</div>
							<div class="col-sm-12 p-1">
								<div class="form-floating">
									<input type="password" class="form-control" id="nameInput" placeholder="رمز عبور جدید را وارد کنید">
									<label for="nameInput">
										رمز عبور جدید را وارد کنید
									</label>
								</div>
							</div>
							<div class="col-sm-12 p-1">
								<div class="form-floating">
									<input type="password" class="form-control" id="nameInput" placeholder="تکرار رمز عبور جدید">
									<label for="telInput">
										تکرار عبور رمز جدید
									</label>
								</div>
							</div>
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