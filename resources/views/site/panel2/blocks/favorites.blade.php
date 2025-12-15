<div class="card favorites-sid rounded-custom p-3 border-0 h-100">
	<div class="row w-100 m-0">
		<div class="col-sm-12 p-1">
			<p class="ismb h5 m-0 d-flex align-items-center justify-content-between">
				علاقه مندی ها
				<i class="bi bi-suit-heart text-a h4 my-0 me-2 d-flex"></i>
			</p>
		</div>
        @if($user->likes->count() == 0)
		 <div class="col-sm-12 p-1">
			@include('site.panel.blocks.empty-favorites-side')
		</div>
        @else
            @foreach($user->likes as $row)
		<div class="col-sm-12 p-1">
			<a href="{{route('site.product.detail',['id'=>$row->product->url])}}">
				<div class="bg-light shadow-sm p-1">
					<div class="row w-100 m-0">
						<div class="col-xxl-3 col-md-4 col-sm-2 col-xs-3 align-self-center p-1">
							<figure class="bg-white border">
								<div class="figure-inn p-2">
									<img src="{{@$row->product->pro_image}}" alt="   {{@$row->product->title}}">
								</div>
							</figure>
						</div>
						<div class="col-xxl-9 col-md-12 col-sm-10 col-xs-9 align-self-center p-1">
							<p class="fw-bolder text-dark my-1 h6">
                                {{@$row->product->title}}
							</p>
                            @if($row->product->price_first['price'] !== 'ندارد')
							<p class="my-1 text-secondary">
                                {!! @$row->product->price_first['price'] !!}
							</p>
                            @else
                                <p class="my-1 text-secondary">
                                 ناموجود
                                </p>
                            @endif
						</div>
					</div>
				</div>
			</a>
		</div>
                @endforeach
                <div class="col-sm-12 p-1">
                    <a href="{{route('panel.favorites')}}" class="btn btn-pro-buy w-100 rounded-custom">
                        مشاهده همه
                    </a>
                </div>
        @endif

	</div>
</div>
