@extends('layouts.site.master')
@section('title'){{@$setting_header->title_brand ? $setting_header->title_brand : $setting_header->title}} @stop

@section('description')
    @if($setting_header->des_brand != null)
        {!! $setting_header->des_brand !!}
    @else
        {!! $setting_header->description_seo !!}
    @endif
@stop
@section('content')

<main class="content">
	<div class="br br-list brands">
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
									لیست برندها
								</li>
							</ol>
						</nav>
					</div>
					<div class="col-sm-12 p-1 px-xs-2">
						<div class="bg-white product-details-header p-md-4 p-sm-3 p-xs-1">
							<div class="row w-100 m-0">
                                @foreach($brands as $brand)
								<div class="col-xl-3 col-md-4 col-6 text-center p-1">
									<a href="{{route('site.brand.detail',['id'=>$brand->url])}}">
										<div class="card rounded-0">
											<figure>
												<div class="figure-inn">
													<img src="{{$brand->small_image}}" alt="{!! @$brand->title !!}">
												</div>
											</figure>
											<p class="text-b mb-3">
                                                {!! @$brand->title !!}
											</p>
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
</main>

@stop
