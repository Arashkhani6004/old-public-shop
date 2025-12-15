<p class="h5 ismb d-flex align-items-center">
	<i class="bi bi-caret-left-fill text-a me-2"></i>
	سوالات کاربران
</p>
<div class="comments">
	<div class="row w-100 m-0">
		<div class="col-xl-4 col-lg-5 col-md-6 p-1">
			<div class="bg-l p-3 rounded-custom">
				<form method="post" action="{{URL::action('Site\HomeController@postFaq')}}"
					enctype="multipart/form-data" class="m-0">
					{{ csrf_field() }}
					<input type="hidden" name="product_id" value="{{$product->id}}">
					<div class="row m-0 w-100">
						<div class="col-md-12 p-1">
							<p class="ismb text-b m-0">
								فرم ارسال سوال
							</p>
						</div>
						<div class="col-md-12 p-1">
							<div class="form-floating">
								<input type="text" class="form-control border-0" id="input1"
									placeholder="عنوان سوال شما">
								<label for="input1">
									عنوان سوال شما
								</label>
							</div>
						</div>
						<div class="col-md-12 p-1">
							<div class="form-floating">
								<textarea class="form-control border-0" placeholder="متن سوال شما"
									name="question" id="textarea1" style="height: 7.5rem"></textarea>
								<label for="textarea1">
									متن سوال شما
								</label>
							</div>
						</div>
						<div class="col-xxl-6 ms-auto p-1">
							<button type="submit"
								class="btn btn-success rounded-custom w-100 d-flex align-items-center justify-content-center">
								<i class="bi bi-check2-circle d-flex me-2 h5 my-0"></i>
								ثبت سوال
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-xl-8 col-lg-7 col-md-6 p-1">
			@if(count($questions) > 0)
			<div class="bg-l p-3 rounded-custom">
				<div class="row m-0 w-100">
					<div class="col-md-12 p-1">
						<p class="ismb mb-1">
							سوالات کاربران در مورد این محصول
						</p>
					</div>
					<div class="col-md-12 p-0">
						<div class="accordion" id="accordionFaq">
							@foreach($questions as $key => $row)
							<div class="accordion-item">
								<p class="accordion-header h2" id="heading{{$row->id}}">
									<button class="accordion-button" type="button" data-bs-toggle="collapse"
										data-bs-target="#collapse{{$row->id}}" aria-expanded="true"
										aria-controls="collapse{{$row->id}}">
										<div class="">
											{{--											<p class="fw-bolder h5 mb-2">--}}
											{{--												1 - عنوان سوال شماره یک--}}
											{{--											</p>--}}
											<p class="h6 mb-0 mt-2">
												{!! @$row->question !!}
											</p>
										</div>
									</button>
								</p>
								<div id="collapse{{$row->id}}"
									class="accordion-collapse collapse @if($key == 0) show @endif"
									aria-labelledby="heading{{$row->id}}" data-bs-parent="#accordionFaq">
									<div class="accordion-body text-justify text-secondary">
										{!! @$row->answer !!}
									</div>
								</div>
							</div>
							@endforeach

						</div>
					</div>
				</div>
			</div>
			@else
			<div class="my-5">
				<lottie-player src="https://assets2.lottiefiles.com/packages/lf20_cf2kl3pu.json"
					background="transparent" speed="1" class="w-50 h-auto mx-auto" loop autoplay></lottie-player>
			</div>
			@endif
		</div>
	</div>
</div>