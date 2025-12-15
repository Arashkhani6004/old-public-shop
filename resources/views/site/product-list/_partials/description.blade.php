@if($category->description !== null)
<section class="seo-box mt-5 p-1">
    <div class="container">
        <div class="box">
            <div class="boxdes description">
                <input type="checkbox" id="expanded">
                <div id="text-box" class="p text-start after content">
                    {!! @$category->description !!}
                </div>
                <label for="expanded" id="more-button" role="button" class="btn button primary-btn m-auto d-flex px-4">
                    بیشتر
                </label>
            </div>
        </div>
    </div>
</section>
@endif
