@extends('layouts.site.master')
@section('title'){{@$blog_category->title_seo ? $blog_category->title_seo : $blog_category->title}} @stop
@section('image_seo'){{ @$blog_category->image ? asset('assets/uploads/content/art/big/'.$blog_category->image) : asset('assets/uploads/content/set/'.@$setting->logo)}}
@endsection

@section('description')
@if($blog_category->description_seo != null)
{!! $blog_category->description_seo !!}
@else
{!! strip_tags(\Illuminate\Support\Str::limit($blog_category->description,100)) !!}
@endif
@stop
@section('content')

<main class="content">
	<div class="blog">
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
									<a href="{{route('site.blog.cat')}}">
										لیست مقالات
									</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">
									لیست مقالات {{@$blog_category->title}}
								</li>
							</ol>
						</nav>
					</div>
					<div class="col-sm-12 p-0">
						<div class="row w-100 m-0 st">
							@foreach($blogs as $blog)
							<div class="col-xl-3 col-lg-4 col-sm-6 col-xs-12 p-1">
								<a href="{{route('site.blog.detail',['id'=>$blog->id])}}">
									<div class="card p-5"
										style="background-image: url('{{asset('assets/uploads/content/art/medium/'.@$blog->image)}}');">
										<div class="overlay">
											<p class="m-0 text-c">
												{{@$blog->title}}
											</p>
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
</main>

@stop
