<section class="discounts bg-b-light pt-5 pb-3 my-3">
    <div class="container">
        <div class="row w-100 m-0">
            <div class="col-md-3 col-sm-4 col-xs-6 align-self-center text-center p-1">
                <p class="h4 mb-5 text-center text-a ismb">
                {{@$setting_header->title_2}}xzzcxz
                </p>
                <div class="px-2">
                    @if(file_exists('assets/uploads/content/set/'.@$setting_header->special_img) && $setting_header->special_img != null)
                        <img src="{{asset('assets/uploads/content/set/'.@$setting_header->special_img)}} " class="w-100" loading="lazy">
                    @else

                        <img src="{{asset('assets/site/images/dis.png')}}" class="w-100" loading="lazy">
                    @endif
                </div>
                <a href="{{url('/incredible-offers')}}" class="btn btn-lg mt-5 w-100">
                    مشاهده همه
                </a>
            </div>
            <div class="col-md-9 col-sm-8 col-xs-6 align-self-center p-1">
                <div dir="rtl" class="swiper mySwiper-dis ">
                    <div class="swiper-wrapper ">
                        @foreach($timer_products as $timer)
                            <div class="swiper-slide">
                                <div class="item text-center">
                                    <a href="{{route('site.product.detail',['id'=>@$timer->url])}}">
                                        <div dir="ltr" id="timer" class="d-flex">
                                            <div id="day{{@$timer->id}}"></div>
                                            <div id="hour{{@$timer->id}}"></div>
                                            <div id="minute{{@$timer->id}}"></div>
                                            <div id="second{{@$timer->id}}"></div>
                                        </div>
                                        <div class="card px-2 py-4">
                                                  <figure>
                                                <div class="figure-inn">
                                                    @if(count($timer->variable) > 0)
                                                            <img src="{{@$timer->variable[0]->medium_image}}"
                                                                 alt="{!! @$timer->title !!}" loading="lazy">
                                                    @else

                                                            <img src="{{@$timer->medium_image}}" alt="{{@$timer->title}}"  loading="lazy">

                                                    @endif
                                                </div>
                                            </figure>
                                        </div>
                                        <div class="pt-3">
                                            <p class="h5 my-3 text-dark text-center">
                                                {!! @$timer->title !!}
                                            </p>
                                            @if(@$timer->calcute > 0)
                                                <del class="h5 my-3 text-danger ismb text-center">
                                                    {!! @$timer->price_first['old'] !!}
                                                </del>
                                            @endif
                                            <p class="h5 my-3 text-success ismb text-center">
                                                {!! @$timer->price_first['price'] !!}
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
{{--                <section id="demos">--}}
{{--                    <div class="row w-100 m-0">--}}
{{--                        <dssiv class="large-12 px-0 columns">--}}
{{--                            <div class="owl-carousel-dis owl-theme">--}}
{{--                                @foreach($timer_products as $timer)--}}
{{--                                    <div class="item text-center">--}}
{{--                                        <a href="{{route('sitddde.product.detail',['id'=>@$timer->url])}}">--}}
{{--                                            <div dir="ltr" id="timer" class="d-flex">--}}
{{--                                                <div id="day{{@$timer->id}}"></div>--}}
{{--                                                <div id="hour{{@$timer->id}}"></div>--}}
{{--                                                <div id="minute{{@$timer->id}}"></div>--}}
{{--                                                <div id="second{{@$timer->id}}"></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="card px-2 py-4">--}}
{{--                                                <figure>--}}
{{--                                                    <div class="figure-inn">--}}
{{--                                                        <img src="{{@$timer->pro_image}}"--}}
{{--                                                             alt="{!! @$timer->title !!}" loading="lazy">--}}
{{--                                                    </div>--}}
{{--                                                </figure>--}}
{{--                                            </div>--}}
{{--                                            <div class="pt-3">--}}
{{--                                                <p class="h5 my-3 text-dark text-center">--}}
{{--                                                    {!! @$timer->title !!}--}}
{{--                                                </p>--}}
{{--                                                @if(@$timer->calcute > 0)--}}
{{--                                                    <del class="h5 my-3 text-danger ismb text-center">--}}
{{--                                                        {!! @$timer->price_first['old'] !!}--}}
{{--                                                    </del>--}}
{{--                                                @endif--}}
{{--                                                <p class="h5 my-3 text-success ismb text-center">--}}
{{--                                                    {!! @$timer->price_first['price'] !!}--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </dssiv>--}}
{{--                    </div>--}}
{{--                </section>--}}
            </div>
            <script>
                @foreach($timer_products as $key => $timer)
                @if(@$timer->date > \Carbon\Carbon::now())
                const second{{@$timer->id}} = 1000,
                    minute{{@$timer->id}} = second{{@$timer->id}} * 60,
                    hour{{@$timer->id}} = minute{{@$timer->id}} * 60,
                    day{{@$timer->id}} = hour{{@$timer->id}} * 24;
                let countDown{{@$timer->id}} = new Date({{explode('-',@$timer->date)[0]}}, {{explode('-',@$timer->date)[1]}}, {{\Carbon\Carbon::parse(@$timer->date)->day}}, 0, 0, 0, 0).getTime(),
                    x{{@$timer->id}} = setInterval(function() {
                        let now{{@$timer->id}} = new Date().getTime(),
                            distance{{@$timer->id}} = countDown{{@$timer->id}} - now{{@$timer->id}};
                        document.getElementById("day{{@$timer->id}}").innerText = Math.floor(distance{{@$timer->id}} / (day{{@$timer->id}}));
                        document.getElementById("hour{{@$timer->id}}").innerText = Math.floor((distance{{@$timer->id}} % (day{{@$timer->id}})) / (hour{{@$timer->id}}));
                        document.getElementById("minute{{@$timer->id}}").innerText = Math.floor((distance{{@$timer->id}} % (hour{{@$timer->id}})) / (minute{{@$timer->id}}));
                        document.getElementById("second{{@$timer->id}}").innerText = Math.floor((distance{{@$timer->id}} % (minute{{@$timer->id}})) / second{{@$timer->id}});

                    }, 0)
                @endif
                @endforeach
            </script>
        </div>
    </div>
</section>
