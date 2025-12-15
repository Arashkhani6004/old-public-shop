<section class="discounts bg-b-light pt-5 pb-3 my-3">
    <div class="container">
        <div class="row w-100 m-0">
            <div class="col-md-3 col-sm-4 col-xs-6 align-self-center text-center p-1">
                <p class="h4 mb-5 text-center text-a ismb">
                    تخفیف دارها
                </p>
                <div class="px-2">
                    <img src="img/dis.png" class="w-100" loading="lazy">
                </div>
                <a href="" class="btn btn-lg mt-5 w-100">
                    مشاهده همه
                </a>
            </div>
            <div class="col-md-9 col-sm-8 col-xs-6 align-self-center p-1">
                <section id="demos">
                    <div class="row w-100 m-0">
                        <div class="large-12 px-0 columns">
                            <div class="owl-carousel-dis owl-theme">

                                    <div class="item text-center">
                                        <a href="{{url('/site-guide/pro/det')}}">
                                            <div dir="ltr" id="timer">
                                                <div class="number-list">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="days bg-light d-flex py-1 px-2 shadow-sm text-secondary" id="days{{@$timer->id}}"></span>
                                                        <div class="smalltext mx-1">:</div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="hours bg-light d-flex py-1 px-2 shadow-sm text-secondary" id="hours{{@$timer->id}}"></span>
                                                        <div class="smalltext mx-1">:</div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="minutes bg-light d-flex py-1 px-2 shadow-sm text-secondary" id="minutes{{@$timer->id}}"></span>
                                                        <div class="smalltext mx-1">:</div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="seconds bg-light d-flex py-1 px-2 shadow-sm text-secondary" id="seconds{{@$timer->id}}"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card px-2 py-4">
                                                <figure>
                                                    <div class="figure-inn">
                                                        <img src="{{asset('assets/site/images/products.png')}}" alt="" loading="lazy">
                                                    </div>
                                                </figure>
                                            </div>
                                            <div class="pt-3">
                                                <p class="h5 my-3 text-dark text-center">
                                                   نام
                                                </p>

                                                    <del class="h5 my-3 text-danger ismb text-center">
                                                    100،000 تومان
                                                    </del>

                                                <p class="h5 my-3 text-success ismb text-center">
                                                    200،000 تومان
                                                </p>
                                            </div>
                                        </a>
                                    </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <script>

                {{--const second{{@$timer->id}} = 1000,--}}
                {{--    minute{{@$timer->id}} = second{{@$timer->id}} * 60,--}}
                {{--    hour{{@$timer->id}} = minute{{@$timer->id}} * 60,--}}
                {{--    day{{@$timer->id}} = hour{{@$timer->id}} * 24;--}}
                {{--let countDown{{@$timer->id}} = new Date({{explode('-',@$timer->date)[0]}}, {{explode('-',@$timer->date)[1]}}, {{\Carbon\Carbon::parse(@$timer->date)->day}}, 0, 0, 0, 0).getTime(),--}}
                {{--    x{{@$timer->id}} = setInterval(function() {--}}
                {{--        let now{{@$timer->id}} = new Date().getTime(),--}}
                {{--            distance{{@$timer->id}} = countDown{{@$timer->id}} - now{{@$timer->id}};--}}
                {{--        document.getElementById("days{{@$timer->id}}").innerText = Math.floor(distance{{@$timer->id}} / (day{{@$timer->id}}));--}}
                {{--        document.getElementById("hours{{@$timer->id}}").innerText = Math.floor((distance{{@$timer->id}} % (day{{@$timer->id}})) / (hour{{@$timer->id}}));--}}
                {{--        document.getElementById("minutes{{@$timer->id}}").innerText = Math.floor((distance{{@$timer->id}} % (hour{{@$timer->id}})) / (minute{{@$timer->id}}));--}}
                {{--        document.getElementById("seconds{{@$timer->id}}").innerText = Math.floor((distance{{@$timer->id}} % (minute{{@$timer->id}})) / second{{@$timer->id}});--}}

                {{--    }, 0)--}}

            </script>
        </div>
    </div>
</section>
