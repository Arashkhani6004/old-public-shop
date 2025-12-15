@extends('layouts.site.master')
@section('title'){{@$seo->title_seo ? @$seo->title_seo : @$seo->title}} @stop

@section('description')
    @if(@$seo->description_seo != null)
        {!! @$seo->description_seo !!}
    @else
        {!! strip_tags(\Illuminate\Support\Str::limit(@$seo->description,100)) !!}
    @endif
@stop


@section('content')
<main class="content">
	<div class="">
		<div class="bg-b-light py-3">
			<div class="container">
			    @if(@$seo->description != null)
                <div class="col-sm-12 p-1 px-xs-2">
                    <div class="card rounded-custom border-0 p-md-4 p-sm-3 p-xs-1">


                        <div class="description text-secondary text-justify">

                           {!!@$seo->description!!}
                        </div>

                    </div>
                </div>
                @endif
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
									{{@$seo->title}}
								</li>
								
							</ol>
						</nav>
					</div>
					<div class="col-sm-12 p-1 px-xs-2">
						<div class="bg-white product-details-header p-3">
							<p class="h2 m-0 ismb text-a border-bottom">
                                @if(!empty($tag)) "{{@$seo->title}}" @endif{{'('.$count.')'}}
							</p>
						</div>
					</div>
					@if(@$seo && count(@$seo->products) > 0 )
					<div class="col-sm-12 p-1 px-xs-2 pro pro-det">
						<div class="bg-white product-details-header p-3">
							<p class="h3 ismb text-b border-bottom">
                                 محصولات در "{{@$seo->title}}"
							</p>
							<div class="row w-100 m-0">
                                @foreach($data as $row)
                                    @if($row->taggable_type == "App\Models\Product")
                                        @php  @$products = \App\Models\Product::where('id',$row->taggable_id)->get();
                                        @endphp
                                        @if($products)
                                            @foreach(@$products as $row)
                								<div class="col-xxl-2 col-lg-3 col-sm-4 col-xs-6 p-1">
                									<a href="{{route('site.product.detail',['id'=>$row->url])}}">
                										<div class="card border px-1 py-4">
                											@if($row->price > 0 && $row->old_price > 0)
                											<div
                												class="disc text-white d-flex align-items-center justify-content-center">
                												{{round(((@$row->old_price - @$row->price)/@$row->old_price)*100)}}%
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
                												@if($row->price > 0)
                												<div class="col-sm-6 col-xs-6 p-0 align-self-center">
                													<!--@if($row->calcute > 0)-->
                													<!--<del class="text-danger">-->
                													<!--	{!! @$row->price_first['old'] !!}-->
                													<!--</del>-->
                													<!--@endif-->
                													<del class="text-danger">
                													    {{ number_format(@$row->old_price)}} تومان
                													</del>
                												</div>
                												<div class="col-sm-6 col-xs-6 p-0 align-self-center">
                													<p class="m-0 text-secondary">
                													    
                														{!! number_format(@$row->price) !!} تومان  
                													</p>
                												</div>
                												@else
                												<div class="col-sm-6 col-xs-6 p-0 align-self-center">
                													<p class="m-0 text-secondary">
                													    
                														{!! number_format(@$row->old_price) !!} تومان    
                													</p>
                												</div>
                												@endif
                												<!--<div class="col-sm-6 col-xs-6 p-0 align-self-center">-->
                												<!--	@if($row->calcute > 0)-->
                												<!--	<del class="text-danger">-->
                												<!--		{!! @$row->price_first['old'] !!}-->
                												<!--	</del>-->
                												<!--	@endif-->
                												<!--</div>-->
                												<!--<div class="col-sm-6 col-xs-6 p-0 align-self-center">-->
                												<!--	<p class="m-0 text-secondary">-->
                													    
                												<!--		{!! @$row->price_first['price'] !!}-->
                												<!--	</p>-->
                												<!--</div>-->
                											</div>
                										</div>
                									</a>
                								</div>
                                            @endforeach
                                        @endif
                                    @endif
                                @endforeach
							</div>
						</div>
					</div>
@endif
	@if(@$seo && @$seo->brands->count() > 0 )
					<div class="col-sm-12 p-1 px-xs-2 br br-list brands">
						<div class="bg-white product-details-header p-3">
							<p class="h3 ismb text-b border-bottom">
                                 برندها در "{{$x}}"
							</p>
							<div class="row w-100 m-0">
                                @foreach($data as $row3)
                                    @if($row3->taggable_type == "App\Models\Brand")
                                        @php  $brands = \App\Models\Brand::where('id',$row3->taggable_id)->get();
                                        @endphp
                                        @foreach($brands as $brand)
								<div class="col-xxl-2 col-xl-3 col-md-4 col-6 text-center p-1">
									<a href="{{route('site.brand.detail',['id'=>$brand->url])}}">
										<div class="card rounded-0">
											<figure>
												<div class="figure-inn">
													<img src="{{$brand->brand_image}}"
														alt="{!! @$brand->title !!}">
												</div>
											</figure>
											<p class="text-b mb-3">
												{!! @$brand->title !!}
											</p>
										</div>
									</a>
								</div>
                                        @endforeach
                                    @endif
                                @endforeach
							</div>
						</div>
					</div>
@endif
	@if(@$seo && @$seo->contents->count() > 0 )
										<div class="col-sm-12 p-1 px-xs-2 blog">
											<div class="bg-white product-details-header p-3">
												<p class="h3 ismb text-b border-bottom">
                                                <p class="h5 ismb">
                                                     مقالات در "{{$x}}"
												</p>
												<div class="row w-100 m-0 st">
                                                    @foreach($data as $row4)
                                                        @if($row4->taggable_type == "App\Models\Content")
                                                            @php  $blogs = \App\Models\Content::where('id',$row4->taggable_id)->get();
                                                            @endphp
                                                            @foreach($blogs as $blog)
													<div class="col-xl-3 col-lg-4 col-sm-6 col-xs-12 p-1">
                                                        <a href="{{route('site.blog.detail',['id'=>$blog->id])}}">
															<div class="card p-5"
                                                                 style="background-image: url({{asset('assets/uploads/content/art/medium/'.@$blog->image)}});">
																<div class="overlay">
																	<p class="m-0 text-c">
                                                                        {{@$blog->title}}
																	</p>
																</div>
															</div>
														</a>
													</div>
                                                            @endforeach
                                                        @endif
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
