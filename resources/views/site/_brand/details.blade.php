@extends('layouts.site.master')
@section('title'){{@$brand->title_seo ? $brand->title_seo : $brand->title}} @stop
@section('image_seo'){{ @$brand->image ? $brand->brand_image : asset('assets/uploads/content/set/'.@$setting->logo)}}
@endsection
@section('canonical'){{$brand->keyword ? $brand->keyword : trim(url()->current())}}@stop

@section('description')
    @if($brand->description_seo != null)
        {!! $brand->description_seo !!}
    @else
        {!! strip_tags(\Illuminate\Support\Str::limit($brand->description,100)) !!}
    @endif
@stop
@section('content')
<main class="content">
	<div class="br br-det">
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
                                <li class="breadcrumb-item">
                                    <a href="{{route('site.brand.list')}}">
                                        برندها
                                    </a>
                                </li>
								<li class="breadcrumb-item active" aria-current="page">
									 {{@$brand->title}}
								</li>
							</ol>
						</nav>
					</div>
					<div class="col-xxl-3 p-1">
						<div
							class="bg-white product-details-header p-md-4 p-sm-3 p-xs-1 h-100 d-flex align-items-center">
							<figure>
								<div class="figure-inn">
									<img src="{{$brand->brand_image}}" alt="{!! @$brand->title !!}">
								</div>
							</figure>
						</div>
					</div>
					<div class="col-xxl-9 p-1">
						<div class="bg-white product-details-header p-md-4 p-sm-3 p-xs-3">
							<div class="">
								<h1 class="ismb text-a">
                                    @if($brand->title2)  {{@$brand->title2}} @else {{@$brand->title}} @endif
								</h1>
                                @if($brand->description != null)
								<div class="text-secondary text-justify description">
									<p>
								{!! @$brand->description !!}
									</p>
                                    @if(@$brand->tags->count() > 0)
                                        <p class="ismb">
                                            تگ ها
                                        </p>
                                        <ul class="p-0 m-0">
                                            @foreach(@$brand->tags as $tag)
                                                <li style="display: inline-table; padding: 2.5px 0.5px">
                                                    <a href="{{url('/tag/'.str_replace(' ', '-',$tag->title))}}" class="d-flex border px-2 py-1 rounded-3 text-secondary bg-white shadow-sm" style="font-size:0.8rem;">
                                                        {{@$tag->title}}			</a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    @endif
                                    <br>
								</div>
                                @endif

							</div>

						</div>
					</div>

					<div class="col-sm-12 product pro-list p-0">
						<div class="row w-100 m-0">
							<!-- start mobile -->
							<div class="col-sm-6 col-xs-6 px-2 py-1 d-md-none d-sm-block d-xs-block">
								@include('site.brand.blocks.mobile.filtermodal')
							</div>
							<div class="col-sm-6 col-xs-6 px-2 py-1 d-md-none d-sm-block d-xs-block">
								@include('site.brand.blocks.mobile.viewbymodal')
							</div>
							<!-- end mobile -->
							<div class="col-xl-3 col-md-4 col-sm-5 p-1 d-md-block d-sm-none d-xs-none">
								<div class="position-sticky sticky d-md-block d-sm-none d-xs-none">
									@include('site.brand.blocks.sidebar')
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
														@include('site.brand.blocks.viewby')
													</div>
												</li>
												<li class="d-inline float-start me-2 py-lg-0 py-sm-1">
													<div
														class="d-flex align-items-center border rounded-custom">
														@include('site.brand.blocks.available')
													</div>
												</li>
											</ul>
										</div>
									</div>
                                    <div class="col-sm-12 p-1">
                                        <div class="card rounded-custom border-0 p-md-3 p-sm-2 m-xs-1 pro">
                                            <div class="row w-100 m-0">
                                                <template v-if="loading2 === true">
                                                    <div class="col-sm-12 p-1">
                                                        <div class="p-md-0 p-sm-1 p-xs-1">
                                                            @include('site.product.blocks.loading')
                                                        </div>
                                                    </div>
                                                </template>
                                                <template v-if="loading2 === false">
                                                    <div class="col-xl-3 col-md-4 col-sm-4 col-xs-6 p-1"
                                                         v-for="product in products">
                                                        @include('layouts.site.blocks.content.pro-box')
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
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
