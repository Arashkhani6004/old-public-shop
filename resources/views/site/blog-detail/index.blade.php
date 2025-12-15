@extends('layouts.site.master')
@section('title'){{ @$blog->title_seo ? $blog->title_seo : $blog->title }} @stop
@section('image_seo'){{ @$blog->image ? asset('assets/uploads/content/art/big/' . $blog->image) : asset('assets/uploads/content/set/' . @$setting->logo) }}
@endsection
@section('og_type'){{ 'article' }}@stop

@section('canonical'){{ $blog->keyword ? $blog->keyword : trim(url()->current()) }}@stop

@section('description')
    @if ($blog->description_seo != null)
        {!! $blog->description_seo !!}
    @else
        {!! strip_tags(\Illuminate\Support\Str::limit($blog->description, 100)) !!}
    @endif
@stop
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
                            <img src="{{ asset('assets/uploads/content/art/big/' . $blog->image) }}" class=""
                                alt="{{ @$blog->title }}" title="{{ @$blog->title }}">
                        </div>
                        <div class="related-blog mt-4 ">
                            @include('site.blog-detail._partials.related-blog')
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-12 p-1">
                    @include('site.blog-detail._partials.header-inner')

                    <!-- description -->
                    @include('site.blog-detail._partials.description')
                    <!-- related blogs mobile -->
                    <div class="related-blog mt-4 d-lg-none d-block">
                        @include('site.blog-detail._partials.related-blog')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- comments -->
    <section class="comments">
        <div class="container">
            <div
                class="title-section position-relative mb-sm-5 mb-4 text-center col-xxl-5 col-xl-6 col-lg-7 col-md-12 m-auto p-0">
                <p class="fm-eb h2 mb-4 title">نظرات کاربران</p>
            </div>
            <div class="row w-100 m-0">
                <div class="col-xl-3 col-lg-4 col-md-5 p-1 pe-lg-2">
                    <form method="post" action="{{ URL::action('Site\HomeController@postComment') }}"
                        enctype="multipart/form-data" class="m-0">
                        {{ csrf_field() }}
                        <input type="hidden" name="commentable_id" value="{{ $blog->id }}">
                        <input type="hidden" name="commentable_type" value="{{ 'App\Models\Content' }}">
                        @include('site.blog-detail._partials.comments.form')
                    </form>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7 p-1 ps-lg-2">
                    @foreach ($comments as $comment)
                        <div>
                            @include('site.blog-detail._partials.comments.main-comment')
                            @foreach ($comment->replies as $reply)
                                @include('site.blog-detail._partials.comments.reply-comment')
                            @endforeach
                        </div>
                        <!-- reply form modal -->
                        @include('site.blog-detail._partials.comments.reply-modal')
                    @endforeach


                </div>
            </div>
        </div>
    </section>
@stop
