<p class="fm-b d-flex align-items-center">
    <i class="bi bi-caret-left-fill fs-4 me-1 d-flex primary-color"></i>
    مشخصات {{ @$product->title }}
</p>

@if ($specifications->count() > 0 || $bottom_properties->count() > 0)
    <table class="table">
        <tbody>
            @if ($specifications->count() > 0)
                @if ($specifications->count() > 0)
                    @foreach ($types as $type)
                        @if ($type->view == 1)
                            <tr>
                                <th style="width: 15rem;" scope="row">
                                    {{ $type->title }}
                                </th>
                                <td>
                                    @foreach ($product_specifications as $product_specification)
                                        @if ($product_specification->product_specification_type_id == $type->id)
                                            {{ $product_specification->productSpecificationValue->title }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            @endif

            @if ($bottom_properties->count() > 0)
                @foreach ($bottom_properties as $bottom_prop)
                    <tr>

                        <td>

                            {!! $bottom_prop->description !!}

                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
@else
    <div class="col-xxl-1 col-xl-2 col-6 m-auto p-0">
        <img src="{{ asset('assets/site/images/empty-states/description-empty.png') }}" class="w-100" alt="empty"
            title="empty" loading="lazy" />
    </div>
    <p class="text-center text-dark small">
        مشخصه ای راجع به این محصول وجود ندارد!
    </p>
@endif
