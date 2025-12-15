<div class="tabs mt-5">
    <nav class="product-tabs-menu sticky-top pb-0 pt-md-3 pt-2 mb-4">
        <div class=" d-flex justify-content-start gap-4">
            <a href="#description" class="btn btn-link text-decoration-none active px-0">توضیحات</a>
            <a href="#specifications" class="btn btn-link text-decoration-none px-0">مشخصات</a>
            <a href="#videos" class="btn btn-link text-decoration-none px-0">ویدیو و تیزر</a>
            <a href="#faq" class="btn btn-link text-decoration-none px-0">سوالات متداول</a>
            <a href="#comments" class="btn btn-link text-decoration-none px-0">نظرات</a>
        </div>
    </nav>

    <div class="container">
        <section id="description" class="mb-5">
            @include('site.product-detail._partials.tabs.description')
        </section>

        <section id="specifications" class="mb-5">
            @include('site.product-detail._partials.tabs.specifications')
        </section>

        <section id="videos" class="mb-5">
            @include('site.product-detail._partials.tabs.videos')
        </section>

        <section id="faq" class="mb-5">
            @include('site.product-detail._partials.tabs.faq')
        </section>

        <section id="comments" class="mb-5">
            @include('site.product-detail._partials.tabs.comments')
        </section>
    </div>
</div>



{{-- <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                aria-selected="true">توضیحات</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                aria-selected="false">مشخصات</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video-tab-pane"
                type="button" role="tab" aria-controls="video-tab-pane" aria-selected="false">ویدیو و
                تیزر</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq-tab-pane"
                type="button" role="tab" aria-controls="faq-tab-pane" aria-selected="false">سوالات
                متداول</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane"
                aria-selected="false">نظرات</button>
        </li>
    </ul>
    <div class="tab-content bg-white p-3 rounded-4 mt-3 shadow-sm" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
            tabindex="0">
            @include('site.product-detail._partials.tabs.description')
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
            tabindex="0">
            @include('site.product-detail._partials.tabs.specifications')
            
        </div>
        <div class="tab-pane fade" id="video-tab-pane" role="tabpanel" aria-labelledby="video-tab"
            tabindex="0">
            @include('site.product-detail._partials.tabs.videos')
            
        </div>
        <div class="tab-pane fade" id="faq-tab-pane" role="tabpanel" aria-labelledby="faq-tab" tabindex="0">
            @include('site.product-detail._partials.tabs.faq')
            
        </div>
        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
            tabindex="0">
            @include('site.product-detail._partials.tabs.comments')
    
        </div>
    </div> --}}
