@if (count($product->variable) > 0)s
    <div class="preview col p-0 w-100">
        <div id="v-pills-tab" role="tablist" aria-orientation="vertical" class="nav nav-pills itemcolors">
            @foreach ($product->variable as $key => $v)
                <button style="display: none;" id="v-pills-{{ $v->id }}-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-{{ $v->id }}" type="button" role="tab"
                    aria-controls="v-pills-{{ $v->id }}"
                    aria-selected="@if ($key == 0) true @else false @endif"
                    class="btn nav-link rounded-0 border p-0 m-0 position-relative @if ($key == 0) active @endif"
                    style="width: 3rem !important;">Click me {{ $key }}</button>
            @endforeach
        </div>
        <div id="v-pills-tabContent" class="tab-content">
            @foreach ($product->variable as $key => $v)
                <div class="tab-pane fade @if ($key == 0) show active @endif"
                    id="v-pills-{{ $v->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $v->id }}-tab">
                    <div class="app-figure w-100 m-0" id="zoom-fig">
                        <a id="Zoom-{{ $v->id }}" class="MagicZoom w-100" href="{{ $v->big_image }}">
                            <img src="{{ $v->big_image }}?scale.height=400" alt="{{ @$product->title }}" width="auto"
                                height="auto" />
                        </a>
                        <div class="selectors">
                            <div class="scroll-menu">
                                @foreach ($v->images as $image)
                                    <div class="item rounded-3 border">
                                        <a data-zoom-id="Zoom-{{ $v->id }}" class="w-100 border-0"
                                            href="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}"
                                            data-image="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}">
                                            <div class="figure">
                                                <div class="figure-inn">
                                                    <img srcset="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}"
                                                        class="border-0 shadow-none"
                                                        src="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}" />
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>s
@else
    <div class="preview col p-0 w-100">
        <div class="app-figure p-0 m-0" id="zoom-fig">
            <a id="Zoom-1" class="MagicZoom my-3" href="{!! $product->pro_image !!}?h=1400"
                data-zoom-image-2x="{!! $product->pro_image !!}?h=2800" data-image-2x="{!! $product->pro_image !!}?h=800">
                <img src="{!! $product->pro_image !!}?h=400" srcset="{!! $product->pro_image !!}?h=800 2x"
                    alt="{!! $product->title !!}" />
            </a>
            <div class="selectors">
                <div class="scroll-menu">
                    @foreach ($product->images as $image)
                        <div class="item rounded-3 border">
                            <a data-zoom-id="Zoom-1"
                                href="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}?h=1400"
                                data-image="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}?h=400"
                                data-zoom-image-2x="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}?h=2800"
                                data-image-2x="{{ asset('assets/uploads/content/pro/big/' . @$image['file']) }}?h=800">
                                <img srcset="{{ asset('assets/uploads/content/pro/small/' . @$image['file']) }}?h=120 2x"
                                    src="{{ asset('assets/uploads/content/pro/small/' . @$image['file']) }}?h=60" />
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
