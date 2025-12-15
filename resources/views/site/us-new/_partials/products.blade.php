<div class="products">
    <div class="title-section mb-4 px-md-2 px-1">
        <p class="fw-bolder h5 mb-1 title">محصولات</p>
        <p class="font-th small op-lighter short-des">
            محصولات یافت شده مرتبط با "{{ @$search }}"
        </p>
    </div>
    <div class="row w-100 m-0 lists">
        @foreach ($products as $row)
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 p-sm-2 p-1">
                <a href="{{ route('site.product.detail', ['id' => $row->url]) }}" class="text-dark d-flex">
                    <div class="product-card row w-100 m-0 bg-white ">
                        <div class="col-md-12 p-0">
                            @if (count($row->variable) > 0)
                                <img src="{{ $row->variable[0]->medium_image }}" alt="{{ @$row->title }}"
                                    title="{{ @$row->title }}" width="190" height="190" class="w-100 h-auto"
                                    loading="lazy" />
                            @else
                                <img src="{{ @$row->medium_image }}" alt="{{ @$row->title }}"
                                    title="{{ @$row->title }}" width="190" height="190" class="w-100 h-auto"
                                    loading="lazy" />
                            @endif
                        </div>
                        <div class="col-md-12 p-0">
                            <p class="m-0 fm-md text-start mt-2 title">
                                {{ @$row->title }}
                            </p>
                            @if (@$row->price != null && @$row->price != 0 && @$row->count > 0)
                                <div class="text-end mt-3 price">
                                    <p class="fm-eb m-0">{{ number_format(@$row->price) }}
                                        <span>تومان</span>
                                    </p>

                                    <div class=" text-end d-flex justify-content-between align-items-center mt-1">
                                        @if (@$row->price != null && @$row->price != 0 && @$row->old_price != 0 && @$row->count > 0)
                                            <span class="discount fm-b me-auto mt-auto">
                                                {{ round((($row->old_price - $row->price) * 100) / $row->old_price) }}%</span>
                                        @endif
                                        <del class="fm-re">{{ number_format(@$row->old_price) }}</del>
                                    </div>
                                </div>
                            @else
                                <div class="text-end mt-3 price">
                                    @if ($row->old_price == 0 || $row->count == 0)
                                        <p class="fm-eb m-0">تماس بگیرید</p>
                                    @else
                                        <p class="fm-eb m-0"> {{ number_format(@$row->old_price) }}
                                            <span>تومان</span>
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
