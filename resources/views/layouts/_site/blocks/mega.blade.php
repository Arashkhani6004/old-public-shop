<div class="mega-box overflow-auto shadow-sm" id="mega{{@$cat->id}}" style="max-height:400px;">
    <div class="row m-0 w-100">
        <div class="col-11 p-0">
            <ul class="mega-columcount list-unstyled">
                @foreach($cat->childs as $key=>$child)
                <li class="p-2">
                    <a href="{{route('site.product.list',['id'=>@$child->url])}}">
                        <p class="h5 mb-1 ismb mega-p-height p-1 text-dark d-flex align-items-center">
                            <i class="bi bi-chevron-left me-1 text-a"></i>
                            {{@$child['title']}}
                        </p>
                    </a>
                    @foreach($child->childs as $childRowView)

                    @if(count($childRowView->childs) > 0)

                    <a href="{{route('site.product.list',['id'=>@$childRowView->url])}}">
                        <p class="h5 mb-1 ismb p-1 text-dark d-flex align-items-center">
                            <i class="bi bi-chevron-left me-1 text-a"></i>
                            {{@$childRowView['title']}}
                        </p>
                    </a>
                    @else
                    <a href="{{route('site.product.list',['id'=>@$childRowView->url])}}"
                        class="text-c d-flex align-items-center">
                        <i class="bi bi-dot d-flex h4 my-0 text-a"></i>
                        {{@$childRowView['title']}}
                    </a>

                    @endif
                    @endforeach

                </li>

                @endforeach
            </ul>
        </div>
        <div class="col-1 p-0">
        </div>
    {{--        <div class="col-lg-3 img-mega p-1">--}}
    {{--            <a style="background-image: url('{{@$cat->cat_mega}}');"></a>--}}
    {{--        </div>--}}
    <div id="but{{@$cat->id}}" class="d-none m-auto me-0" style="
    position: sticky;
    height: 60px;
    width: max-content;
    border-radius: 5px;
    font-size: 13px;
    bottom: 0;
    z-index: 1;
    background: white;
    right: 0px;
" class="m-auto me-0 px-3 py-1 text-center">
        <p class="mb-1" style="
    font-size: 12px;
">اسکرول کنید</p>
        <i class="bi bi-arrow-down d-flex h5 m-auto"
            style="width: max-content;animation: scrolle_mega 2s infinite;"></i>
    </div>
</div>
        </div>
 