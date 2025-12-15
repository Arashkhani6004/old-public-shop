<div class="blogs">
    <div class="title-section mb-4 px-md-2 px-1">
        <p class="fw-bolder h5 mb-1 title">مطالب</p>
        <p class="font-th small op-lighter short-des">
            مطالب یافت شده مرتبط با "{{ @$search }}"
        </p>
    </div>
    <div class="row w-100 m-0">
        @foreach ($articles as $article)
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-6 p-md-2 p-1 mb-sm-0 mb-3">
                <a href="{{ route('site.blog.detail', ['id' => @$article->id]) }}" class="d-block">
                    <div class="blog-card">
                        <div class="position-relative">
                            <span class="cat">
                                {{ @$article->cat->title }}

                            </span>
                            <img src="{{ asset('assets/uploads/content/art/medium/' . $article->image) }}"
                                alt="{!! @$article->title !!}" title="{!! @$article->title !!}" class="w-100 h-auto "
                                width="450" height="300" loading="lazy" />
                        </div>

                        <p class="title m-0 mt-2 fm-b">
                            {!! @$article->title !!}
                        </p>
                        <div class="date d-flex align-items-center mt-3">
                            <i class="bi bi-calendar4-event d-flex me-1"></i>
                            <span class="fm-b">
                                {{ jdate('d F Y', @$article->updated_at->timestamp) }}
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
