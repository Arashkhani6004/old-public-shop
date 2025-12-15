@if(count($slider)>0)
<div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($slider as $key=> $row)
            <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="{{$key}}" @if($key == 0) class="active" @endif aria-current="true" aria-label="Slide {{@$key+1}}"></button>
        @endforeach
    </div>
    <div class="carousel-inner sld">
        @foreach($slider as $key=> $row)
        <div class="carousel-item @if($key == 0)active @endif">
            <a @if(@$row->link != null) href="{{@$row->link}}" @endif>
               <img  class="w-100" src="{{@$row->coverImage}}"  alt="{{@$row->title}}" >
            </a>
        </div>
         @endforeach
        {{--@foreach($slider as $key=> $row)
            <a @if(@$row->link != null) href="{{@$row->link}}" @endif class="carousel-item @if($key == 0)active @endif" style="background-image: url('{{@$row->coverImage}}');"></a>

        @endforeach--}}
       
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
{{--<div class="sliderMobile">--}}
{{--    <div class="slider d-flex">--}}
{{--        <div class="w-100">--}}
{{--            <div id="carouselExampleIndicators1" class="carousel " data-bs-ride="carousel">--}}
{{--                <div class="carousel-indicators">--}}
{{--                    @foreach($mobiles as $key3 => $mobile)--}}
{{--                        <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="{{$key3}}" @if($key3==0) class="active" @endif aria-current="true" aria-label="Slide {{@$key+1}}"></button>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <div class="carousel-inner">--}}
{{--                    @foreach($mobiles as $key3 => $mobile)--}}
{{--                        <div class="carousel-item @if($key3 == 0) active @endif">--}}
{{--                            <img src="{{asset('assets/uploads/content/slider/'.@$slider->back_image)}}" class="d-block w-100" alt="{{$row->title}}" />--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="prev">--}}
{{--                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                    <span class="visually-hidden">Previous</span>--}}
{{--                </button>--}}
{{--                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="next">--}}
{{--                    <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                    <span class="visually-hidden">Next</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}sss
{{--</div>--}}
@endif