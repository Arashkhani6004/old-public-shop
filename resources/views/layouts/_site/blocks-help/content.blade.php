<section class="header">
    <div class="container">
        <div class="row w-100 m-0">
            <div class="col-xxl-4 col-md-5 col-sm-12 d-md-block d-sm-none d-xs-none p-0 subsidiary">
                @include('layouts.site.blocks-help.content.header-banner')
            </div>
            <div class="col-xxl-8 col-md-7 p-1 main">
                <div class="d-md-block d-sm-none d-xs-none">
                    @include('layouts.site.blocks-help.content.main-banner')
                </div>
                <div class="d-md-none d-sm-block d-xs-block">
                    @include('layouts.site.blocks-help.content.main-banner-xs')
                </div>
            </div>
            <div class="col-xxl-4 col-md-5 col-sm-12 d-md-none d-sm-block d-xs-block p-0 subsidiary">
                @include('layouts.site.blocks-help.content.header-banner-xs')
            </div>
        </div>
    </div>
</section>
@include('layouts.site.blocks-help.content.offer-one')

    <div class="container">
        <div class="over2 my-3 pt-3 pb-2 px-3">
            <h1 class="ismb my-1 text-a">
                عنوان صفحه اول
            </h1>
        </div>
    </div>


    @include('layouts.site.blocks-help.content.category')

@include('layouts.site.blocks-help.content.offer-two')

    @include('layouts.site.blocks-help.content.products')

@include('layouts.site.blocks-help.content.offer-three')

    @include('layouts.site.blocks-help.content.discounts')


    @include('layouts.site.blocks-help.content.popular_products')

@include('layouts.site.blocks-help.content.offer-four')

@include('layouts.site.blocks-help.content.brands')


    @include('layouts.site.blocks-help.content.blogs')


@include('layouts.site.blocks-help.content.menu-app')
