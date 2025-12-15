<!-- Button xs modal -->
<button type="button" class="btn btn-light w-100 d-flex align-items-center justify-content-around"
	data-bs-toggle="modal" data-bs-target="#viewbyModal">
	<i class="bi bi-sort-down d-flex"></i>
	مشاهده بر اساس
</button>

<!-- Modal -->
<div class="modal fade" id="viewbyModal" tabindex="-1" aria-labelledby="viewbyModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="viewbyModalLabel">
					مشاهده بر اساس
				</h5>
				<button type="button" class="btn p-1" data-bs-dismiss="modal" aria-label="Close">
					<i class="bi bi-arrow-left"></i>
				</button>
			</div>
			<div class="modal-body">
				<ul class="p-0 m-0">
					<li class="d-flex list-unstyled me-2 py-lg-0 py-sm-1 py-xs-1">
						<div class="d-flex align-items-center border rounded-custom w-100">
							@include('site.brand.blocks.viewby')
						</div>
					</li>
					<li class="d-flex list-unstyled me-2 py-lg-0 py-sm-1 py-xs-1">
						<div class="d-flex align-items-center border rounded-custom w-100">
							@include('site.brand.blocks.available')
						</div>
					</li>
				</ul>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success w-100 rounded-custom" data-bs-dismiss="modal" aria-label="Close">
                    اعمال فیلتر
                </button>
            </div>
		</div>
	</div>
</div>
