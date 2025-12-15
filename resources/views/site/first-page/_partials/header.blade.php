@if (count($sliders) > 0)
    <header class="mt-md-4 mt-3">
        <div class="container-fluid">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($sliders as $key => $row)
                        <button type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to="{{ $key }}"
                            @if ($key == 0) class="active" @endif aria-current="true"
                            aria-label="Slide{{ @$key + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($sliders as $key => $row)
                        <div class="carousel-item @if ($key == 0) active @endif"
                            data-bs-interval="3500">
                            <a @if (@$row->link != null) href="{{ @$row->link }}" @endif class="d-block">
                                {{--                    desktop Sliders --}}
                                <img src="{{ @$row->coverImage }}" class="d-block w-100 h-auto d-lg-block d-none"
                                    alt="{{ @$row->title }}" title="{{ @$row->title }}" width="1920" height="2500">
                            </a>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev d-md-flex d-none" type="button"
                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next d-md-flex d-none" type="button"
                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </header>
@endif
