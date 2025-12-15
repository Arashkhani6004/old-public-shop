@if ($timer_products->count() > 0)
    <div class="row w-100 m-0 p-0">
        @foreach ($timer_products as $row)
            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-4 col-6 p-sm-2 p-1">
                <a href="{{route('site.product.detail',['id'=>$row->url])}}" class="text-dark d-flex">
                    <div class="product-card row w-100 m-0 bg-white ">
                        <div class="col-md-12 p-0">
                                <img src="{{@$row->pro_image}}" alt="{{@$row->title}}"
                                    title="{{@$row->title}}" width="190" height="190" class="w-100 h-auto"
                                    loading="lazy" />
                        </div>
                        <div class="col-md-12 p-0">
                            <p class="m-0 fm-b text-start mt-2 title">
                                {{@$row->title}}
                            </p>
                            <div class=" mt-3 price text-end">
                                <p class="fm-eb m-0">{!! @$row->price_first['price'] !!} 
                                </p>
                                @if($row->calcute > 0)
                                    <div class="d-flex align-items-center justify-content-between text-end mt-1">
                                        <span class="discount fm-b">
                                            {{round(@$row->calcute)}}
                                            %
                                        </span>
                                        <del class="fm-re">{!! @$row->price_first['old'] !!}</del>
                                    </div>
                                @endif
                            </div>
                            @php
                                $date = \Carbon\Carbon::parse(@$row->date);
                            @endphp
                            <div class="d-flex align-items-center justify-content-between timer mt-3">
                                <ul class="p-0 m-0 d-flex align-items-center gap-1 countdown"
                                    data-date="{{ $date->format('m/d/Y H:i:s') }}">
                                    <li class="seconds fm-b"></li>
                                    :
                                    <li class="minutes fm-b"></li>
                                    :
                                    <li class="hours fm-b"></li>
                                    <li class="days fm-b">

                                    </li>
                                </ul>
                                <img src="{{ asset('assets/site/images/offer.svg') }}" width="24" height="24"
                                    alt="..." title="..." loading="lazy" />
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endif
