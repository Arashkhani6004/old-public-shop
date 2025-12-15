@extends('layouts.site.master')
@section('title'){{@$setting_header->title_offers ? $setting_header->title_offers : $setting_header->title}} @stop

@section('description')
    @if($setting_header->des_offers != null)
        {!! $setting_header->des_offers !!}
    @else
        {!! $setting_header->description_seo !!}
    @endif
@stop

@section('content')
<main class="content">
	<div class="">
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
									تخفیفات ویژه
								</li>
							</ol>
						</nav>s
					</div>
					<div class="col-sm-12 p-1 px-xs-2">
						<div class="bg-white product-details-header p-3">
							<p class="h2 m-0 ismb text-a border-bottom">
                                تخفیفات ویژه
							</p>
						</div>
					</div>
					@if($timer_products->count() > 0)
					<div class="col-sm-12 p-1 px-xs-2 pro pro-det">
						<div class="bg-white product-details-header p-3">

							<div class="row w-100 m-0">
								@foreach($timer_products as $row)
								<div class="col-xxl-2 col-lg-3 col-sm-4 col-xs-6 p-1">
									<a href="{{route('site.product.detail',['id'=>$row->url])}}">
										<div class="card border px-1 py-4">
											@if($row->calcute > 0)
											<div
												class="disc text-white d-flex align-items-center justify-content-center">
												{{round(@$row->calcute)}}%
											</div>
											@endif
											<figure>
												<div class="figure-inn">
													<img src="{{@$row->pro_image}}" alt="{{@$row->title}}">
												</div>
											</figure>
											<p class="h6 mb-0 text-secondary">
												{{@$row->title}}
											</p>
											<div class="row w-100 m-0">
												<div class="col-sm-6 col-xs-6 p-0 align-self-center">
													@if($row->calcute > 0)
													<del class="text-danger">
														{!! @$row->price_first['old'] !!}
													</del>
													@endif
												</div>
												<div class="col-sm-6 col-xs-6 p-0 align-self-center">
													<p class="m-0 text-secondary">
														{!! @$row->price_first['price'] !!}
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
					@endif
				</div>
			</div>
		</div>
	</div>
</main>

@stop
