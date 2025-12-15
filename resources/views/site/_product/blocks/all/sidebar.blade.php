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
					@include('site.product.blocks.all.search-brands')
				</div>
			</div>
		</div>
        <div class="accordion-item">
            <p class="accordion-header h2" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFilter4" aria-expanded="false" aria-controls="collapseFilter4">
                    دسته ها
                </button>
            </p>
            <div id="collapseFilter4" class="accordion-collapse collapse" aria-labelledby="headingFour"
                 data-bs-parent="#accordionFilter">
                <div class="accordion-body">
                    @include('site.product.blocks.all.search-cat')
                </div>
            </div>
        </div>

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
						@include('site.product.blocks.all.price-filter-desktop')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
