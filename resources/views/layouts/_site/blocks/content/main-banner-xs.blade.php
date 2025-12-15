<div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner sld-xs">
    @foreach($mobiles['main'] as $key=> $row)
        <!-- size : 700 * 810 -->
            <a @if(@$row['link'] != null) href="{{@$row['link']}}" @endif class="carousel-item @if($key == 0)active @endif" style="min-height: unset !important;">
                <img src="{{asset('assets/uploads/content/sli/'.@$row['image'])}}" class="w-100" alt="{{@$row->title}}" >
            </a>

            {{--            <div class="over position-absolute pt-3 pb-2 px-3">--}}
{{--                @if(\App\Library\Helper::isMobile())--}}

{{--                    <h1 class="ismb my-1 text-a">--}}
{{--                        {!! @$setting_header->h1 !!}--}}
{{--                    </h1>--}}
{{--                @endif--}}
{{--            </div>--}}
        @endforeach
    </div>
</div>
