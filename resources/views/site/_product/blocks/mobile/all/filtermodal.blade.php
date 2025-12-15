<!-- Button xs modal -->
<button type="button" class="btn btn-light w-100 d-flex align-items-center justify-content-around"
	data-bs-toggle="modal" data-bs-target="#filterModal">
	<i class="bi bi-funnel d-flex"></i>
	فیلتر محصولات
</button>

<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
			<div class="modal-header">
				<p class="modal-title h5" id="filterModalLabel">
					فیلتر محصولات
				</p>
				<button type="button" class="btn p-1" data-bs-dismiss="modal" aria-label="Close">
					<i class="bi bi-arrow-left"></i>
				</button>
			</div>
			<div class="modal-body">
				<div class="card border-0 rounded-custom">
					<div class="accordion" id="accordionFilterxs">
						<!-- <div class="accordion-item">
							<p class="accordion-header h2" id="headingOne">
								<button class="accordion-button" type="button" data-bs-toggle="collapse"
									data-bs-target="#collapseFilterxs1" aria-expanded="true"
									aria-controls="collapseFilterxs1">
									جستجو در نتایج :
								</button>
							</p>
							<div id="collapseFilterxs1" class="accordion-collapse collapse show"
								aria-labelledby="headingOne" data-bs-parent="#accordionFilterxs">
								<div class="accordion-body">
									@include('site.product.blocks.all.search-results')
								</div>
							</div>
						</div> -->
						<div class="accordion-item">
							<p class="accordion-header h2" id="headingTwo">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#collapseFilterxs2"
									aria-expanded="false" aria-controls="collapseFilterxs2">
									برندها
								</button>
							</p>
							<div id="collapseFilterxs2" class="accordion-collapse collapse"
								aria-labelledby="headingTwo" data-bs-parent="#accordionFilterxs">
								<div class="accordion-body">
									@include('site.product.blocks.all.search-brands')
								</div>
							</div>
						</div>

                            <div class="accordion-item">
                                <p class="accordion-header h2" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFilterxs2"
                                            aria-expanded="false" aria-controls="collapseFilterxs2">
                                        دسته ها
                                    </button>
                                </p>
                                <div id="collapseFilterxs2" class="accordion-collapse collapse"
                                     aria-labelledby="headingTwo" data-bs-parent="#accordionFilterxs">
                                    <div class="accordion-body">
                                        @include('site.product.blocks.all.search-cat')
                                    </div>
                                </div>
                            </div>

						<div class="accordion-item">
							<p class="accordion-header h2" id="headingTwo">
								<button class="accordion-button collapsed" type="button"
									data-bs-toggle="collapse" data-bs-target="#collapseFilterxs3"
									aria-expanded="false" aria-controls="collapseFilterxs3">
									فیلتر قیمت
								</button>
							</p>
							<div id="collapseFilterxs3" class="accordion-collapse collapse"
								aria-labelledby="headingTwo" data-bs-parent="#accordionFilterxs">
								<div class="accordion-body">
									<div class="d-md-none d-sm-block d-xs-block">
										@include('site.product.blocks.mobile.all.price-filter-mobile')
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <div class="modal-footer">
                <button type="button" @click="filterProducts()"  class="btn btn-success w-100 rounded-custom" data-bs-dismiss="modal" aria-label="Close">
                    اعمال فیلتر
                </button>
            </div>
		</div>
	</div>
</div>
