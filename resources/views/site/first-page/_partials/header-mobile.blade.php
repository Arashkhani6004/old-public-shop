@if (count($mobiles['main']) > 0)
    <header class="mt-md-4 mt-3">
        <div class="container-fluid">
            <div id="carouselExampleIndicators-mobile" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true">
                <div class="carousel-indicators">
                    @foreach ($mobiles['main'] as $key => $row)
                        <button type="button" data-bs-target="#carouselExampleIndicators-mobile"
                            data-bs-slide-to="{{ $key }}"
                            @if ($key == 0) class="active" @endif aria-current="true"
                            aria-label="Slide{{ @$key + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($mobiles['main'] as $key => $row)
                        <div class="carousel-item @if ($key == 0) active @endif"
                            data-bs-interval="3500">
                            <a @if (@$row['link'] != null) href="{{ @$row['link'] }}" @endif class="d-block">
                                {{--                    mobile Slider --}}
                                <img src="{{ asset('assets/uploads/content/sli/' . @$row['image']) }}"
                                    class="d-block w-100 h-auto" alt="{{ @$row->title }}"
                                    title="{{ @$row->title }}" width="700" height="420">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </header>
@endif
