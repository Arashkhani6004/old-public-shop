<footer>
    <div class="container">
        <div class="row w-100 m-0">
            <div class="col-xl-4 col-lg-12 ps-0 mt-xl-0 mt-4 pe-xl-5 order-xl-1 order-2">
                <img src="{{ asset('assets/uploads/content/set/' . @$setting_header->logo) }}" width="80" loading="lazy" alt="{{ @$setting_header->title }}"
                    title="{{ @$setting_header->title }}" />
                <div class="about-us mt-5">
                    <p class="fm-b m-0">
                        {!! @$setting_header->h1 !!}
                    </p>
                    <p class="small fm-re mt-2">
                        {{@$setting_header->about2}}
                    </p>
                </div>
                <div class="socials mt-4">
                    <p class="fm-b m-0">شبکه های اجتماعی</p>
                    <ul class="p-0 m-0 d-flex align-items-center flex-wrap mt-3 gap-4">
                        @foreach($social_header as $row)
                        <li class="list-unstyled">
                            <a href="{{$row->address}}">
                                <img src="{{ asset('assets/site/images/socials/' . $row->icon . '.png') }}" width="26" height="26"
                                    alt="{{$row->icon}}" title="{{$row->icon}}" loading="lazy" />
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 p-2 col-md-6 order-xl-2 order-0">
                <div class="row w-100 m-0 links">
                    @if($category_footer->count() > 0)
                    <div class="col-6 p-2">
                        <p class="fm-b mb-2">دسته بندی محصولات</p>
                        <ul class="p-0 m-0">
                            @foreach($category_footers as $cat)
                            <li class="list-unstyled">
                                <a href="{{route('site.product.list',['id'=>$cat->url])}}">
                                    {{@$cat->title}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="col-6 p-2">
                        <p class="fm-b mb-2">دسترسی سریع</p>
                        <ul class="p-0 m-0">
                            <li class="list-unstyled">
                                <a href="/">
                                    صفحه اصلی
                                </a>
                            </li>
                            @if($blogCount > 0)
                            <li class="list-unstyled">
                                <a href="{{route('site.blog.cat')}}">
                                    دانستنی ها
                                </a>
                            </li>
                            @endif
                            @if($brandsCount > 0)
                            <li class="list-unstyled">
                                <a href="{{route('site.brand.list')}}">
                                    برند ها
                                </a>
                            </li>
                            @endif
                            <li class="list-unstyled">
                                <a href="{{route('site.contact')}}">
                                    تماس با ما
                                </a>
                            </li>
                            <li class="list-unstyled">
                                <a href="{{route('site.about')}}">
                                    درباره ما
                                </a>
                            </li>
                            @foreach($pages_menu as $page_menu)
                            <li class="list-unstyled">
                                <a href="{{route('site.page.detail',['id'=>@$page_menu->url])}}">
                                    {!! @$page_menu->title !!}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 p-0 mt-4">
                        <p class="fm-b mb-2">نمادها</p>
                        <ul class="d-flex align-items-center p-0 m-0 flex-wrap">
                            <li class="list-unstyled">
                                {!! @$setting_header->footer_enamd  !!}
                                {{-- <a href="#">
                                    <img src="{{ asset('assets/site/images/namad.png') }}" width="55" alt="..."
                                        title="..." loading="lazy" />
                                </a> --}}
                            </li>
                            <li class="list-unstyled">
                                {!! @$setting_header->code1  !!}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 p-2 mt-xl-0 mt-4 order-xl-3 order-0">
                <p class="fm-b mb-2">
                    راه های ارتباطی با ما
                </p>
                <ul class="p-0 m-0 mt-3 links">
                    @if($setting_header->contact != null)
                    <li class="list-unstyled small">
                        تلفن پشتیبانی :
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <a href="tel:{{@$setting_header->contact}}" class="d-block text-dark">
                                {{@$setting_header->contact}}
                            </a>
                        </div>
                    </li>
                    @endif
                    @if($setting_header->email != null)
                    <li class="list-unstyled small">
                        ایمیل :
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <a href="mailto:{{@$setting_header->email}}" class="d-block text-dark">
                                {{@$setting_header->email}}
                            </a>
                        </div>
                    </li>
                    @endif
                    @if($setting_header->phone != null)
                    <li class="list-unstyled small">
                        مشاوره :
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <a href="tel:{{@$setting_header->phone}}" class="d-block text-dark">
                                {{@$setting_header->phone}}
                            </a>
                        </div>
                    </li>
                    @endif
                    @if($setting_header->address != null)
                    <li class="list-unstyled small">
                        آدرس فروشگاه :

                        <div class="d-flex align-items-center gap-2">
                            <p class="m-0">
                                {{@$setting_header->address}}
                            </p>
                        </div>
                    </li>
                    @endif
                </ul>
                {{-- <a href="#" class="btn primary-btn d-flex align-items-center gap-2 w-max btn-sm rounded-3 px-2 mt-2">
                    <img src="{{ asset('assets/site/images/icons/location.png') }}" width="16" height="16"
                        alt="icon" title="icon" loading="lazy" />
                    مسیریابی روی نقشه
                </a> --}}
            </div>
        </div>
        <hr>
    </div>
</footer>
