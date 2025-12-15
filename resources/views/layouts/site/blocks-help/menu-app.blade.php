<section class="menu-app d-md-none d-block">
    <div class="back"></div>
    <div class="row w-100 m-0 align-items-center">
        <div class="col-3 p-2">
            <a href="/" class="d-flex align-items-center flex-column justify-content-center text-dark ">
                <img src="{{ asset('assets/site/images/icons/house.svg') }}" width="20" height="20" alt="icon"
                    title="icon" />
                <span class=""> خانه</span>
            </a>
        </div>
        <div class="col-3 p-2">
            <a href="" class="d-flex align-items-center flex-column justify-content-center text-dark active ">
                <div class="d-flex align-items-center flex-column justify-content-center position-relative">

                    <img src="{{ asset('assets/site/images/icons/shopping-cart.svg') }}" width="20" height="20"
                        alt="icon" title="icon" />
                    <span class="">سبد خرید</span>
                    <span class="bg-dark text-white span-cart">@{{ cartTotal }}</span>
                </div>
            </a>
        </div>

        <div class="col-3 p-2">
            <a href="" class="d-flex align-items-center flex-column justify-content-center text-dark ">
                <img src="{{ asset('assets/site/images/icons/phone-call.svg') }}" width="20" height="20"
                    alt="icon" title="icon" />
                <span class="">پشتیبانی</span>
            </a>
        </div>
        <div class="col-3 p-2">

            <a href="" class="d-flex align-items-center flex-column justify-content-center text-dark ">
                <img src="{{ asset('assets/site/images/icons/user-mobile.svg') }}" width="20" height="20"
                    alt="icon" title="icon" />
                <span class=""> ثبت نام | ورود</span>
            </a>

        </div>
    </div>
</section>
