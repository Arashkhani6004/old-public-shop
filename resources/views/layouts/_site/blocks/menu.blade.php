<menu class="menu">
    <div class="d-lg-block d-none">
        <div class="w-100 bg-l">
            <div class="top bg-l py-1 container row mx-auto">
                <div class="col-lg-6 p-1">
                    <ul class="p-0 m-0">
                        <li class="list-unstyled float-start ms-4">
                            <a href="{{url('/')}}" class="d-flex align-items-center">
                                خانه
                            </a>
                        </li>
                        @if($brandsCount > 0)
                            <li class="list-unstyled float-start ms-4">
                                <a href="{{route('site.brand.list')}}" class="d-flex align-items-center">
                                    برندها
                                </a>
                            </li>
                        @endif
                        @if($blogCount > 0)
                            <li class="list-unstyled float-start ms-4">
                                <a href="{{route('site.blog.cat')}}" class="d-flex align-items-center">
                                    مقالات
                                </a>
                            </li>
                        @endif
                        <li class="list-unstyled float-start ms-4">
                            <a href="{{route('site.contact')}}" class="d-flex align-items-center">
                                تماس با ما
                            </a>
                        </li>
                        <li class="list-unstyled float-start ms-4">
                            <a href="{{route('site.about')}}" class="d-flex align-items-center">
                                درباره ما
                            </a>
                        </li>
                        @foreach($pages_menu as $page_menu)
                            <li class="list-unstyled float-start ms-4">
                                <a href="{{route('site.page.detail',['id'=>@$page_menu->url])}}"
                                   class="d-flex align-items-center">
                                    {!! @$page_menu->title !!}
                                </a>
                            </li>
                        @endforeach
                        <li class="list-unstyled float-start ms-4">
                            @if(!\Auth::check())
                                <a href="{{route('panel.log')}}" class="d-flex align-items-center">
                                    ثبت نام / ورود
                                    <i class="bi bi-person-circle d-flex ms-2 h5 my-0"></i>
                                </a>
                            @else
                                <a href="{{route('panel.dashboard')}}" class="d-flex align-items-center">
                                    داشبورد
                                    <i class="bi bi-person-circle d-flex ms-2 h5 my-0"></i>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 p-1">
                    <ul class="p-0 m-0 d-flex align-items-center justify-content-end">
                        <li class="list-unstyled float-end ms-4">
                            <a href="tel:{{@$setting_header->contact}}" class="d-flex align-items-center">
                                <i class="bi bi-telephone d-flex me-2 h5 my-0"></i>
                                {{@$setting_header->contact}}
                            </a>
                        </li>
                        <li class="list-unstyled float-end ms-4">
                            <a href="mailto:{{@$setting_header->email}}" class="d-flex align-items-center">
                                <i class="bi bi-envelope d-flex me-2 h5 my-0"></i>
                                {{@$setting_header->email}}
                            </a>
                        </li>

                        <li class="list-unstyled float-end ms-4">
                            <ul class="p-0 m-0 d-flex align-items-center menu-soshial-icon">
                                @foreach($social_header as $row)
                                    @if($row->icon == "sorosh")
                                        <li class="d-inline me-2">
                                            <a href="{{$row->address}}" class="d-flex align-items-center"
                                               target="_blank" rel=”nofollow”>
                                                <img class="" style="@if($setting_header->icon_filter != null) {{@$setting_header->icon_filter}} @else filter: brightness(0) saturate(100%) invert(24%) sepia(24%) saturate(3107%) hue-rotate(201deg) brightness(101%) contrast(106%); @endif" width="22px" height="22px" src="{{asset('assets/site/images/icon-sorosh.png')}}" alt="">
                                            </a>
                                        </li>
                                    @elseif($row->icon == "eitaa")
                                        <li class="d-inline me-2">
                                            <a href="{{$row->address}}" class="d-flex align-items-center"
                                               target="_blank" rel=”nofollow”>
                                                <img class="" height="22px" style="@if($setting_header->icon_filter != null) {{@$setting_header->icon_filter}} @else filter: brightness(0) saturate(100%) invert(24%) sepia(24%) saturate(3107%) hue-rotate(201deg) brightness(101%) contrast(106%); @endif" width="22px" src="{{asset('assets/site/images/icon-ita.png')}}" alt="">
                                            </a>
                                        </li>
                                    @elseif($row->icon == "bale")
                                        <li class="d-inline me-2">
                                            <a href="{{$row->address}}" class="d-flex align-items-center"
                                               target="_blank" rel=”nofollow”>
                                                <img class="" height="22px" style="@if($setting_header->icon_filter != null) {{@$setting_header->icon_filter}} @else filter: brightness(0) saturate(100%) invert(24%) sepia(24%) saturate(3107%) hue-rotate(201deg) brightness(101%) contrast(106%); @endif" width="22px" src="{{asset('assets/site/images/icon-bale.png')}}" alt="">
                                            </a>
                                        </li>
                                    @elseif($row->icon == "robika")
                                        <li class="d-inline me-2">
                                            <a href="{{$row->address}}" class="d-flex align-items-center"
                                               target="_blank" rel=”nofollow”>
                                                <img class="" style="@if($setting_header->icon_filter != null) {{@$setting_header->icon_filter}} @else filter: brightness(0) saturate(100%) invert(24%) sepia(24%) saturate(3107%) hue-rotate(201deg) brightness(101%) contrast(106%); @endif" width="22px" height="22px" src="{{asset('assets/site/images/icon-robika.png')}}" alt="">
                                            </a>
                                        </li>
                                    @elseif($row->icon == "instagram")
                                        <li class="d-inline me-2">
                                            <a href="{{$row->address}}" class="d-flex align-items-center"
                                               target="_blank" rel=”nofollow”>
                                                <img class="" style="@if($setting_header->icon_filter != null) {{@$setting_header->icon_filter}} @else filter: brightness(0) saturate(100%) invert(24%) sepia(24%) saturate(3107%) hue-rotate(201deg) brightness(101%) contrast(106%); @endif" width="22px" height="22px" src="{{asset('assets/site/images/icon-instagram-1.png')}}" alt="">
                                            </a>
                                        </li>
                                    @elseif($row->icon == "telegram")

                                        <li class="d-inline me-2">
                                            <a href="{{@$row->address}}" class="d-flex align-items-center"
                                               target="_blank" rel=”nofollow”>
                                                <img class="" style="@if($setting_header->icon_filter != null) {{@$setting_header->icon_filter}} @else filter: brightness(0) saturate(100%) invert(24%) sepia(24%) saturate(3107%) hue-rotate(201deg) brightness(101%) contrast(106%); @endif" width="22px" height="22px" src="{{asset('assets/site/images/icon-telegram-1.png')}}" alt="">
                                            </a>
                                        </li>
                                    @elseif($row->icon == "whatsapp")
                                        <li class="d-inline me-2">
                                            <a href="{{$row->address}}" class="d-flex align-items-center"
                                               target="_blank" rel=”nofollow”>
                                                <img class="" height="22px" style="@if($setting_header->icon_filter != null) {{@$setting_header->icon_filter}} @else filter: brightness(0) saturate(100%) invert(24%) sepia(24%) saturate(3107%) hue-rotate(201deg) brightness(101%) contrast(106%); @endif" width="22px" src="{{asset('assets/site/images/icon-watt-3.png')}}" alt="">
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="bottom container">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand " href="/">
                            <img src="{{asset('assets/uploads/content/set/'.@$setting_header->logo)}}"
                                alt="{{@$setting_header->title}}" class="">
                    </a>
                    <div class="container-fluid position-relative px-1">
                        

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav mx-auto my-0 align-self-center">
                                @foreach($category_footer as $cat)
                                    <li class="nav-item mega-nav" onmouseenter="handelMega({{@$cat->id}})">
                                        <a class="nav-link" href="{{route('site.product.list',['id'=>$cat->url])}}">
                                            {{@$cat->title}}
                                        </a>
                                        @include('layouts._site.blocks.mega')
                                    </li>
                                @endforeach
                            </ul>
                           
                        </div>
                       
                    </div>
                    <ul class="navbar-nav me-0 my-0">
                                <li class="nav-item ms-3 me-0">
                                    <!-- <a class="nav-link" href="#">
                                        <i class="bi bi-search"></i>s
                                    </a> -->
                                    <div class="searche-new">
                                        <!-- <center>
                                            <a href="javascript:void(0)" class="search-open nav-link">
                                                <i class="bi bi-search"></i>
                                            </a>
                                        </center>
                                        <div class="search-inline">
                                            <form>
                                                <input type="text" class="form-control"
                                                    placeholder="جستجو نام برند یا محصول ...">
                                                <button type="submit">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                                <a href="javascript:void(0)" class="search-close">
                                                    <i class="bi bi-x-lg"></i>
                                                </a>
                                            </form>
                                        </div> -->
                                        @include('layouts._site.blocks.searche-form')
                                    </div>
                                </li>
                                <li class="nav-item ms-3 me-0 bag-nav">
                                    <a class="nav-link position-relative" href="{{route('site.cart.checkout')}}">
                                        <i class="bi bi-handbag"></i>
                                        <span class="badge position-absolute">
													@{{ cartTotal }}
										</span>
                                    </a>
                                </li>
                            </ul>
                </nav>
        </div>
    </div>
    <div class="d-lg-none d-block">
        <div class="bg-l p-1 top container d-flex">
                    <ul class="px-0 py-1 m-0 d-flex align-items-center me-auto max-content">
                        <li class="d-inline me-3">
                            <a href="tel:{{@$setting_header->contact}}" aria-label="number">
                                <i class="bi bi-telephone text-b d-flex h4 my-0"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="px-0 py-1 m-0 d-flex align-items-center ms-auto max-content">
                        <li class="d-inline ms-3">
                            <a href="mailto:{{@$setting_header->email}}" aria-label="email">
                                <i class="bi bi-envelope text-b d-flex h4 my-0"></i>
                            </a>
                        </li>
                    </ul>
        </div>
        {{--        <div id="mySidenav" class="sidenav">--}}
        {{--            <a href="javascript:void(0)" class="closebtn p-0" onclick="closeNav()">--}}
        {{--                <i class="bi bi-x d-flex"></i>--}}
        {{--            </a>--}}
        {{--            @if(!\Auth::check())--}}
        {{--                <a href="{{route('panel.log')}}" class="d-flex">--}}
        {{--                    <i class="bi bi-person-circle d-flex me-2 h5 my-0"></i>--}}
        {{--                    ثبت نام / ورود--}}
        {{--                </a>--}}
        {{--            @else--}}
        {{--                <a href="{{route('panel.dashboard')}}" class="d-flex">--}}
        {{--                    <i class="bi bi-person-circle d-flex me-2 h5 my-0"></i>--}}
        {{--                    داشبورد--}}
        {{--                </a>--}}
        {{--            @endif--}}
        {{--            <div class="accordion" id="accordionSidnav">--}}
        {{--                @foreach($category_footer as $key=> $main)--}}
        {{--                    <div class="accordion-item">--}}
        {{--                        <p class="accordion-header" id="heading1{{$main->id}}">--}}
        {{--                            <button class="accordion-button collapsed d-flex" type="button" data-bs-toggle="collapse"--}}
        {{--                                    data-bs-target="#collapse1{{$main->id}}" aria-expanded="false"--}}
        {{--                                    aria-controls="collapse1{{$main->id}}">--}}
        {{--                                <i class="bi bi-box d-flex me-2 h5 my-0"></i>--}}
        {{--                                {{@$main->title}}--}}
        {{--                            </button>--}}
        {{--                        </p>--}}
        {{--                        <div id="collapse1{{$main->id}}" class="accordion-collapse collapse"--}}
        {{--                             aria-labelledby="heading1{{$main->id}}" data-bs-parent="#accordionSidnav">--}}
        {{--                            <div class="accordion-body">--}}
        {{--                                <div class="row w-100 m-0">--}}
        {{--                                    <a href="{{route('site.product.list',['id'=>$main->url])}}">--}}
        {{--                                        <p class="h5 mb-1 ismb p-1 text-dark d-flex align-items-center">--}}
        {{--                                            <i class="bi bi-chevron-left me-1 text-a"></i>--}}
        {{--                                            {{@$main->title}}--}}
        {{--                                        </p>--}}
        {{--                                    </a>--}}
        {{--                                    @foreach($main->childs as $child)--}}
        {{--                                        <div class="col-lg-4 p-1">--}}
        {{--                                            <a href="{{route('site.product.list',['id'=>$child->url])}}">--}}
        {{--                                                <p class="h5 mb-1 ismb p-1 text-dark d-flex align-items-center">--}}
        {{--                                                    <i class="bi bi-chevron-left me-1 text-a"></i>--}}
        {{--                                                    {{@$child->title}}--}}
        {{--                                                </p>--}}
        {{--                                            </a>--}}
        {{--                                            <ul class="p-0 m-0">--}}
        {{--                                                @foreach($child->childs as $item=>$cat)--}}
        {{--                                                    <li class="list-unstyled p-1">--}}
        {{--                                                        <a href="{{route('site.product.list',['id'=>$cat->url])}}"--}}
        {{--                                                           class="text-c d-flex align-items-center">--}}
        {{--                                                            <i class="bi bi-dot d-flex h4 my-0 text-a"></i>--}}
        {{--                                                            {{@$cat->title}}--}}
        {{--                                                        </a>--}}
        {{--                                                    </li>--}}
        {{--                                                @endforeach--}}
        {{--                                            </ul>--}}
        {{--                                        </div>--}}
        {{--                                    @endforeach--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                @endforeach--}}
        {{--            </div>--}}
        {{--            <a href="{{route('site.blog.cat')}}" class="d-flex">--}}
        {{--                <i class="bi bi-layout-text-window d-flex me-2 h5 my-0"></i>--}}
        {{--                مقالات--}}
        {{--            </a>--}}
        {{--            <a href="{{route('site.brand.list')}}" class="d-flex">--}}
        {{--                <i class="bi bi-layout-text-window d-flex me-2 h5 my-0"></i>--}}
        {{--                برندها--}}
        {{--            </a>--}}
        {{--            <a href="{{route('site.contact')}}" class="d-flex">--}}
        {{--                <i class="bi bi-headset d-flex me-2 h5 my-0"></i>--}}
        {{--                تماس با ما--}}
        {{--            </a>--}}
        {{--            <a href="{{route('site.about')}}" class="d-flex">--}}
        {{--                <i class="bi bi-info-circle d-flex me-2 h5 my-0"></i>--}}
        {{--                درباره ما--}}
        {{--            </a>--}}
        {{--        </div>--}}
        <div class="container py-2 row mx-auto">
                <div class="col-md-3 col-sm-3 col-xs-2 align-self-center px-1 py-0 bottom">
                        <ul class="m-0 p-0">
                            <li class="list-unstyled bag-nav text-end position-relative">
                                <a href="{{route('site.cart.checkout')}}" class="d-flex justify-content-start">
                                    <i class="bi bi-handbag text-b d-flex h4 my-0"></i>
                                    <span class="badge position-absolute">
                                        @{{ cartTotal }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-8 align-self-center text-center p-0">
                    <a href="/">
                            <img while="100" height="100" src="{{asset('assets/uploads/content/set/'.@$setting_header->logo)}}"
                            alt="{{@$setting_header->title}}" class="logomobile">
                    </a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-2 align-self-center text-end px-1 py-0 ">
                    <button class="btn opennav d-flex align-items-center justify-content-end px-0 ms-auto border-0" aria-hidden="menu" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample1"
                            aria-controls="offcanvasExample" id="menu-mobile" aria-label="menu">
                        <i class="bi bi-list d-flex"></i>
                    </button>
                    <div class="offcanvas offcanvas-end sidenav" tabindex="-1" id="offcanvasExample1"
                        aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body pb-5 mb-5 p-0">
                            @if(!\Auth::check())
                                <a href="{{route('panel.log')}}" class="d-flex">
                                    <i class="bi bi-person-circle d-flex me-2 h5 my-0"></i>
                                    ثبت نام / ورود
                                </a>
                            @else
                                <a href="{{route('panel.dashboard')}}" class="d-flex">
                                    <i class="bi bi-person-circle d-flex me-2 h5 my-0"></i>
                                    داشبورد
                                </a>
                            @endif
                            <div class="accordion" id="accordionSidnav">
                                @foreach($category_footer as $key=> $main)
                                    <div class="accordion-item bg-transparent border-0">
                                        <p class="accordion-header" id="heading1{{$main->id}}">
                                            <button class="accordion-button collapsed d-flex" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse1{{$main->id}}" aria-expanded="false"
                                                    aria-controls="collapse1{{$main->id}}">
                                                <i class="bi bi-box d-flex me-2 h5 my-0"></i>
                                                {{@$main->title}}
                                            </button>
                                        </p>
                                        <div id="collapse1{{$main->id}}" class="accordion-collapse collapse"
                                            aria-labelledby="heading1{{$main->id}}" data-bs-parent="#accordionSidnav">
                                            <div class="accordion-body">
                                                <div class="row w-100 m-0">
                                                    <a href="{{route('site.product.list',['id'=>$main->url])}}">
                                                        <p class="h5 mb-1 ismb p-1 text-dark d-flex align-items-center">
                                                            <i class="bi bi-chevron-left me-1 text-a"></i>
                                                            {{@$main->title}}
                                                        </p>
                                                    </a>
                                                    @foreach($main->childs as $child)
                                                        <div class="col-lg-4 p-1">
                                                            <a href="{{route('site.product.list',['id'=>$child->url])}}">
                                                                <p class="h5 mb-1 ismb p-1 text-dark d-flex align-items-center">
                                                                    <i class="bi bi-chevron-left me-1 text-a"></i>
                                                                    {{@$child->title}}
                                                                </p>
                                                            </a>
                                                            <ul class="p-0 m-0">
                                                                @foreach($child->childs as $item=>$cat)
                                                                    <li class="list-unstyled p-1">
                                                                        <a href="{{route('site.product.list',['id'=>$cat->url])}}"
                                                                            class="text-c d-flex align-items-center">
                                                                            <i class="bi bi-dot d-flex h4 my-0 text-a"></i>
                                                                            {{@$cat->title}}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{route('site.blog.cat')}}" class="d-flex">
                                <i class="bi bi-layout-text-window d-flex me-2 h5 my-0"></i>
                                مقالات
                            </a>
                            <a href="{{route('site.brand.list')}}" class="d-flex">
                                <i class="bi bi-layout-text-window d-flex me-2 h5 my-0"></i>
                                برندها
                            </a>
                            <a href="{{route('site.contact')}}" class="d-flex">
                                <i class="bi bi-headset d-flex me-2 h5 my-0"></i>
                                تماس با ما
                            </a>
                            <a href="{{route('site.about')}}" class="d-flex">
                                <i class="bi bi-info-circle d-flex me-2 h5 my-0"></i>
                                درباره ما
                            </a>
                            @foreach($pages_menu as $page_menu)
                            <a href="{{route('site.page.detail',['id'=>@$page_menu->url])}}" class="d-flex">
                                <i class="bi bi-layout-text-window d-flex me-2 h5 my-0"></i>
                                {!! @$page_menu->title !!}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    {{--                       <span class="opennav d-flex align-items-center justify-content-end ms-auto"--}}
                    {{--                             onclick="openNav()">--}}
                    {{--                        <i class="bi bi-list d-flex"></i>--}}
                    {{--                    </span>--}}
                </div>
                <div class="col-12 p-1">
                    <form method="GET" action="{{URL::action('Site\HomeController@getSearch')}}"class="m-0 h-100">
                        <input type="search" name="search" id=""
                                class="form-control form-control-sm rounded-3 input-mobile"
                                placeholder="نام محصول یا برند یا مقاله را بنویسید..."/>
                    </form>
                </div>
        </div>
    </div>
</menu>

<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content search-modal bg-transparent">
			<div class="modal-header border-0">
				<button type="button" class="btn btn-link text-white" data-bs-dismiss="modal" aria-label="Close">
					<i class="bi bi-x-lg"></i>
				</button>
			</div>
			<div class="modal-body d-flex align-items-center justify-content-center">
				<div class="col-xxl-5 col-xl-6 col-lg-7 m-auto p-1">
					<form method="GET" action="{{URL::action('Site\HomeController@getSearch')}}" class="m-0 position-relative">
						<input type="search" name="search" id="" class="form-control" placeholder="نام محصول یا برند یا مقاله را بنویسید..."/>
						<button type="submit" class="btn position-absolute top-0 bottom-0 end-0">
							<i class="bi bi-search d-flex"></i>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
