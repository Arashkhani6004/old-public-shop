<menu class="menu">
    <div class="d-lg-block d-md-none d-sm-none d-xs-none">
        <div class="top bg-l py-1">
            <div class="container">
                <div class="row w-100 m-0">
                    <div class="col-lg-6 p-1">
                        <ul class="p-0 m-0">
                            <li class="list-unstyled float-start ms-4">
                                <a href="" class="d-flex align-items-center">
                                    خانه
                                </a>
                            </li>
                            <li class="list-unstyled float-start ms-4">
                                <a href="" class="d-flex align-items-center">
                                    برندها
                                </a>
                            </li>
                            <li class="list-unstyled float-start ms-4">
                                <a href="" class="d-flex align-items-center">
                                    مقالات
                                </a>
                            </li>
                            <li class="list-unstyled float-start ms-4">
                                <a href="" class="d-flex align-items-center">
                                    تماس با ما
                                </a>
                            </li>
                            <li class="list-unstyled float-start ms-4">
                                <a href="" class="d-flex align-items-center">
                                    درباره ما
                                </a>
                            </li>
                            <li class="list-unstyled float-start ms-4">

                                    <a href="" class="d-flex align-items-center">
                                        ثبت نام / ورود
                                        <i class="bi bi-person-circle d-flex ms-2 h5 my-0"></i>
                                    </a>

                            </li>







                        </ul>
                    </div>
                    <div class="col-lg-6 p-1">
                        <ul class="p-0 m-0 d-flex align-items-center justify-content-end">
                            <li class="list-unstyled float-end ms-4">
                                <a href="tel:021-88684808" class="d-flex align-items-center">
                                    <i class="bi bi-telephone d-flex me-2 h5 my-0"></i>
                                    021-88684808
                                </a>
                            </li>
                            <li class="list-unstyled float-end ms-4">
                                <a href="mailto:info@rahweb.com" class="d-flex align-items-center">
                                    <i class="bi bi-envelope d-flex me-2 h5 my-0"></i>
                                    info@rahweb.com
                                </a>
                            </li>
                            <li class="list-unstyled float-end ms-4">
                                <ul class="p-0 m-0 d-flex align-items-center">

                                        <li class="d-inline me-2">
                                            <a href="" class="d-flex align-items-center" target="_blank">
                                                <i class="bi bi-telegram"></i>
                                            </a>
                                        </li>
                                    <li class="d-inline me-2">
                                        <a href="" class="d-flex align-items-center" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    </li>
                                    <li class="d-inline me-2">
                                        <a href="" class="d-flex align-items-center" target="_blank">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid position-relative px-1">
                        <a class="navbar-brand" href="/">
                            <img src="{{asset('assets/site/images/logo1.png')}}" alt="" class="">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav mx-auto my-0 align-self-center">

                                    <li class="nav-item mega-nav">
                                        <a class="nav-link" href="">
                                        نام دسته بندی
                                        </a>

                                        @include('layouts.site.blocks-help.mega')

                                    </li>
                                <li class="nav-item mega-nav">
                                    <a class="nav-link" href="">
                                        نام دسته بندی
                                    </a>

                                    @include('layouts.site.blocks-help.mega')

                                </li>
                                <li class="nav-item mega-nav">
                                    <a class="nav-link" href="">
                                        نام دسته بندی
                                    </a>

                                    @include('layouts.site.blocks-help.mega')

                                </li>
                                <li class="nav-item mega-nav">
                                    <a class="nav-link" href="">
                                        نام دسته بندی
                                    </a>

                                    @include('layouts.site.blocks-help.mega')

                                </li>


                            </ul>
                            <ul class="navbar-nav me-0 my-0">
                                <li class="nav-item ms-3 me-0">
                                    <!-- <a class="nav-link" href="#">
                                        <i class="bi bi-search"></i>
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
                                        @include('layouts.site.blocks-help.searche-form')
                                    </div>
                                </li>
                                <li class="nav-item ms-3 me-0 bag-nav">
                                    <a class="nav-link position-relative" href="">
                                        <i class="bi bi-handbag"></i>
                                        <span class="badge position-absolute">
													0
										</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="d-lg-none d-md-block d-sm-block d-xs-block">
        <div class="bg-l p-1 top">
            <div class="container">
                <div class="d-flex">
                    <ul class="px-0 py-1 m-0 d-flex align-items-center me-auto max-content">
                        <li class="d-inline me-3">
                            <a href="tel:">
                                <i class="bi bi-telephone text-b d-flex h4 my-0"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="px-0 py-1 m-0 d-flex align-items-center ms-auto max-content">
                        <li class="d-inline ms-3">
                            <a href="mailto:">
                                <i class="bi bi-envelope text-b d-flex h4 my-0"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn p-0" onclick="closeNav()">
                <i class="bi bi-x d-flex"></i>
            </a>

                <a href="" class="d-flex">
                    <i class="bi bi-person-circle d-flex me-2 h5 my-0"></i>
                    ثبت نام / ورود
                </a>

            <div class="accordion" id="accordionSidnav">

                    <div class="accordion-item">
                        <p class="accordion-header" id="heading1">
                            <button class="accordion-button collapsed d-flex" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="false"
                                    aria-controls="collapse1">
                                <i class="bi bi-box d-flex me-2 h5 my-0"></i>
                                نام دسته
                            </button>
                        </p>

                        <div id="collapse1" class="accordion-collapse collapse"
                             aria-labelledby="heading1 data-bs-parent="#accordionSidnav">
                            <div class="accordion-body">
                                <div class="row w-100 m-0">
                                    <a href="">
                                        <p class="h5 mb-1 ismb p-1 text-dark d-flex align-items-center">
                                            <i class="bi bi-chevron-left me-1 text-a"></i>
                                            نام محصول
                                        </p>
                                    </a>

                                        <div class="col-lg-4 p-1">
                                            <a href="">
                                                <p class="h5 mb-1 ismb p-1 text-dark d-flex align-items-center">
                                                    <i class="bi bi-chevron-left me-1 text-a"></i>
                                                    نام دسته
                                                </p>
                                            </a>
                                            <ul class="p-0 m-0">

                                                    <li class="list-unstyled p-1">
                                                        <a href=""
                                                           class="text-c d-flex align-items-center">
                                                            <i class="bi bi-dot d-flex h4 my-0 text-a"></i>
                                                           نام محصول
                                                        </a>
                                                    </li>

                                            </ul>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <a href="" class="d-flex">
                <i class="bi bi-layout-text-window d-flex me-2 h5 my-0"></i>
                مقالات
            </a>
            <a href="" class="d-flex">
                <i class="bi bi-layout-text-window d-flex me-2 h5 my-0"></i>
                برندها
            </a>

            <a href="" class="d-flex">
                <i class="bi bi-headset d-flex me-2 h5 my-0"></i>
                تماس با ما
            </a>
            <a href="" class="d-flex">
                <i class="bi bi-info-circle d-flex me-2 h5 my-0"></i>
                درباره ما
            </a>
        </div>
        <div class="container py-2">
            <div class="row w-100 m-0">
                <div class="col-md-3 col-sm-3 col-xs-3 align-self-center px-1 py-0">
                    <li class="list-unstyled text-end">
                        <a href="" class="d-flex justify-content-start">
                            <i class="bi bi-handbag text-b d-flex h4 my-0"></i>
                        </a>
                    </li>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-7 align-self-center p-0">
                    <a href="/">
                        <img src="{{asset('assets/site/images/logo1.png')}}" alt="" class="logomobile d-flex m-auto">
                    </a>

                </div>
                <div class="col-md-3 col-sm-3 col-xs-2 align-self-center text-end px-1 py-0">
                       <span class="opennav d-flex align-items-center justify-content-end ms-auto"
                             onclick="openNav()">
						<i class="bi bi-list d-flex"></i>
					</span>
                </div>
                <div class="col-12 p-1">
                    <form action="" class="m-0 h-100">
                        <input type="search" name="" id=""
                               class="form-control form-control-sm rounded-3 input-mobile"
                               placeholder="جستو نام محصول یا برند..." />
                    </form>
                </div>
            </div>
        </div>
    </div>
</menu>
