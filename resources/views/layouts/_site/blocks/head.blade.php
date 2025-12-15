<head>

    {{--@if(Request::segment(1) == 'cat')
    script src="{{asset('assets/site/js/owlcarousel/jquery.min.js')}}" ></script>
    @endif--}}
{{--    <script src="{{asset('assets/site/js/owlcarousel/jquery.min.js')}}" ></script>--}}
    <script src="{{asset('assets/site/js/jquery.min.js')}}?v={{time()}}"></script>
    @if(Request::segment(1) == 'cat'|| Request::segment(1) == 'brand' || Request::segment(1) == 'all-products')
 <script src="{{asset('assets/site/js/jquery-ui.min.js')}}?v={{time()}}"></script>
    <script src="{{asset('assets/site/js/jquery.ui.touch-punch.min.js')}}?v={{time()}}"></script>
    @endif
    
   <script src="{{asset('assets/site/js/swiper-bundle.min.js')}}?v={{time()}}"></script>
    <script src="{{asset('assets/site/js/sweetalert.min.js')}}?v={{time()}}" async></script>

    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#d70a83" />
	<!--<link rel="shortcut icon" href="{{asset('assets/uploads/content/set/'.@$setting_header->favicon)}}"-->
	<!--	type="image/x-icon">-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/uploads/content/set/'.@$setting_header->favicon)}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/uploads/content/set/'.@$setting_header->favicon)}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/uploads/content/set/'.@$setting_header->favicon)}}">
	<title>
		@yield('title',@$setting_header->title)
	</title>
	@if(@$setting_header->noindex == 1)
	 <meta name="robots" content="@yield('robots','noindex,nofollow')" />
	 @else
	 @if($setting_header->park_domains !== null && in_array(request()->getHttpHost(),$setting_header->park_domains))
	 <meta name="robots" content="@yield('robots','noindex,nofollow')" />
	 @else
	  <meta name="robots" content="@yield('robots','index,follow')" />
	  @endif
	  @endif
	  
    @if($setting_header->head_enamd != null)
    <meta name="enamad" content="{{@$setting_header->head_enamd}}"/>
    @endif


	<meta name="description" content="@yield('description',@$setting_header->description_seo)" />
    <link rel="canonical" href="@yield('canonical',url()->current())"/>
	<meta property="og:site_name" content="@yield('title',@$setting_header->title)" />
	<meta property="og:title" content="@yield('title',@$setting_header->title)">
	<meta property="og:description" content="@yield('description',@$setting_header->description_seo)" />
	<meta property="og:locale" content="fa_ir" />
	<meta property="og:url" content="{{url()->current()}}" />
	<meta property="og:image" content="@yield('image_seo',asset('assets/uploads/content/set/'.@$setting_header->logo))" />
	<meta name="title" content="@yield('title',@$setting_header->title)">
    <meta property="og:type" content="@yield('og_type', 'website')" />
	<link rel="alternate" hreflang="fa-IR" href="{{url()->current()}}"/>
    @yield('torob')
    <link id="bootstrapCss" rel="stylesheet" href="{{asset('assets/site/css/bootstrap.rtl.min.css')}}?v={{time()}}"/>
       <link id="styleCss" rel="stylesheet" href="{{asset('assets/site/css/styleUpdated7.min.css')}}?v={{time()}}"/>
    <link id="style1Css" rel="stylesheet" href="{{asset('assets/site/css/style1.css')}}?v={{time()}}"/>
        <link id="style1Css" rel="stylesheet" href="{{asset('assets/site/css/bootstrap-icons.min.css')}}?v={{time()}}"/>
    <link rel="stylesheet" href="{{asset('assets/site/css/swiper-bundle.min.css')}}?v={{time()}}"/>

	<style>
	    :root {
            --bg-one: {{$setting_header->color1}};
            --bg-one-a: {{$setting_header->color3}};
            --bg-two: {{$setting_header->color2}};
            --bg-two-a: {{$setting_header->color4}};
            --breadcrumbColor: {{$setting_header->color5}} ;
        }
                 .mz-expand span a,.mz-expand div a{
    display: none !important;
    opacity: 0 !important;
}
         .mz-figure span a{
            opacity: 0 !important;
            display: none !important;
         }
         
         main .description table{
             text-align:right !important;
         }
         .description table caption{
             padding-top: inherit !important;
              padding-bottom: inherit !important;
              color: inherit !important;
         }
         .description .table > :not(caption) > * > *{
             padding:0.5rem 0.75rem !important;
         } 
	</style>

	<style>
	[v-cloak] {
		display: none
	}
    @media (max-width: 576px) {
        .icon-fix{
            bottom:5rem;
        }
    }
    .menu .top a {
  font-size: 11px !important;
}
	.MagicZoom figure div a {
		color: transparent !important;
		opacity: 0;
	}
	.mega-box::-webkit-scrollbar {
  display: none;
}
img{
    width: auto;
}
.breadcrumb a {
    font-size: 0.8rem;
    color: var(--breadcrumbColor)  !important; }
.breadcrumb-item.active{
    color: var(--breadcrumbColor) !important;
}
.menu-soshial-icon img{
    width: 22px !important;
    height: 22px !important;
}
.mega-box {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
        @keyframes scrolle_mega {
    0%{
        padding-top: 0px;
    }
    50%{
        padding-top: 10px;
    }
    100%{
        padding-top: 0px;
    }
}

.captchaImage img {
             width: 100%;
             height: 58px;
             border-radius: 0.75rem;

         }
	</style>
{!! @$setting_header->analytics !!}


    {{-- <script src="{{asset('assets/site/js/owlcarousel/owl.carousel.js')}}?v={{time()}}" ></script> --}}
    @yield('css')
    {{--    <script>
            let timeSetLink = 50;
    let linkCss = [
        {
            name:'bootstrapCss',
            link:`{{asset('assets/site/css/bootstrap.rtl.min.css')}}?v={{time()}}`
        },
            {
            name:'styleCss',
            link:`{{asset('assets/site/css/style.css')}}?v={{time()}}`
        },
            {
            name:'style1Css',
            link:`{{asset('assets/site/css/style1.css')}}?v={{time()}}`
        }
    ]
    linkCss.forEach((item) => {
        setTimeout(() => {
            let linkNodeHref = document.getElementById(item.name);
            linkNodeHref.href = item.link
        }, timeSetLink);
        timeSetLink += 50
    })
        </script> --}}
</head>
