<div class="pro-info">
    <ul class="p-0 m-0">
        @if($product->brands)
        <li class="list-unstyled px-1 pb-3">
            <p class="h6 text-secondary">
                برند :
                <a href="{{route('site.brand.detail',['id'=>@$product->brands->url])}}" class="text-dark">
                    {{@$product->brands->title}}
                </a>
            </p>
        </li>
        @endif
         @if(!App\Library\Helper::isMobile())
        <li class="list-unstyled p-1 d-none d-md-block">
            <h1 class="h4 my-0 ismb">
                @if($product->title2) {{@$product->title2}} @else {{@$product->title}} @endif
            </h1>
        </li>
             @endif
        <li class="list-unstyled p-1">
            <h2 class="my-0 h6 my-0 text-secondary">
                {{@$product->title_en}}
            </h2>
        </li>
        <li class="list-unstyled p-0">
            <ul class="py-3 px-0 m-0">
                @foreach($top_properties as $top_prop)
                    @if(strlen($top_prop->description) > 2)
                        <li class="list-unstyled d-flex align-items-center p-1">
                            <span class="dot me-2"></span>
                            {!! @$top_prop->description !!}
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
        {{--        <li class="list-unstyled p-0">--}}
        {{--           <h2 class="h5 fw-bolder">انتخاب رنگ محصول : </h2>--}}
        {{--         <div class="nav nav-pills itemcolors">-->--}}
        {{--              <button type="button" class="nav-link rounded-0 border p-0 m-0 position-relative">--}}
        {{--                  <img src="{{asset('assets/site/images/1.jpg')}}" class="w-100 h-100">--}}
        {{--                   </button>-->--}}
        {{--                  <button type="button" class="nav-link rounded-0 border p-0 m-0 position-relative">--}}
        {{--                    <div class="position-relative">--}}
        {{--                     <img src="{{asset('assets/site/images/1.jpg')}}" class="w-100 h-100">--}}
        {{--                       <i class="bi bi-x-lg d-flex position-absolute top-0 bottom-0 end-0 start-0" style="font-size: 1.85rem; color: rgb(151, 151, 151);"></i>--}}
        {{--                      </div>--}}

        {{--                  </button>--}}
        {{--               </div>--}}
        {{--      </li>--}}
        <li class="list-unstyled pt-3 d-lg-block d-sm-none d-xs-none">
            @include('site.product.blocks.header.rate')
        </li>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title fw-bolder" id="exampleModalLabel">اشتراک گذاری در...</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-cemter justify-content-around">
                            <a href="https://t.me/share/url?url={{url('/pro/'.@$product->url)}}" class="text-a"
                               data-url="{{url('/pro/'.@$product->url)}}" rel="noopener noreferrer nofollow">
                                <i class="bi bi-telegram d-flex fs-5"></i>
                            </a>
                            <a href="https://www.instagram.com/?url={{url('/pro/'.@$product->url)}}"
                               rel="noopener noreferrer nofollow" class="text-a">
                                <i class="bi bi-instagram d-flex fs-5"></i>
                            </a>
                            <a href="whatsapp://send?text={{url('/pro/'.@$product->url)}}"
                               rel="noopener noreferrer nofollow" class="text-a">
                                <i class="bi bi-whatsapp d-flex fs-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </ul>
</div>
