@extends('layouts.site.master')
@section('title'){{@$blog->title_seo ? $blog->title_seo : $blog->title}} @stop
@section('image_seo'){{ @$blog->image ? asset('assets/uploads/content/page/big/'.$blog->image) : asset('assets/uploads/content/set/'.@$setting->logo)}}
@endsection
@section('og_type', 'article')	


@section('description')
@if($blog->description_seo != null)
{!! $blog->description_seo !!}
@else
{!! strip_tags(\Illuminate\Support\Str::limit($blog->description,100)) !!}
@endif
@stop
@section('content')

<main class="content">
	<div class="blog-det">
		<div class="bg-b-light py-3">
			<div class="container">
				<div class="row w-100 m-0">
					<div class="col-sm-12 p-1 px-xs-2">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="/">
										خانه
									</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">
									{{@$blog->title}}
								</li>
							</ol>
						</nav>
					</div>
					<div class="col-sm-12 p-0">
						<div class="row w-100 m-0 st">
							<div class="col-lg-3 d-lg-block d-sm-none d-xs-none p-0">
								<div class="position-sticky sticky">
									<div class="row w-100 m-0">

										<div class="col-sm-12 p-1">
											<div class="card border-0 rounded-custom p-2">
												<p class="ismb h4 mb-0 mt-1 px-1 text-center">
													مطالب مرتبط
												</p>
											</div>
										</div>
										@if($blogs->count() > 0)
										@foreach($blogs as $relate)
										<div class="col-lg-12 col-sm-6 col-xs-12 p-1">
											<a href="{{route('site.page.detail',['id'=>@$relate->url])}}">
												<div class="card border-0 rounded-custom p-2">
													<div class="row w-100 m-0">
														<div
															class="col-sm-3 col-xs-3 p-1 align-self-center">
															<img src="{{asset('assets/uploads/content/page/medium/'.@$relate->image)}}"
																alt="{{@$relate->title}}"
																class="w-100 m-0">
														</div>
														<div
															class="col-sm-9 col-xs-9 p-1 align-self-center">
															<p class="text-b my-1 h5 fw-bolder">
																{{@$relate->title}}
															</p>
															<p class="text-secondary my-1 h6">
																{{jdate('d F Y',@$relate->updated_at->timestamp)}}
															</p>
														</div>
													</div>
												</div>
											</a>
										</div>
										@endforeach
										@else
										<div class="col-sm-12 p-1">
											<div class="card border-0 rounded-custom p-2">
												<div class="my-5">
													<lottie-player
														src="https://assets3.lottiefiles.com/private_files/lf30_sxji3ajq.json"
														background="transparent" speed="1"
														class="w-50 h-auto mx-auto" loop autoplay>
													</lottie-player>
												</div>
											</div>
										</div>
										@endif
									</div>
								</div>
							</div>
							<div class="col-lg-9 p-0">
								<div class="col-xxl-12 p-1">
									<div class="card border-0 rounded-custom p-2">
										<h1 class="ismb text-a mt-3 mb-1 text-center">
											{{@$blog->title}}
										</h1>
										<hr class="my-2">
										<div
											class="col-xxl-9 col-xl-10 col-lg-11 col-md-9 col-sm-10 p-0 mx-auto">
											<img src="{{asset('assets/uploads/content/page/big/'.@$blog->image)}}"
												alt="{{@$blog->title}}" class="w-100 mx-auto">
										</div>
										<hr class="my-2">
										<div class="row w-100 m-0">

											<div class="col-sm-12 p-2">
												<div class="text-justify text-secondary description">
													<p>
														{!! @$blog->description !!}
													</p>

												</div>
											</div>
										</div>

										<hr class="my-2">

									</div>
								</div>

							</div>
							<div class="col-lg-3 d-lg-none d-sm-block d-xs-block p-0">
								<div class="position-sticky sticky">
									<div class="row w-100 m-0">
										<div class="col-sm-12 p-1">
											@if($blogs->count() > 0)
											<div class="card border-0 rounded-custom p-2">
												<p class="ismb h4 mb-0 mt-1 px-1 text-center">
													مطالب مرتبط
												</p>
											</div>
											@endif
										</div>
										@foreach($blogs as $relate)
										<div class="col-lg-12 col-sm-6 col-xs-12 p-1">
											<a href="{{route('site.page.detail',['id'=>@$relate->url])}}">
												<div class="card border-0 rounded-custom p-2">
													<div class="row w-100 m-0">
														<div
															class="col-sm-3 col-xs-3 p-1 align-self-center">
															<img src="{{asset('assets/uploads/content/page/medium/'.@$relate->image)}}"
																alt="" class="w-100 m-0">
														</div>
														<div
															class="col-sm-9 col-xs-9 p-1 align-self-center">
															<p class="text-b my-1 h5 fw-bolder">
																{{@$relate->title}}
															</p>
															<p class="text-secondary my-1 h6">
																{{jdate('d F Y',@$relate->updated_at->timestamp)}}
															</p>
														</div>
													</div>
												</div>
											</a>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

@stop
