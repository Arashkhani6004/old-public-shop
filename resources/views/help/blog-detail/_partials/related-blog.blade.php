@php
    $blogs = collect([
        (object)[
            'id' => 1,
            'title' => 'مقاله اول',
            'image' => 'blog1.jpg',
            'updated_at' => now(),
        ],
        (object)[
            'id' => 2,
            'title' => 'مقاله دوم',
            'image' => 'blog2.jpg',
            'updated_at' => now()->subDays(2),
        ],
    ]);
@endphp

@if ($blogs->count() > 0)
    <p class="fm-b text-dark mb-2">مقالات مرتبط</p>
    <ul class="p-0 m-0">
        @foreach ($blogs as $relate)
            <li class="list-unstyled related-item">
                <a href="#" class="row w-100 m-0">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-3 p-1 ">
                        <img src="{{ asset('assets/site/images/frame-blog.jpg') }}"
                            alt="{{ $relate->title }}" title="{{ $relate->title }}" loading="lazy" class="w-100">
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-12 col-9 p-1 align-self-center">
                        <p class="m-0 small fm-re text-dark">
                            {{ $relate->title }}
                        </p>
                        <small class="date fm-re">
                            {{ jdate('d F Y', $relate->updated_at->timestamp) }}
                        </small>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
@endif
