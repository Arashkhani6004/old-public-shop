<div class="row w-100 m-0">
    @if(count($product->variable) > 0 )
        <div class="col-xxl-8 col-lg-11 text-center mx-auto p-1">
            <del class="fw-bolder h2 my-1 text-secondary" v-if="variablePriceDiscount != 0">
                @{{variablePriceDiscount}} تومان
            </del>
            <p class="fw-bolder h2 my-1 text-b" v-if="variablePrice != 0">
                @{{variablePrice}} تومان
            </p>
            <p class="fw-bolder h2 my-1 text-b" v-else>
                @if($setting_header->product_button_text == 1)
                تماس بگیرید
            @else
                ناموجود
            @endif


            </p>
        </div>
S
        <div class="col-xxl-8 col-lg-11 text-center mx-auto p-1 ">
            <select  v-model="variableId" @change="changeVariables(variableId)" class="form-select" >
                @foreach($product->variable as $key=>$variable)
                    <option @if($key == 0) selected @endif value="{{$variable->id}}">
                        {{$variable->title}}
                    </option>
                @endforeach
            </select>
        </div>
    @else
       <div class="col-xxl-8 col-lg-11 text-center mx-auto p-1 ">
            @if($product->price !== 'ندارد' && $product->price !== null  && $product->price !== 0  && $product->count > 0)
                <del class="fw-bolder h2 my-1 text-secondary">
                    {{number_format(@$product->old_price)}}تومان
                </del>
                <p class="fw-bolder h2 my-1 text-b">
                    {{number_format(@$product->price)}}تومان
                </p>
            @elseif($product->old_price !== 'ندارد' && $product->count > 0 && $product->old_price != 0 )
            <p class="fw-bolder h2 my-1 text-b">
                {{number_format(@$product->old_price)}}تومان
            </p>
            @else
                <p class="ismb h2 my-1 text-b">
                    @if($setting_header->product_button_text == 1)
                تماس بگیرید
            @else
                ناموجود
            @endif
             
                </p>
            @endif
        </div>
    @endif
    <div class="col-12 p-1">
        <div class="input-number-box w-30 ">
            <div class="qty d-flex align-items-center rounded-0 border position-relative">
                <button @click="minusMe()" class="minus p-1 btn border border-bottom-0 border-start-0 border-top-0 rounded-0 text-dark bg-one h-100 d-flex align-items-center position-absolute top-0 start-0 bottom-0">
                    <i class="bi bi-dash d-flex"></i>
                </button>
                <input type="number" class="count form-control rounded-0 border-0 text-center mx-auto bg-transparent" id="quantity" name="quantity"
                       v-model="quantity" min="1">
                <button @click="plusMe()" class="plus p-1 btn border border-bottom-0 border-end-0 border-top-0 rounded-0 text-dark bg-one h-100 d-flex align-items-center position-absolute top-0 end-0 bottom-0">
                    <i class="bi bi-plus d-flex"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // $(document).ready(function() {
    //     $('.count').prop('disabled', true);
    //     $(document).on('click', '.plus', function() {
    //         console.log('hello');
    //         $('.count').val(parseInt($('.count').val()) + 1);
    //     });
    //     $(document).on('click', '.minus', function() {
    //         $('.count').val(parseInt($('.count').val()) - 1);
    //         if ($('.count').val() == 0) {
    //             $('.count').val(1);
    //         }
    //     });
    // });
</script>
