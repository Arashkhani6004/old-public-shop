<div class="app-menu d-md-none d-sm-block d-xs-block py-2">
    <div class="row w-100 m-0">
        <div class="col-xs-4 col-sm-4 align-self-center">
            <a href="/">
                <div class="app-inn text-center d-flex flex-column justify-content-center align-items-center text-dark "
                     style="font-size: 12px">
                    <i class="bi bi-house  d-flex fs-3 mb-1 text-b"></i>
                     خانه
                </div>
            </a>
        </div>
        <div class="col-xs-4 col-sm-4 align-self-center">
            <a href="{{route('site.cart.checkout')}}">
                <div class="app-inn text-center d-flex flex-column justify-content-center align-items-center text-dark "
                     style="font-size: 12px">
                    <i class="bi bi-bag  text-b  d-flex fs-3 mb-1 "></i>
                    سبد خرید
                </div>
            </a>
        </div>
        <div class="col-xs-4 col-sm-4 align-self-center">
            @if(!\Auth::check())
                <a href="{{route('panel.log')}}" >
                    <div
                        class="app-inn text-center d-flex flex-column justify-content-center align-items-center  text-dark "
                        style="font-size: 12px">
                        <i class="bi bi-person d-flex fs-3 mb-1 text-b "></i>
                        ثبت نام | ورود
                    </div>
                </a>
            @else
                <a href="{{route('panel.dashboard')}}" >
                    <div
                        class="app-inn text-center d-flex flex-column justify-content-center align-items-center  text-dark "
                        style="font-size: 12px">
                        <i class="bi bi-person d-flex fs-3 mb-1 text-b "></i>
                        داشبورد
                    </div>
                </a>
            @endif
        </div>
    </div>
</div>
{{--  --}}