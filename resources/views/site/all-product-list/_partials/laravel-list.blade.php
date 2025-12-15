<div class="row w-100 m-0 p-0">
    <template v-if="loading2 === true">
        <div class="col-sm-12 p-1">
            <div class="p-md-0 p-sm-1 p-xs-1">
                @include('layouts.site.components.loading')
            </div>
        </div>
    </template>
    <template v-else>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-6 p-sm-2 p-1" v-for="product in products">
            @include('layouts.site.components.product-box')
        </div>
    </template>
</div>
