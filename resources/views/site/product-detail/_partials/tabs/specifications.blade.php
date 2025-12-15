<p class="fm-b">
    مشخصات {{ @$product->title }}
</p>


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

            <tr>

                <td>
                    @foreach ($bottom_properties as $bottom_prop)
                        {!! $bottom_prop->description !!}
                    @endforeach
                </td>
            </tr>
            @endif

        </tbody>
    </table>
=
