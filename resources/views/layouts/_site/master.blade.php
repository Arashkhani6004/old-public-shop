<!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('layouts._site.blocks.head')


<body style="min-height: 101vh;">
    @if($setting_header->modal_img != null || $setting_header->modal_mobile_img != null)
    @include('layouts._site.blocks.modal')
@endif
 {{-- <div style="
    background: white;
    inset: 0px;
    position: fixed;
    z-index: 9999;
    justify-content: center;
    align-items: center;s
    display: flex;
" id="loderPublic_Site">
                 <img width="300px" src="{{asset('assets/uploads/content/set/'.@$setting_header->logo)}}">
    </div> --}}
{!! @$setting_header->tagmanager !!}
	<div id="shop68" v-cloak>
		@include('layouts._site.blocks.menu')

		<!-- start content -->
		@yield('content')
		<!-- end content -->

		@include('layouts._site.blocks.footer')
	</div>
	@include('layouts._site.blocks.script')
    @include('layouts.message-swal')


@if (@$setting_header->icon_fix =='whatsapp')
<div class="icon-fix"  style="background: rgb(0, 255, 42);">
	<a href="whatsapp://send?phone={{@$setting_header->whatsapp}}" class="text-white">
        <i class="bi d-flex bi-whatsapp fs-2"></i>
    </a>
</div>
@elseif (@$setting_header->icon_fix =='instagram')
<div class="icon-fix" style="background:-webkit-linear-gradient(#4762d8, #da2981, #ffd369) !important">
	<a href="{{@$setting_header->whatsapp}}" class="text-white" target='_blank'rel="noopener noreferrer nofollow">
        <i class="bi bi-instagram d-flex fs-2"></i>
    </a>
</div>
@elseif (@$setting_header->icon_fix =='telegram')

<div class="icon-fix" style="background: rgb(0, 102, 255);" >
	<a href="{{@$setting_header->whatsapp}}" class="text-white" target='_blank'rel="noopener noreferrer nofollow">
        <i class="bi bi-telegram d-flex fs-2"></i>
    </a>
</div>
@elseif (@$setting_header->icon_fix =='ita')
<div class="icon-fix" style="background: #fff;" target='_blank'rel="noopener noreferrer nofollow">
	<a href="{{@$setting_header->whatsapp}}" class="text-white">
		<img class="w-100" src="{{asset('assets/_site/images/icon-ita.png')}}" alt="">
    </a>
</div>
@elseif (@$setting_header->icon_fix =='sorosh')
<div class="icon-fix" style="background: #fff;" target='_blank'rel="noopener noreferrer nofollow">
	<a href="{{@$setting_header->whatsapp}}" class="text-white">

		<img class="w-100" src="{{asset('assets/_site/images/icon-sorosh.png')}}" alt="">

    </a>
</div>
@elseif (@$setting_header->icon_fix =='bale')
<div class="icon-fix" style="background: #fff;" target='_blank'rel="noopener noreferrer nofollow">
	<a href="{{@$setting_header->whatsapp}}" class="text-white">

        <img class="w-100" src="{{asset('assets/_site/images/icon-bale.png')}}" alt="">

    </a>
</div>
@elseif (@$setting_header->icon_fix =='robika')

<div class="icon-fix">
	<a href="{{@$setting_header->whatsapp}}" class="text-white" target='_blank'rel="noopener noreferrer nofollow">
        <img class="w-100" src="{{asset('assets/_site/images/icon-robika.png')}}" alt="">
    </a>
</div>
@endif
<script>
    //swiper brands
var swiper = new Swiper(".mySwiper-brands", {
    slidesPerView: 8,
    grabCursor: true,
    breakpoints: {
        0: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
        576: {
            slidesPerView: 4,
            spaceBetween: 15,
        },
        768: {
            slidesPerView: 5,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 6,
            spaceBetween: 15,
        },
        1200: {
            slidesPerView: 8,
            spaceBetween: 15,
        },
    },
});
//swiper dis
var swiper = new Swiper(".mySwiper-dis", {
    loop:false,
    slidesPerView: 3,
    grabCursor: true,
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        576: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        992: {
            slidesPerView: 2.5,
            spaceBetween: 10,
        },
        1200: {
            slidesPerView: 3,
            spaceBetween: 7,
        },
    },
});
//swiper pro
var swiper = new Swiper(".mySwiper-pro", {
    loop:true,
    slidesPerView: 5,
    grabCursor: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    breakpoints: {
        0: {
            slidesPerView: 1.5,
            spaceBetween: 7,
        },
        576: {
            slidesPerView: 2.5,
            spaceBetween: 7,
        },
        768: {
            slidesPerView: 3.5,
            spaceBetween: 7,
        },
        992: {
            slidesPerView: 4.5,
            spaceBetween: 7,
        },
        1200: {
            slidesPerView: 5,
            spaceBetween: 7,
        },
    },
});
//swiper pro
var swiper = new Swiper(".mySwiper-pro1", {
    loop:true,
    slidesPerView: 5,
    grabCursor: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    breakpoints: {
        0: {
            slidesPerView: 1.5,
            spaceBetween: 7,
        },
        576: {
            slidesPerView: 2.5,
            spaceBetween: 7,
        },
        768: {
            slidesPerView: 3.5,
            spaceBetween: 7,
        },
        992: {
            slidesPerView: 4.5,
            spaceBetween: 7,
        },
        1200: {
            slidesPerView: 5,
            spaceBetween: 7,
        },
    },
});
//swiper pro
var swiper = new Swiper(".mySwiper-pro2", {
    loop:true,
    slidesPerView: 5,
    grabCursor: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    breakpoints: {
        0: {
            slidesPerView: 1.5,
            spaceBetween: 7,
        },
        576: {
            slidesPerView: 2.5,
            spaceBetween: 7,
        },
        768: {
            slidesPerView: 3.5,
            spaceBetween: 7,
        },
        992: {
            slidesPerView: 4.5,
            spaceBetween: 7,
        },
        1200: {
            slidesPerView: 5,
            spaceBetween: 7,
        },
    },
});
</script>
</body>

</html>
