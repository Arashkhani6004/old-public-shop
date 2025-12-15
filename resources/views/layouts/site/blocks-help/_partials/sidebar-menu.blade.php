<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header p-2">
        <img src="{{ asset('assets/site/images/frame-logo.png') }}" id="logo" width="45"
            alt="" title="" loading="lazy" />

        <button type="button" class="btn btn-text p-0 d-flex align-items-center ms-auto btn-sm"
            data-bs-dismiss="offcanvas" aria-label="Close">
            برگشت
            <i class="bi bi-arrow-left-short d-flex ms-1"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <ul class="p-0 m-0">
            <li class="list-unstyled">
                <a href="{{ url('/') }}" class="d-flex align-items-center">
                    <i class="bi bi-house-door d-flex fs-5 me-2"></i>
                    صفحه اصلی
                </a>
            </li>
            <li class="list-unstyled">
                <a class="d-flex align-items-center mega-item-mobile" data-bs-toggle="collapse" href="#collapseExample"
                    role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="bi bi-boxes d-flex fs-5 me-2"></i>
                    محصولات
                </a>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body border-0 bg-transparent p-2">
                        <div class="accordion" id="accordionExample">
                            @foreach ($category_footer as $key => $cat)
                                <div class="accordion-item">
                                    <div class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne-{{ $cat->id }}"
                                            aria-expanded="false" aria-controls="collapseOne-{{ $cat->id }}">
                                            {{ @$cat->title }}
                                        </button>
                                    </div>
                                    <div id="collapseOne-{{ $cat->id }}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-2">
                                            <a href="{{ route('site.product.list', ['id' => $cat->url]) }}"
                                                class="d-flex align-items-center small fm-md">
                                                <i class="bi bi-caret-left-fill d-flex me-1"></i>
                                                همه محصولات {{ @$cat->title }}
                                            </a>
                                            <div class="accordion accordion-flush border-top pt-2"
                                                id="accordionFlushExample">
                                                @foreach ($cat->childs as $key => $child)
                                                    <div class="accordion-item level-third rounded-0">
                                                        <div class="accordion-header">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#flush-collapseOne-{{ $child->id }}"
                                                                aria-expanded="false"
                                                                aria-controls="flush-collapseOne-{{ $child->id }}">
                                                                {{ @$child['title'] }}
                                                            </button>
                                                        </div>
                                                        <div id="flush-collapseOne-{{ $child->id }}"
                                                            class="accordion-collapse collapse"
                                                            data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body p-1">
                                                                <a href="{{ route('site.product.list', ['id' => @$child->url]) }}"
                                                                    class="d-flex align-items-center small fm-md">
                                                                    <i class="bi bi-caret-left-fill d-flex me-1"></i>
                                                                    همه محصولات {{ @$child['title'] }}
                                                                </a>
                                                                <ul class="p-0 m-0 mt-0">
                                                                    @foreach ($child->childs as $childRowView)
                                                                        <li class="list-unstyled mb-0">
                                                                            <a href="{{ route('site.product.list', ['id' => @$childRowView->url]) }}"
                                                                                class="d-flex align-items-center small fm-re">
                                                                                <i
                                                                                    class="bi bi-caret-left d-flex me-1"></i>
                                                                                {{ @$childRowView['title'] }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </li>
            @if ($brandsCount > 0)
                <li class="list-unstyled">
                    <a href="{{ route('site.brand.list') }}" class="d-flex align-items-center">
                        <i class="bi bi-box-seam d-flex fs-5 me-2"></i>
                        برندها
                    </a>
                </li>
            @endif
            @if ($blogCount > 0)
                <li class="list-unstyled">
                    <a href="{{ route('site.blog.cat') }}" class="d-flex align-items-center">
                        <i class="bi bi-newspaper d-flex fs-5 me-2"></i>
                        دانستنی ها
                    </a>
                </li>
            @endif
            <li class="list-unstyled">
                <a href="{{ route('site.contact') }}" class="d-flex align-items-center">
                    <i class="bi bi-telephone d-flex fs-5 me-2"></i>
                    تماس با ما
                </a>
            </li>
            <li class="list-unstyled">
                <a href="{{ route('site.about') }}" class="d-flex align-items-center">
                    <i class="bi bi-info-square d-flex fs-5 me-2"></i>
                    درباره ما
                </a>
            </li>
            @foreach ($pages_menu as $page_menu)
                <li class="list-unstyled">
                    <a href="{{ route('site.page.detail', ['id' => @$page_menu->url]) }}"
                        class="d-flex align-items-center">
                        <i class="bi bi-info-square d-flex fs-5 me-2"></i>
                        {!! @$page_menu->title !!}
                    </a>
                </li>
            @endforeach
        </ul>
        <ul class="social d-flex flex-wrap align-items-center justify-content-center gap-3 p-0 m-0 mt-4">
            @foreach ($social_header as $row)
                <li class="list-unstyled">
                    <a href="{{ $row->address }}">
                        <img src="{{ asset('assets/site/images/socials/' . $row->icon . '.png') }}" width="20"
                            height="20" alt="{{ $row->icon }}" title="{{ $row->icon }}" />
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
