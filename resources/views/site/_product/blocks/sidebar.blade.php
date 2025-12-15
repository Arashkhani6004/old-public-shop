@if($category->mega != null)
	@if($category->mega_url != null)
	<a href="{{@$category->mega_url}}">
		<img src="{{@$category->CatMega}}" class="w-100 mb-2" style="border-radius: 1rem;">
	</a>
	@else
	<img src="{{@$category->CatMega}}" class="w-100 mb-2" style="border-radius: 1rem;">
	@endif
@endif
<div class="card border-0 rounded-custom">
	<div class="accordion" id="accordionFilter">
		{{--		<div class="accordion-item">--}}
		{{--			<p class="accordion-header h2" id="headingOne">--}}
		{{--				<button class="accordion-button" type="button" data-bs-toggle="collapse"--}}
		{{--					data-bs-target="#collapseFilter1" aria-expanded="true" aria-controls="collapseFilter1">--}}
		{{--					جستجو در نتایج :--}}
		{{--				</button>--}}
		{{--			</p>--}}
		{{--			<div id="collapseFilter1" class="accordion-collapse collapse show" aria-labelledby="headingOne"--}}
		{{--				data-bs-parent="#accordionFilter">--}}
		{{--				<div class="accordion-body">--}}
		{{--					@include('site.product.blocks.search-results')--}}
		{{--				</div>--}}
		{{--			</div>--}}
		{{--		</div>--}}
		<div class="accordion-item">
			<p class="accordion-header h2" id="headingTwo">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
					data-bs-target="#collapseFilter2" aria-expanded="false" aria-controls="collapseFilter2">
					برندها
				</button>
			</p>
			<div id="collapseFilter2" class="accordion-collapse collapse" aria-labelledby="headingTwo"
				data-bs-parent="#accordionFilter">
				<div class="accordion-body">
					@include('site.product.blocks.search-brands')
				</div>
			</div>
		</div>
		@foreach($fields as $key=>$row)
		<div class="accordion-item">
			<p class="accordion-header h2" id="headingTwo{{$key}}">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
					data-bs-target="#collapseFilter4{{$key}}" aria-expanded="false"
					aria-controls="collapseFilter4{{$key}}">
					{{$row->title}}
				</button>
			</p>

			<div id="collapseFilter4{{$key}}" class="accordion-collapse collapse"
				aria-labelledby="headingTwo{{$key}}" data-bs-parent="#accordionFilter">
				<div class="accordion-body" style="max-height:9.5rem;overflow:auto;">
					@include('site.product.blocks.specification')
				</div>
			</div>

		</div>
		@endforeach
		<div class="accordion-item">
			<p class="accordion-header h2" id="headingTwo">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
					data-bs-target="#collapseFilter3" aria-expanded="false" aria-controls="collapseFilter3">
					فیلتر قیمت
				</button>
			</p>
			<div id="collapseFilter3" class="accordion-collapse collapse" aria-labelledby="headingTwo"
				data-bs-parent="#accordionFilter">
				<div class="accordion-body">
					<div class="d-md-block d-sm-none d-xs-none">
						@include('site.product.blocks.price-filter-desktop')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
