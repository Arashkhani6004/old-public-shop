@extends('site.panel.master')
@section('content')

<div class="card rounded-custom p-3 border-0 h-100">
	<div class="row w-100 m-0">
		<div class="col-sm-12 p-1">
			<p class="ismb h5 m-0 d-flex align-items-center justify-content-between">
				داشبورد
				<i class="bi bi-speedometer2 text-a h4 my-0 me-2 d-flex"></i>
			</p>
			<hr class="hr-panel">
		</div>
		<!-- @include('site.panel.blocks.empty-dashboard') -->
		<div class="col-sm-12 p-1">
			<div class="row w-100 m-0">
				<div class="col-sm-12 p-1 border border-bottom-0">
					<p class="m-0 px-1 ismb py-2">
						اطلاعات کاربری
					</p>
				</div>
				<div class="col-xxl-6 col-md-12 col-sm-6 p-1 border">
					<p class="m-0 px-1 py-2 d-flex align-items-center justify-content-between">
						نام و نام خانوادگی :
						<span>
						{{@$user->name}}
						</span>
					</p>
				</div>
				<div class="col-xxl-6 col-md-12 col-sm-6 p-1 border">
					<p class="m-0 px-1 py-2 d-flex align-items-center justify-content-between">
						شماره همراه :
						<span>
							{{@$user->mobile}}
						</span>
					</p>
				</div>
				<div class="col-xxl-6 col-md-12 col-sm-6 p-1 border">
					<p class="m-0 px-1 py-2 d-flex align-items-center justify-content-between">
						ایمیل :
						<span>
							{{@$user->email}}
						</span>
					</p>
				</div>

				<div class="col-xxl-6 col-md-12 col-sm-6 p-1 border">
					<p class="m-0 px-1 py-2 d-flex align-items-center justify-content-center">
						<a href="{{route('panel.edit')}}" class="text-a d-flex align-items-center">
							<i class="bi bi-pencil-square d-flex me-2"></i>
							ویرایش اطلاعات
						</a>
					</p>
				</div>
			</div>
		</div>
		@if(count($discounts) > 0)
		     <div class="col-sm-12 p-1">
            <div class="row w-100 m-0">
                <div class="col-sm-12 p-1 border border-bottom-0">
                    <p class="m-0 px-1 ismb py-2">
                        کد تخفیف
                    </p>
                </div>
                @foreach($discounts as $discount)
                <div class="col-sm-12 p-1 border ">
                    <p class="m-0 px-1 ismb py-2">
                        {{$discount->code}}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
        @endif
	</div>
</div>

@stop
