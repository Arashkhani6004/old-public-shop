<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered search-modal">
        <div class="modal-content">
            <div class="modal-header">
                <p class="fm-b m-0">جستجو</p>
                <button type="button" class="btn-close ms-auto shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{URL::action('Site\HomeController@getSearch')}}" class="m-0 position-relative">
                <div class="input-group mb-3">
                    <input type="search" class="form-control small shadow-none" name="search" placeholder="جستجوی نام محصول،برند و یا..."
                    aria-label="Example text with button addon" aria-describedby="button-addon1">
                    <button class="btn primary-btn shadow-none" type="submit" id="button-addon1">
                        <i class="bi bi-search d-flex"></i>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
