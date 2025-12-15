@if(count($sliders) > 0)
<div class="row w-100 m-0">
    @foreach($sliders as $row)
        <div class="col-xl-12 col-sm-6 col-xs-6 p-1">
            <div id="carouselExampleSlidesOnly1" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a @if(@$row->link != null) href="{{@$row->link}}" @endif>
                            <img src="{{$row->coverImage}}" class="w-100" style="height:max-content;" alt="{{@$row->title}}">
                        </a>
                    </div>
                    <div class="carousel-item ">
                        <a @if(@$row->link != null) href="{{@$row->link}}" @endif>
                            <img src="{{$row->coverImage}}" class="w-100" style="height:max-content;" alt="{{@$row->title}}">
                        </a>
                    </div>
                    {{--<a @if(@$row->link != null) href="{{@$row->link}}" @endif class="carousel-item active"
                       style="background-image: url({{$row->coverImage}});" loading="lazy"></a>
                    <a @if(@$row->link != null) href="{{@$row->link}}" @endif class="carousel-item"
                       style="background-image: url({{$row->coverImage}});" loading="lazy"></a>--}}
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif
