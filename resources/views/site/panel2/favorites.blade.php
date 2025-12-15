@extends('site.panel.master')
@section('content')

<div class="card rounded-custom favorit pro newest p-3 border-0 h-100">
	<div class="row w-100 m-0">
		<div class="col-sm-12 p-1">
			<p class="ismb h5 m-0 d-flex align-items-center justify-content-between">
				علاقه مندی ها
				<i class="bi bi-suit-heart text-a h4 my-0 me-2 d-flex"></i>
			</p>
			<hr class="hr-panel">
		</div>
		<div class="col-sm-12 p-1">
			<div class="row w-100 m-0">
            @if($likes-> count() == 0)
					@include('site.panel.blocks.empty-favorites')
				</div>
            @else
				<div class="col-sm-12 px-1">
					<div class="row w-100 m-0">
                        @foreach($likes as $row)
						<div class="col-xxl-3 p-1">
							<a href="{{route('site.product.detail',['id'=>$row->product->url])}}">
								<div class="card border px-1 py-4">
                                    @if($row->product->calcute > 0)
                                        <div
                                            class="disc text-white d-flex align-items-center justify-content-center">
                                            {{round(@$row->product->calcute)}}%
                                        </div>
                                    @endif
									<figure>
										<div class="figure-inn">
											<img data-src="{{@$row->product->pro_image}}" src="{{@$row->product->pro_image}}" class="swiper-lazy text-secondary h6" loading="lazy" alt=" {{@$row->title}}">
										</div>
									</figure>
									<p class="h6 mb-0 text-secondary">
                                        {{@$row->product->title}}
									</p>
									<div class="row w-100 m-0">
										<div class="col-sm-6 col-xs-6 p-0 align-self-center" >
                                            @if($row->product->calcute > 0)
                                                <del class="text-danger">
                                                    {!! @$row->product->price_first['old'] !!}
                                                </del>
                                            @endif
										</div>
										<div class="col-sm-6 col-xs-6 p-0 align-self-center">
                                            @if($row->product->price_first['price'] !== 'ندارد')
                                            <p class="m-0 text-secondary">
                                                {!! @$row->product->price_first['price'] !!}
                                            </p>
                                            @else
											<p class="m-0 text-secondary">
												ناموجود
											</p>
                                            @endif
										</div>
									</div>
								</div>
							</a>
						</div>
                        @endforeach
					</div>
				</div>
            @endif
			</div>
		</div>
	</div>
</div>

@stop
