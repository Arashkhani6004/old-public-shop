<div class="card border-0 rounded-custom">
	<div class="accordion" id="accordionFilter">
{{--		<div class="accordion-item">--}}
{{--			<h2 class="accordion-header" id="headingOne">--}}
{{--				<button class="accordion-button" type="button" data-bs-toggle="collapse"--}}
{{--					data-bs-target="#collapseFilter1" aria-expanded="true" aria-controls="collapseFilter1">--}}
{{--					جستجو در نتایج :--}}
{{--				</button>--}}
{{--			</h2>--}}
{{--			<div id="collapseFilter1" class="accordion-collapse collapse show" aria-labelledby="headingOne"--}}
{{--				data-bs-parent="#accordionFilter">--}}
{{--				<div class="accordion-body">--}}
{{--					@include('site.product.blocks.search-results')--}}
{{--				</div>--}}
{{--			</div>--}}
{{--		</div>--}}
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingTwo">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
					data-bs-target="#collapseFilter2" aria-expanded="false" aria-controls="collapseFilter2">
                    فیلتر بر اساس دسته بندی
				</button>
			</h2>
			<div id="collapseFilter2" class="accordion-collapse collapse" aria-labelledby="headingTwo"
				data-bs-parent="#accordionFilter">
				<div class="accordion-body">
					@include('site.brand.blocks.search-brands')
				</div>
			</div>
		</div>
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingTwo">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
					data-bs-target="#collapseFilter3" aria-expanded="false" aria-controls="collapseFilter3">
					فیلتر قیمت
				</button>
			</h2>
			<div id="collapseFilter3" class="accordion-collapse collapse" aria-labelledby="headingTwo"
				data-bs-parent="#accordionFilter">
				<div class="accordion-body">
					<div class="d-md-block d-sm-none d-xs-none">
						@include('site.brand.blocks.price-filter-desktop')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
