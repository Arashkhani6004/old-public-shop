<div class="border border-custom rounded-custom overflow-hidden py-2">
	<nav>
		<div class="nav nav-tabs" id="nav-tab" role="tablist" style="overflow-x: auto;white-space: nowrap; flex-wrap: unset;">
			<button class="nav-link active" id="nav-1-tab" data-bs-toggle="tab" data-bs-target="#nav-1" type="button"
				role="tab" aria-controls="nav-1" aria-selected="true">
				<span class="d-lg-block d-sm-none d-xs-none">
					توضیحات محصول
				</span>
				<span class="d-lg-none d-sm-block d-xs-block">
					توضیحات
				</span>
			</button>
			<button class="nav-link" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-2" type="button"
				role="tab" aria-controls="nav-2" aria-selected="false">
				<span>
					مشخصات فنی
				</span>
			</button>
			<button class="nav-link" id="nav-3-tab" data-bs-toggle="tab" data-bs-target="#nav-3" type="button"
				role="tab" aria-controls="nav-3" aria-selected="false">
				<span class="d-lg-block d-sm-none d-xs-none">
					نظرات کاربران
				</span>
				<span class="d-lg-none d-sm-block d-xs-block">
					نظرات
				</span>
			</button>
			<button class="nav-link" id="nav-4-tab" data-bs-toggle="tab" data-bs-target="#nav-4" type="button"
				role="tab" aria-controls="nav-4" aria-selected="false">
				<span>
					سوالات متداول
				</span>
			</button>
            <button class="nav-link" id="nav-5-tab" data-bs-toggle="tab" data-bs-target="#nav-5" type="button"
                    role="tab" aria-controls="nav-5" aria-selected="false">
				<span>
					ویدیو و تیزر
				</span>
            </button>
		</div>
	</nav>
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade p-3 show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
			@include('site.product.blocks.other.description')
		</div>
		<div class="tab-pane fade p-3" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">
			@include('site.product.blocks.other.specifications')
		</div>
		<div class="tab-pane fade p-3" id="nav-3" role="tabpanel" aria-labelledby="nav-3-tab">
			@include('site.product.blocks.other.comments')
		</div>
		<div class="tab-pane fade p-3" id="nav-4" role="tabpanel" aria-labelledby="nav-4-tab">
			@include('site.product.blocks.other.faq')
		</div>
        <div class="tab-pane fade p-3" id="nav-5" role="tabpanel" aria-labelledby="nav-5-tab">
            @include('site.product.blocks.other.videos')
        </div>
	</div>
</div>
