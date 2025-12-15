@extends('layouts.site.master')
@section('title'){{@$setting_header->abouttitle ? $setting_header->abouttitle : $setting_header->title}} @stop
@section('image_seo'){{ @$setting_header->aboutimg ? asset('assets/uploads/content/set/big/'.$setting_header->aboutimg) : asset('assets/uploads/content/set/'.@$setting_header->logo)}} @endsection
@section('description')
    {!! strip_tags(\Illuminate\Support\Str::limit(@$setting_header->about,100))  !!}
@stop
@section('content')
<main class="content">
	<div class="rules">
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
									درباره ما
								</li>
							</ol>
						</nav>
					</div>
					<div class="col-sm-12 p-1 px-xs-2">
						<div class="bg-white product-details-header p-md-4 p-sm-3 p-xs-1">
							<div class="row w-100 m-0">
								<div class="col-md-2 col-sm-3 col-xs-5 py-xs-5 me-auto p-1">
									<figure>
										<div class="figure-inn">
											<img loading="lazy" src="{{'assets/uploads/content/set/big/'.@$setting_header->aboutimg}}"
												alt="{{@$setting_header->abouttitle}}">
										</div>
									</figure>
								</div>
								<div class="col-lg-10 p-1">
									<div class="ismb">
									<h1 rel="preload" class="text-a ismb">
                                        {{@$setting_header->abouttitle}}
									</h1>
									</div>
									<div class="text-justify text-secondary description">
										<p rel="preload">
                                            {!! @$setting_header->about !!}
                                        </p>
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
@section('js')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "BreadcrumbList",
            "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "name": "{{$setting_header->title}}",
                "item": "{{route('site.home')}}"
            },{
                "@type": "ListItem",
                "position": 2,
                "name": "{{$setting_header->abouttitle}}",
                "item": "{{ route('site.about') }}"
            }]
        }
    </script>
@endsection