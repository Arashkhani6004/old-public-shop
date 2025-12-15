@extends('layouts.site.master-help')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/blog/detail.css') }}" />
@stop
@section('content')

    <div class="content mt-md-5 mt-3">
        <div class="container">
            <div class="row w-100 m-0">
                <div class="col-xl-3 col-lg-4 col-md-12 p-lg-2 p-1 sidebar d-lg-block d-none">
                    <div class="position-sticky">
                        <div class="img-header-inner">
                            <img src="{{ asset('assets/site/images/frame-blog.jpg') }}" class="w-100" alt="..."
                                title="...">
                        </div>
                        <div class="related-blog mt-4 ">
                            @include('help.blog-detail._partials.related-blog')
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-12 p-1">
                    @include('help.blog-detail._partials.header-inner')

                    <!-- description -->
                    @include('help.blog-detail._partials.description')
                    <!-- related blogs mobile -->
                    <div class="related-blog mt-4 d-lg-none d-block">
                        @include('help.blog-detail._partials.related-blog')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- comments -->
    <section class="comments mt-5">
        <div class="container">
            <div
                class="title-section position-relative mb-sm-5 mb-4 text-center col-xxl-5 col-xl-6 col-lg-7 col-md-12 m-auto p-0">
                <p class="fm-eb h2 mb-4 title">نظرات کاربران</p>
            </div>
            <div class="row w-100 m-0">
                <div class="col-xl-3 col-lg-4 col-md-5 p-1 pe-lg-2">
                    <form method="" action="" class="m-0">

                        @include('help.blog-detail._partials.comments.form')
                    </form>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7 p-1 ps-lg-2">

                    <div>
                        @include('help.blog-detail._partials.comments.main-comment')

                        @include('help.blog-detail._partials.comments.reply-comment')

                    </div>
                    <!-- reply form modal -->
                    @include('help.blog-detail._partials.comments.reply-modal')



                </div>
            </div>
        </div>
    </section>
@stop
