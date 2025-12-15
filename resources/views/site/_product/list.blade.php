@extends('layouts._site.master')
@section('title'){{@$category->title_seo ? $category->title_seo : $category->title}} @stop
@section('image_seo'){{ @$category->cover ? $category->cat_image : asset('assets/uploads/content/set/'.@$setting_header->logo)}}
@endsection
@section('canonical'){{$category->keyword ? $category->keyword : trim(url()->current())}}@stop

@section('description')
@if($category->description_seo != null)
{!! $category->description_seo !!}
@else
{!! strip_tags(\Illuminate\Support\Str::limit($category->description,100)) !!}
@endif
@stop
@section('content')

<main class="content">
	<div class="product pro-list">
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
								@if(@$category->parent->parent)
								<li class="breadcrumb-item">
									<a
										href="{{route('site.product.list',['id'=>$category->parent->parent->url])}}">
										{{@$category->parent->parent->title}}
									</a>
								</li>
								@endif
								@if($category->parent)
								<li class="breadcrumb-item">
									<a href="{{route('site.product.list',['id'=>$category->parent->url])}}">
										{{@$category->parent->title}}
									</a>
								</li>
								@endif
								<li class="breadcrumb-item active" aria-current="page">
									{{@$category->title}}
								</li>
							</ol>
						</nav>
					</div>
					
						<div class="col-sm-12 p-1 px-xs-2">
							<div class="card rounded-custom border-0 p-md-4 p-3">
								<h1 class="ismb text-a m-0">
									{{@$category->title2 ? $category->title2: $category->title}}
								</h1>
								@if($setting_header->description_type == 1)
								@if($category->description !== null)
									<div class="description text-secondary text-justify">
										{!! @$category->description !!}
									</div>
								@endif
								@endif
							</div>
						</div>
						@if($category->mega != null)
						@if($category->mega_url != null)
							<a href="{{@$category->mega_url}}" class=" d-block d-md-none">
								<img src="{{@$category->CatMega}}" class="w-100 my-2" style="border-radius: 2rem;">
							</a>
						@else
							<img src="{{@$category->CatMega}}" class="w-100 my-2 d-block d-md-none" style="border-radius: 2rem;">
						@endif
						@endif
					
					<div class="col-sm-12 p-0">
						<div class="row w-100 m-0">
							<!-- start mobile -->
							<div class="col-sm-6 col-xs-6 px-2 py-1 d-md-none d-sm-block d-xs-block">
								@include('site.product.blocks.mobile.filtermodal')
							</div>
							<div class="col-sm-6 col-xs-6 px-2 py-1 d-md-none d-sm-block d-xs-block">
								@include('site.product.blocks.mobile.viewbymodal')
							</div>
							<!-- end mobile -->
							<div class="col-xl-3 col-md-4 col-sm-5 p-1 d-md-block d-sm-none d-xs-none">
								<div class="sticky d-md-block d-sm-none d-xs-none">
									@include('site.product.blocks.sidebar')
								</div>
							</div>
							<div class="col-xl-9 col-md-8 col-sm-12 p-0">
								<div class="row w-100 m-0">
									<div class="col-sm-12 d-md-block d-sm-none d-xs-none p-1">
										<div class="card rounded-custom border-0 p-md-2 p-sm-2 p-xs-1 d-flex">
											<ul class="p-0 m-0">
												<li class="d-inline float-start me-2 py-lg-0 py-sm-1">
													<div
														class="d-flex align-items-center border rounded-custom">
														@include('site.product.blocks.viewby')
													</div>
												</li>
												<li class="d-inline float-start me-2 py-lg-0 py-sm-1">
													<div
														class="d-flex align-items-center border rounded-custom">
														@include('site.product.blocks.available')
													</div>
												</li>
											</ul>
										</div>
									</div>

									<div class="col-sm-12 p-1">
										<div class="card rounded-custom border-0 p-md-3 p-sm-2 m-xs-1 pro">
											<div class="row w-100 m-0" id="rowBox">
												<template v-if="loading2 === true">
													<div class="col-sm-12 p-1">
														<div class="p-md-0 p-sm-1 p-xs-1">
															@include('site.product.blocks.loading')
														</div>
													</div>
												</template>
												<template v-else>
													<div class="col-xl-3 col-md-4 col-sm-4 col-xs-6 p-1"
														v-for="(product , index) in products">
														@include('layouts._site.blocks.content.pro-box')
													</div>
												</template>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@if($setting_header->description_type == 2)
						<div class="card rounded-custom border-0 p-md-4 p-sm-3 p-xs-1">
							@if($category->description !== null)
								<div class="description text-secondary text-justify">
									{!! @$category->description !!}
								</div>
							@endif
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</main>

@stop
