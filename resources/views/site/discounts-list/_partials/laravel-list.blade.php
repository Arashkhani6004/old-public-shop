@if ($discounts_products->count() > 0)
    <div class="row w-100 m-0 p-0">
        @foreach ($discounts_products as $row)
            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-4 col-6 p-sm-2 p-1">
                <a href="{{ route('site.product.detail', ['id' => $row->url]) }}" class="text-dark d-flex">
                    <div class="product-card row w-100 m-0 bg-white ">
                        <div class="col-md-12 p-0">
                            @if (count($row->variable) > 0)
                                <img src="{{ @$row->variable[0]->medium_image }}" alt="{!! @$row->title !!}"
                                    title="{!! @$row->title !!}" width="190" height="190" class="w-100 h-auto"
                                    loading="lazy" />
                            @else
                                <img src="{{ @$row->medium_image }}" alt="{!! @$row->title !!}"
                                    title="{!! @$row->title !!}" width="190" height="190" class="w-100 h-auto"
                                    loading="lazy" />
                            @endif
                        </div>
                        <div class="col-md-12 p-0">
                            <p class="m-0 fm-b text-start mt-2 title">
                                {!! @$row->title !!}
                            </p>
                            @php
                                $old = isset($row->price_first['old'])
                                    ? (int) filter_var($row->price_first['old'], FILTER_SANITIZE_NUMBER_INT)
                                    : 0;
                                $new = isset($row->price_first['price'])
                                    ? (int) filter_var($row->price_first['price'], FILTER_SANITIZE_NUMBER_INT)
                                    : 0;
                            @endphp
                            <div class=" mt-3 price text-end">
                                <p class="fm-eb m-0">{{ number_format($new) }} <span>تومان</span>
                                </p>
                                @if (@$row->calcute > 0)
                                    <div class="d-flex align-items-center justify-content-between text-end mt-1">
                                        <span class="discount fm-b">
                                            {{ round((($old - $new) * 100) / $old) }}
                                            %
                                        </span>
                                        <del class="fm-re">{{ number_format($old) }}</del>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endif
