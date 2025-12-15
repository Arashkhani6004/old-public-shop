@if($articles->count() > 0 || $article_s != null)sss
    <section class="blog py-5 container">
                <p class="h5 ismb text-a text-center my-5">
                    آخرین دانستنی ها
                </p>
            <div class="row w-100 m-0">
            @foreach($articles as $article)

                <div class="col-lg-3 col-sm-6 col-12 st p-2">
                    <a href="{{route('site.blog.detail',['id'=>@$article->id])}}">
                        <div class=" position-relative" >
                            <img loading="lazy" src="{{asset('assets/uploads/content/art/medium/'.$article->image)}}" alt="{!! @$article->title !!}" width="100%" height="100%" class="img-blog">
                            <div class="overlay">
                                <p class="m-0 text-c">
                                    {!! @$article->title !!}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                @if($article_s != null)
                <div class="col-lg-3 col-sm-6 col-12 st p-2">
                    <a href="{{route('site.blog.detail',['id'=>@$article_s->id])}}">
                        <div class=" position-relative">
                        <img loading="lazy" src="{{asset('assets/uploads/content/art/big/'.@$article_s->image)}}" alt="{!! @$article_s->title !!}" class="w-100">
                            <div class="overlay">
                                <p class="m-0 text-c">
                                    {!! @$article_s->title !!}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                    @endif
            </div>
    </section>
@endif

