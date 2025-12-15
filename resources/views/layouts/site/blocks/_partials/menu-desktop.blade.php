<section class="main-menu d-md-block d-none">
    <div class="container">
        <div class="row w-100 m-0">
            <div class="col-xl-9 col-lg-8 col-md-9 p-1 align-self-center position-relative">
                <ul class="d-flex align-items-center p-0 m-0">
                    <li class="list-unstyled">
                        <a href="/" class="logo">
                            <img src="{{ asset('assets/uploads/content/set/' . @$setting_header->logo) }}" id="logo"
                                width="65" alt="{{ @$setting_header->title }}"
                                title="{{ @$setting_header->title }}" />
                        </a>
                    </li>
                    <li class="list-unstyled">
                        <a href="{{ url('/') }}" class="text-dark small px-2"> صفحه اصلی </a>
                    </li>
                    <li class="list-unstyled mega-item">
                        <a href="{{ url('/all-products') }}" class="text-dark small px-2 d-flex align-items-center">
                            محصولات
                            <i class="bi bi-chevron-down d-flex ms-1"></i>
                        </a>
                        <div class="mega-box">
                            <div class="inner-box">
                                <div class="d-flex align-items-start">
                                    <div class="nav flex-column nav-pills me-1 mega-side border-end col-lg-3 col-md-4"
                                        id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        @foreach ($category_footer as $key => $cat)
                                            <button class="nav-link @if ($key == 0) active @endif"
                                                id="v-pills-{{ $cat->id }}-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-pills-{{ $cat->id }}" type="button"
                                                role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                {{ @$cat->title }}</button>
                                        @endforeach

                                    </div>
                                    <div class="tab-content p-2 col-lg-9 col-md-8" id="v-pills-tabContent">
                                        @foreach ($category_footer as $key => $cat)
                                            <div class="tab-pane fade @if ($key == 0) show active @endif"
                                                id="v-pills-{{ $cat->id }}" role="tabpanel"
                                                aria-labelledby="v-pills-{{ $cat->id }}-tab" tabindex="0">
                                                <a href="{{ route('site.product.list', ['id' => $cat->url]) }}"
                                                    class="d-flex align-items-center link-cat fm-md">
                                                    <i class="bi bi-caret-left-fill d-flex me-1"></i>
                                                    همه محصولات دسته بندی {{ @$cat->title }}</a>
                                                <ul class="p-0 m-0 mt-4 main-cat">
                                                    @foreach ($cat->childs as $key => $child)
                                                        <li class="list-unstyled">
                                                            <a href="{{ route('site.product.list', ['id' => @$child->url]) }}"
                                                                class="d-flex align-items-center small fm-md text-dark">
                                                                <span class="icon-right"></span>
                                                                {{ @$child['title'] }}
                                                            </a>
                                                            <ul class="p-0 m-0 sub-cat mt-2 ps-2">
                                                                @foreach ($child->childs as $childRowView)
                                                                    <li class="list-unstyled">
                                                                        <a href="{{ route('site.product.list', ['id' => @$childRowView->url]) }}"
                                                                            class="d-block fm-re ">
                                                                            {{ @$childRowView['title'] }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>

                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </li>
                    @if ($brandsCount > 0)
                        <li class="list-unstyled">
                            <a href="{{ route('site.brand.list') }}" class="text-dark small px-2"> برندها </a>
                        </li>
                    @endif
                    @if ($blogCount > 0)
                        <li class="list-unstyled">
                            <a href="{{ route('site.blog.cat') }}" class="text-dark small px-2"> دانستنی ها </a>
                        </li>
                    @endif
                    <li class="list-unstyled">
                        <a href="{{ route('site.contact') }}" class="text-dark small px-2"> تماس با ما </a>
                    </li>
                    <li class="list-unstyled">
                        <a href="{{ route('site.about') }}" class="text-dark small px-2"> درباره ما </a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-3 p-1 align-self-center">
                <ul class="d-flex align-items-center m-0 p-0 left justify-content-end">
                    <li class="list-unstyled">
                        <button type="button" class="border-0" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <img src="{{ asset('assets/site/images/icons/search.svg') }}" width="20" height="20"
                                alt="icon" title="icon" />
                        </button>
                    </li>
                    <li class="list-unstyled position-relative">
                        <a href="{{ route('site.cart.checkout') }}">
                            <img src="{{ asset('assets/site/images/icons/shopping-cart.svg') }}" width="20"
                                height="20" alt="icon" title="icon" />
                        </a>
                        <span class="bg-dark text-white span-cart"> @{{ cartTotal }}</span>
                    </li>
                    <li class="list-unstyled text-secondary">|</li>
                    <li class="list-unstyled">
                        @if (!\Auth::check())
                            <a href="{{ route('panel.log') }}" class="gap-1 px-2 d-flex align-items-center">
                                <img src="{{ asset('assets/site/images/icons/user.svg') }}" width="20"
                                    height="20" alt="icon" title="icon" />
                                <span class="d-lg-block d-none"> ثبت نام | ورود</span>
                            </a>
                        @else
                            <a href="{{ route('panel.dashboard') }}" class="gap-1 px-2 d-flex align-items-center">
                                <img src="{{ asset('assets/site/images/icons/user.svg') }}" width="20"
                                    height="20" alt="icon" title="icon" />
                                <span class="d-lg-block d-none">پروفایل</span>
                            </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
