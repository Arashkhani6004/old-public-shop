@extends('layouts.site.master')
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
	<div class="product pro-cat">
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
								@if($category->parent_id !=null)
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
                        <div class="card rounded-custom border-0 p-md-4 p-sm-3 p-xs-1">
                            <h1 class="ismb text-a">
                                {{@$category->title2 ? $category->title2: $category->title}}
                            </h1>
                            @if($category->description !== null)
                            <div class="description text-secondary text-justify">
                                {!! @$category->description !!}
                            </div>
                            @endif
                        </div>
                    </div>
					<div class="col-sm-12 p-0">
						<div class="row w-100 m-0">
							@foreach($category->childs as $child)
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 p-1">
								<a href="{{route('site.product.list',['id'=>$child->url])}}">
									<div class="card border-0 rounded-0 p-2">
										<figure>
											<div class="figure-inn rounded-0">
												<img src="{{@$child->cat_image}}" alt="">
											</div>
										</figure>
										<p class="h5 fw-bolder text-dark my-2">

											{{@$child->title}}

										</p>
										@if($child->description != null && $child->description !== 'NULL')
										<p class="text-secondary m-0">
											{!! \Illuminate\Support\Str::limit(@$child->description,200) !!}
										</p>
										@endif
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
</main>

@stop
