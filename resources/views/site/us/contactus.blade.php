@extends('layouts.site.master')
@section('title'){{@$setting_header->title_contact ? $setting_header->title_contact : $setting_header->title}} @stop

@section('description')
    @if($setting_header->des_contact != null)
        {!! $setting_header->des_contact !!}
    @else
        {!! $setting_header->description_seo !!}
    @endif
@stop
@section('content')
    @include('layouts.message-swal')
<main class="content">
	<div class="rules">
		<div class="bg-b-light py-3">
			<div class="container">
				<div class="row w-100 m-0">
					<div class="col-sm-12 p-1 px-xs-2">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="{{url('/')}}">
										خانه
									</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">
									تماس با ما
								</li>
							</ol>
						</nav>
					</div>
					<div class="col-sm-12 p-0">
						<div class="row w-100 m-0">
							<div class="col-md-6 p-1">
								<div class="bg-white product-details-header p-md-4 p-sm-3 p-xs-3">
									<p class="ismb h4 text-a">
										فرم ارتباط با ما
									</p>
									<hr class="my-2">
                                    <form action="{{URL::action('Site\HomeController@postContact')}}" method="POST" class="m-0">
                                        {{csrf_field()}}
                                        <input type="hidden" name="type" value="4">
										<div class="row w-100 m-0">
											<div class="col-xxl-12 p-1">
												<div class="form-floating">
													<input type="text" class="form-control" required oninvalid="swal('ارور',' کاربرگرامی نام و نام خانوادگی الزامیست','error')" name="name"
														id="floatingInput"
														placeholder="نام و  نام خانوادگی">
													<label for="floatingInput">نام و نام خانوادگی</label>
												</div>
											</div>
											<div class="col-xxl-12 p-1">
												<div class="form-floating">
													<input type="text" class="form-control" name="subject"
														id="floatingInput" placeholder="عنوان پیام">
													<label for="floatingInput">عنوان پیام</label>
												</div>
											</div>
											<div class="col-xxl-12 p-1">
												<div class="form-floating">
													<input type="text" required oninvalid="swal('ارور',' کاربرگرامی شماره همراه الزامیست','error')" class="form-control" name="phone"
														id="floatingInput" placeholder="شماره همراه">
													<label for="floatingInput">شماره همراه</label>
												</div>
											</div>
											<div class="col-xxl-12 p-1">
												<div class="form-floating">
													<textarea class="form-control" placeholder="متن پیام" name="message"
														id="floatingTextarea2"
														style="height: 100px"></textarea>
													<label for="floatingTextarea2">متن پیام</label>
												</div>
											</div>
											<div class="col-xxl-6 ms-auto p-1">
												<button type="submit"
													class="btn btn-success btn-lg rounded-custom w-100">
													ارسال پیام
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-md-6 p-1">
								<div class="bg-white product-details-header p-md-4 p-sm-3 p-xs-3 h-100">
									<p class="ismb h4 text-a">
										راه های ارتباط با ما
									</p>
									<hr class="my-2">
									<ul class="p-0 m-0">
										<li class="list-unstyled py-1">
											<a href="{{url('/')}}" class="text-secondary d-flex">
												<i class="bi bi-geo-alt text-a h4 my-0 me-2"></i>
												{{@$setting_header->address}}
											</a>
										</li>
										<li class="list-unstyled py-1">
											<a href="tel:{{@$setting_header->contact}}"
												class="text-secondary d-flex">
												<i class="bi bi-telephone text-a h4 my-0 me-2"></i>
												{{@$setting_header->contact}}
											</a>
										</li>
										<li class="list-unstyled py-1">
											<a href="mailto:{{@$setting_header->email}}"
												class="text-secondary d-flex">
												<i class="bi bi-envelope text-a h4 my-0 me-2"></i>
												{{@$setting_header->email}}
											</a>
										</li>
										<li class="list-unstyled py-1">
											<a href="tel:{{@$setting_header->phone}}"
												class="text-secondary d-flex">
												<i class="bi bi-headset text-a h4 my-0 me-2"></i>
												{{@$setting_header->phone}}
											</a>
										</li>
										<li class="list-unstyled py-1">
											<ul class="p-0 m-0">
                                                @foreach($socials as $social)
                                                @if($social->icon == 'sorosh')
                                                	<li class="list-unstyled icon-iran">
			                                    <a href="" class="bg-white d-flex mx-1 p-2 rounded-3 " target='_blank'>
			                                        <img class="w-100" src="{{asset('assets/site/images/icon-sorosh.png')}}" alt="">
			                                    </a>
			                                </li>
                                                @elseif($social->icon == 'ita')
		                                         <li class="list-unstyled icon-iran">
			                                    <a href="" class="bg-white d-flex mx-1 p-2 rounded-3 " target='_blank'>
			                                        <img class="w-100" src="{{asset('assets/site/images/icon-ita.png')}}" alt="">
			                                    </a>
			                                </li>
                                                @elseif($social->icon == 'bale')
                                                    	<li class="list-unstyled icon-iran">
			                                    <a href="" class="bg-white d-flex mx-1 p-2 rounded-3 " target='_blank'>
			                                        <img class="w-100" src="{{asset('assets/site/images/icon-bale.png')}}" alt="">
			                                    </a>
			                                </li>
                                                @elseif($social->icon == 'robika')
                                                  	<li class="list-unstyled icon-iran">
			                                    <a href="" class="bg-white d-flex mx-1 p-2 rounded-3 " target='_blank'>
			                                        <img class="w-100" src="{{asset('assets/site/images/icon-robika.png')}}" alt="">
			                                    </a>
			                                </li>
                                                @else
							<li class="list-unstyled icon">
								<a href="{{$social->address}}" class="bg-white d-flex mx-1 p-2 rounded-3 {{$social->name}}">
									<i class="d-flex bi bi-{{$social->icon}}"></i>
								</a>
							</li>
						@endif
                                                @endforeach
				
                              
                            
                              
											</ul>
										</li>
									</ul>
								</div>
							</div>
							@if(@$setting_header->maps != null )
							<div class="col-sm-12 p-1">
								<div class="bg-white product-details-header p-3">
									{!! @$setting_header->maps !!}
								</div>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

@stop
