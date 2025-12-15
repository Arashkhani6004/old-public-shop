
{{--test--}}
{{--test2--}}
<footer id="footer" class="footer pb-xs-5 pb-sm-0">
    <div class="container">
        <div class="top">
            <div class="row w-100 m-0">
                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-12 p-0">
                    <div class="row w-100 m-0">
                        
                        @if($setting_header->contact != null)
                            <div class="col-xxl-4 col-xl-3 col-md-12 col-sm-3 col-xs-12 p-md-2 p-sm-0 p-xs-0">
                                <a href="tel:{{@$setting_header->contact}}">
                                    <div class="row w-100 m-0">
                                        <div
                                            class="col-xl-2 col-md-2 col-sm-3 col-xs-2 align-self-center text-center p-1">
                                            <i class="bi bi-telephone"></i>
                                        </div>
                                        <div class="col-xl-10 col-md-10 col-sm-9 col-xs-10 align-self-center p-1">
                                            <p class="text-white h6">
                                                تماس با پشتیبانی
                                            </p>
                                            <p class="text-white h6">
                                                {{@$setting_header->contact}}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if($setting_header->address != null)
                            <div class="col-xxl-8 col-xl-9 col-md-12 col-sm-9 col-xs-12 p-md-2 p-sm-0 p-xs-0">
                                <a >
                                    <div class="row w-100 m-0">
                                        <div
                                            class="col-xl-2 col-md-2 col-sm-2 col-xs-2 align-self-center text-center p-1">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                        <div class="col-xl-10 col-md-10 col-sm-10 col-xs-10 align-self-center p-1">
                                            <p class="text-white h6">
                                                آدرس  
                                            </p>
                                            <p class="text-white h6">
                                                {{@$setting_header->address}}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-12 p-0">
                    <div class="row w-100 m-0">
                        @if($setting_header->email != null)
                            <div class="col-xl-6 col-md-12 col-sm-6 col-xs-12 p-md-2 p-sm-0 p-xs-0">
                                <a href="mailto:{{@$setting_header->email}}">
                                    <div class="row w-100 m-0">
                                        <div
                                            class="col-xl-2 col-md-2 col-sm-2 col-xs-2 align-self-center text-center p-1">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                        <div class="col-xl-10 col-md-10 col-sm-10 col-xs-10 align-self-center p-1">
                                            <p class="text-white h6">
                                                ایمیل پشتیبانی
                                            </p>
                                            <p class="text-white h6">
                                                {{@$setting_header->email}}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if($setting_header->phone != null)
                            <div class="col-xl-6 col-md-12 d-md-block d-sm-none d-xs-none p-md-2 p-sm-0 p-xs-0">
                                <a href="tel:{{@$setting_header->phone}}">
                                    <div class="row w-100 m-0">
                                        <div
                                            class="col-xl-2 col-md-2 col-sm-2 col-xs-2 align-self-center text-center p-1">
                                            <i class="bi bi-headset"></i>
                                        </div>
                                        <div class="col-xl-10 col-md-10 col-sm-10 col-xs-10 align-self-center p-1">
                                            <p class="text-white h6">
                                                مشاوره
                                            </p>
                                            <p class="text-white h6">
                                                {{@$setting_header->phone}}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-xs-1 my-sm-2">
        <div class="">
            <div class="bottom">
                <div class="row w-100 m-0">
                    <div class="col-md-7 col-sm-12 p-0">
                        <div class="row w-100 m-0">
                            <div class="col-sm-3 col-xs-5 mx-auto p-2">
                                <p class="fw-bolder text-white h4">
                                    دسترسی سریع
                                </p>
                                <ul class="p-3">
                                    {{--									<li class="text-a">--}}
                                    {{--										<a href="" class="text-white">--}}
                                    {{--											تخفیف دارها--}}
                                    {{--										</a>--}}
                                    {{--									</li>--}}
                                    <li class="text-a">
                                        <a href="{{route('panel.log')}}" class="text-white">
                                            ورود
                                        </a>
                                    </li>
                                    <li class="text-a">
                                        <a href="{{route('panel.register')}}" class="text-white">
                                            ثبت نام
                                        </a>
                                    </li>
                                    <li class="text-a">
                                        <a href="{{route('site.rules')}}" class="text-white">
                                            قوانین و مقررات
                                        </a>
                                    </li>
                                    {{--									<li class="text-a">--}}
                                    {{--										<a href="" class="text-white">--}}
                                    {{--											راهنمای خرید--}}
                                    {{--										</a>--}}
                                    {{--									</li>--}}
                                    {{--									<li class="text-a">--}}
                                    {{--										<a href="" class="text-white">--}}
                                    {{--											پیگیری مرسوله پستی--}}
                                    {{--										</a>--}}
                                    {{--									</li>--}}
                                    <li class="text-a">
                                        <a href="{{route('site.about')}}" class="text-white">
                                            درباره ما
                                        </a>
                                    </li>
                                    <li class="text-a">
                                        <a href="{{route('site.contact')}}" class="text-white">
                                            تماس با ما
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            @if($category_footer->count() > 0)
                                <div class="col-sm-3 col-xs-5 mx-auto p-2">
                                    <p class="fw-bolder text-white h4">
                                        دسته بندی محصولات
                                    </p>
                                    <ul class="p-3">
                                        @foreach($category_footers as $cat)
                                            <li class="text-a">
                                                <a href="{{route('site.product.list',['id'=>$cat->url])}}"
                                                   class="text-white">
                                                    {{@$cat->title}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if($brands_footer->count() > 0)
                                <div class="col-sm-3 col-xs-6 mx-auto d-sm-block d-xs-none p-2">
                                    <p class="fw-bolder text-white h4">
                                        برندهای پرطرفدار
                                    </p>
                                    <ul class="p-3">
                                        @foreach($brands_footer as $br)
                                            <li class="text-a">
                                                <a href="{{route('site.brand.detail',['id'=>$br->url])}}"
                                                   class="text-white">
                                                    {{@$br->title}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if($pages_footer->count() > 0)
                                <div class="col-sm-3 col-xs-6 mx-auto d-sm-block d-xs-none p-2">
                                    <p class="fw-bolder text-white h4">
                                        امور مشتریان
                                    </p>
                                    <ul class="p-3">
                                        @foreach($pages_footer as $page)
                                            <li class="text-a">
                                                <a href="{{route('site.page.detail',['id'=>@$page->url])}}"
                                                   class="text-white">
                                                    {{@$page->title}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <hr class=" me-5 mt-0">
                        <ul class="p-0 mx-auto">
                            @foreach($social_header as $row)
                                @if($row->icon == "sorosh")
                                        <li class="list-unstyled m-2 icon-iran">
                                        <a href="{{@$row->address}}" class="bg-white d-flex p-2 rounded-3 " target='_blank' rel=”nofollow” aria-label="app sorosh">
                                            <img class="w-100" src="{{asset('assets/site/images/icon-sorosh.webp')}}" alt="سروش">
                                        </a>
                                    </li>
                                @elseif($row->icon == "eitaa")
                                     <li class="list-unstyled m-2 icon-iran">
                                        <a href="{{@$row->address}}" class="bg-white d-flex p-2 rounded-3 " target='_blank' rel=”nofollow” aria-label="app ita">
                                            <img class="w-100" src="{{asset('assets/site/images/icon-ita.webp')}}" alt="ایتا">
                                        </a>
                                    </li>
                                @elseif($row->icon == "bale")
                                            <li class="list-unstyled m-2 icon-iran">
                                        <a href="{{@$row->address}}" class="bg-white d-flex  p-2 rounded-3 " target='_blank' rel=”nofollow” aria-label="app bale">
                                            <img class="w-100" src="{{asset('assets/site/images/icon-bale.webp')}}" alt="بله">
                                        </a>
                                    </li>
                                @elseif($row->icon == "robika")
                                     <li class="list-unstyled m-2 icon-iran">
                                        <a href="{{@$row->address}}" class="bg-white d-flex  p-2 rounded-3 " target='_blank' rel=”nofollow” aria-label="app robika">
                                            <img class="w-100" src="{{asset('assets/site/images/icon-robika.webp')}}" alt="روبیکا">
                                        </a>
                                    </li>
                                @else
                                    <li class="list-unstyled icon m-2">
                                        <a href="{{@$row->address}}" class="bg-white d-flex p-2 rounded-3 {{@$row->icon}}" target='_blank' rel=”nofollow” aria-label="{{@$row->icon}}">
                                            <i class="bi h3 my-0 d-flex mx-0 bi-{{@$row->icon}}"></i>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-5 col-sm-12 p-2">
                        @if($setting_header->footer_enamd != null)
                            <ul class="p-0 m-0 namad">
                                <li class="bg-white p-1 rounded-3 d-flex">
                                    {!! @$setting_header->footer_enamd  !!}
                                    {{--                                <a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=222029&amp;Code=yRoAVqQgeZifzYKx9hzs"><img referrerpolicy="origin" src="{{asset('assets/site/images/nmd.jpg')}}" alt="" style="cursor:pointer" id="yRoAVqQgeZifzYKx9hzs"></a>--}}
                                </li>
                                <li class=" p-1 rounded-3 d-flex">
                                    {!! @$setting_header->code1  !!}
                                    {{--                                <a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=222029&amp;Code=yRoAVqQgeZifzYKx9hzs"><img referrerpolicy="origin" src="{{asset('assets/site/images/nmd.jpg')}}" alt="" style="cursor:pointer" id="yRoAVqQgeZifzYKx9hzs"></a>--}}
                                </li>
                            </ul>
                        @endif
                        <div class="description">
                            <p>
                                {{@$setting_header->about2}}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center px-2 py-3">
                        <p class="text-white h6">
                            توسعه و طراحی :
                            <a href="https://www.rahweb.com/" target="_blank"
                                class="text-a">
                                شرکت طراحی سایت ره وب
                            </a>
                        </p>
                         <p class="text-white">
                            کلیه حقوق مادی و معنوی این سایت برای {{@$setting_header->factor_name ? $setting_header->factor_name : $setting_header->title}} محفوظ می باشد و هرگونه کپی
                            برداری
                            پیگرد قانونی دارد
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>