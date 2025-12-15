@if (count($product->variable) > 0 && $product->count > 0)
    <div class="d-flex align-items-center justify-content-lg-center gap-1">
        <div class="old-price" v-if="variablePriceDiscount != 0">
            <p class="m-0 fm-md">
                @{{ variablePriceDiscount }}
            </p>
        </div>
        <div class="off fm-li" v-if="(percent != '' )">
            % @{{ percent }}
        </div>
    </div>

    <p class="fm-b m-0 h4" v-if="variablePrice != 0">
        @{{ variablePrice }}
    </p>
@else
    @if (!empty($product->price) && is_numeric($product->price) && $product->price > 0 && $product->count > 0)
        <div class="d-flex align-items-center justify-content-lg-center gap-1">
            <div class="old-price fgdfdg">
                <p class="m-0 fm-md">
                    {{ number_format(@$product->old_price) }}
                </p>
            </div>
            @if (
                @$product->count &&
                    $product->count > 0 &&
                    @$product->price != null &&
                    @$product->price != 0 &&
                    $product->old_price != 0 &&
                    round(((@$product->old_price - @$product->price) / @$product->old_price) * 100) > 0)
                <div class="off fm-li">
                    % {{ round((($product->old_price - $product->price) * 100) / $product->old_price) }}
                </div>
            @endif
        </div>

        <p class="fm-b m-0 h4">
            {{ number_format((int) $product->price) }}
        </p>
    @elseif($product->old_price !== 'ندارد' && $product->count > 0 && $product->old_price != 0)
        <p class="fm-b m-0 h4">
            {{ number_format(@$product->old_price) }}
        </p>
    @else
        <p class="fm-b m-0 h4">
            @if ($setting_header->product_button_text == 1)
                تماس بگیرید
            @else
                ناموجود
            @endif
        </p>
    @endif

@endif
