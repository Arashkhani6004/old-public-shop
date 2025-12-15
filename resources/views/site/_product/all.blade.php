@extends('layouts._site.master')
@section('content')

    <main class="content">
        <div class="product pro-list">
            <div class="bg-b-light py-3">
                <div class="container">
                    <div class="row w-100 m-0">
                        <div class="col-sm-12 p-1 px-xs-2">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('/')}}">
                                            خانه
                                        </a>
                                    </li>



                                    <li class="breadcrumb-item active" aria-current="page">
                                        محصولات
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-sm-12 p-1 px-xs-2">
                            <div class="card rounded-custom border-0 p-md-4 p-sm-3 p-xs-1">
                                <h1 class="ismb text-a">
                                    لیست محصولات
                                </h1>

                                <div class="description text-secondary text-justify">

                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 p-0">
                            <div class="row w-100 m-0">
                                <!-- start mobile -->
                                <div class="col-sm-6 col-xs-6 px-2 py-1 d-md-none d-sm-block d-xs-block">
                                    @include('site.product.blocks.mobile.all.filtermodal')
                                </div>
                                <div class="col-sm-6 col-xs-6 px-2 py-1 d-md-none d-sm-block d-xs-block">
                                    @include('site.product.blocks.mobile.all.viewbymodal')
                                </div>
                                <!-- end mobile -->
                                <div class="col-xl-3 col-md-4 col-sm-5 p-1 d-md-block d-sm-none d-xs-none">
                                    <div class="sticky d-md-block d-sm-none d-xs-none">
                                        @include('site.product.blocks.all.sidebar')
                                    </div>
                                </div>
                                <div class="col-xl-9 col-md-8 col-sm-12 p-0">
                                    <div class="row w-100 m-0">
                                        <div class="col-sm-12 d-md-block d-sm-none d-xs-none p-1">
                                            <div class="card rounded-custom border-0 p-md-2 p-sm-2 p-xs-1 d-flex">
                                                <ul class="p-0 m-0">
                                                    <li class="d-inline float-start me-2 py-lg-0 py-sm-1">
                                                        <div
                                                                class="d-flex align-items-center border rounded-custom">
                                                            @include('site.product.blocks.all.viewby')
                                                        </div>
                                                    </li>
                                                    <li class="d-inline float-start me-2 py-lg-0 py-sm-1">
                                                        <div
                                                                class="d-flex align-items-center border rounded-custom">
                                                            @include('site.product.blocks.all.available')
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 p-1">
                                            <div class="card rounded-custom border-0 p-md-3 p-sm-2 m-xs-1 pro">
                                                <div class="row w-100 m-0">
                                                    <template v-if="loading2 === true">
                                                        <div class="col-sm-12 p-1">
                                                            <div class="p-md-0 p-sm-1 p-xs-1">
                                                                @include('site.product.blocks.all.loading')
                                                            </div>
                                                        </div>
                                                    </template>
                                                    <template v-if="loading2 === false">
                                                        <div class="col-xl-3 col-md-4 col-sm-4 col-xs-6 p-1" v-for="product in products">
                                                            @include('layouts._site.blocks.content.pro-box')
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@stop
