<div class="bg-white product-details-header p-md-4 p-sm-3 p-xs-1">
    <div class="row w-100 m-0">
        <div class="col-lg-8 p-0">
            <div class="row w-100 m-0">
                <div class="col-md-6 p-2">
                    @include('site.product.blocks.header.zoom-pro')
                    <div class="d-lg-none d-sm-block d-xs-block pt-2">
                        @include('site.product.blocks.header.rate')
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 ms-auto p-0 d-lg-none d-sm-block d-xs-block">
                        @include('site.product.blocks.header.change-number')
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    @include('site.product.blocks.header.info-pro')
                </div>
                @if($sloagens->count() > 0)
                    <div class="col-sm-12 p-2">
                        @include('site.product.blocks.header.services-pro')
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-4 col-md-6 ms-auto p-2">
            @include('site.product.blocks.header.buy-pro')
        </div>
    </div>
</div>
