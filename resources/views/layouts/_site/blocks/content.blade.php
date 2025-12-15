<section class="header">
    <div class="container">
        @if(App\Library\Helper::isMobile())
        @if($setting_header->h1 != null)
        <div class="container mb-4 d-block d-lg-none">
            <div class="my-0 pt-3 pb-2 px-3">
                <h1 class="ismb my-1 text-a text-center">
                    {!! @$setting_header->h1 !!}
                </h1>
            </div>
        </div>
        @endif
        @endif
            @if(!App\Library\Helper::isMobile())
                @if($setting_header->h1 != null)
                    <div class="container d-none mb-4 d-lg-block">
                        <div class="my-0 pt-3 pb-2 px-3">
                            <h1 class="ismb my-1 text-a text-center">
                                {!! @$setting_header->h1 !!}
                            </h1>
                        </div>
                    </div>
                @endif
            @endif
sss
        <div class="row w-100 m-0">
            @if(!App\Library\Helper::isMobile())
            <div class="col-xxl-4 col-xl-4 col-sm-12 d-md-block d-sm-none d-xs-none p-0 subsidiary right">
                @include('layouts._site.blocks.content.header-banner')
            </div>
            @endif
            <div class="col-xxl-8 col-xl-8 p-1 main left">
                @if(!App\Library\Helper::isMobile())
                <div class="d-md-block d-sm-none d-xs-none">
                    @include('layouts._site.blocks.content.main-banner')
                </div>
                @else
                <div class="d-md-none d-sm-block d-xs-block">
                    @include('layouts._site.blocks.content.main-banner-xs')
                </div>
                @endif
            </div>
            <div class="col-xxl-4 col-md-5 col-sm-12 d-md-none d-sm-block d-xs-block p-0 subsidiary">
                @include('layouts._site.blocks.content.header-banner-xs')
            </div>
        </div>
    </div>
</section>
@include('layouts._site.blocks.content.offer-one')

@if(count($categories) > 0)
@include('layouts._site.blocks.content.category')
@endif
@include('layouts._site.blocks.content.offer-two')
@if(count($new_products) > 0)
@include('layouts._site.blocks.content.products')
@endif
@include('layouts._site.blocks.content.offer-three')
@if(count($timer_products) > 0)
@include('layouts._site.blocks.content.discounts')
@endif
@if(count($most_products) > 0)
@include('layouts._site.blocks.content.most')
@endif
@if(count($popular_products) > 0)
@include('layouts._site.blocks.content.popular_products')
@endif
@include('layouts._site.blocks.content.offer-four')
@if(count($brands) > 0)
@include('layouts._site.blocks.content.brands')
@endif
@if(count($articles) > 0)
@include('layouts._site.blocks.content.blogs')
@endif

@include('layouts._site.blocks.content.menu-app')
sss