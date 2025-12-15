<section class="main-menu-mobile d-md-none d-block">
    <div class="container">
        <div class="row w-100 m-0 align-items-center">
            <div class="col-3 p-1">
                <button class="btn btn-menu p-1" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="bi bi-list d-flex fs-5"></i>
                </button>
            </div>
            <div class="col-6 p-1">
                <a href="/" class="logo d-block text-center">
                    <img src="{{ asset('assets/uploads/content/set/' . @$setting_header->logo) }}" id="logo"
                        width="65" alt="{{ @$setting_header->title }}" title="{{ @$setting_header->title }}" />
                </a>
            </div>
            <div class="col-3 p-1">
                <button type="button" class="btn-menu border-0 w-max ms-auto position-relative" class="border-0"
                    data-bs-toggle="modal" data-bs-target="#searchModal">
                    <img src="{{ asset('assets/site/images/icons/search.svg') }}" width="20" height="20"
                        alt="icon" title="icon" />
                </button>

            </div>
        </div>
    </div>
</section>
