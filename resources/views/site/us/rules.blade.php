@extends('layouts.site.master')
@section('title'){{@$setting_header->title_rules ? $setting_header->title_rules : $setting_header->title}} @stop

@section('description')
    @if($setting_header->des_rules != null)
        {!! $setting_header->des_rules !!}
    @else
        {!! $setting_header->description_seo !!}
    @endif
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
									<a href="{{url('/')}}">
										خانه
									</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">
									قوانین و مقررات
								</li>
							</ol>
						</nav>
					</div>
					<div class="col-sm-12 p-1 px-xs-2">
						<div class="bg-white product-details-header p-md-4 p-sm-3 p-xs-1">
							<div class="row w-100 m-0">

								<div class="col-lg-12 p-1">
									<h1 class="text-a ismb">
										قوانین و مقررات
									</h1>
									<div class="text-justify text-secondary description">
										<p>
							{!! @$setting_header->rules !!}
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
