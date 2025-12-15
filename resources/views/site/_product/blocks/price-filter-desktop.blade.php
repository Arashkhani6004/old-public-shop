<div class="price-range-block">
    <div class="py-1">
        <div class="row w-100 m-0">
            <div class="col-md-12 p-1">
                <div id="slider-range" class="price-filter-range" name="priceRange"></div>
                <div class="row w-100 mx-0 mt-3">
                    <div class="col-sm-6 col-xs-6 p-0">
                        <div class="row w-100 m-0">
                            <div class="col-xl-12 text-center align-self-center p-1">
                                <small class="m-0 text-secondary">
                                    تا
                                </small>
                            </div>
                            <div class="col-xl-12 align-self-center p-1">
                                <input type="number" min=0 max="10000000" oninput="validity.valid||(value='1000000');" id="max_price" class="price-range-field w-100 text-center rounded-custom border text-secondary" />
                            </div>
                            <div class="col-xl-12 text-center align-self-center p-1">
                                <small class="m-0 text-secondary">
                                    تومان
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6 p-0">
                        <div class="row w-100 m-0">
                            <div class="col-xl-12 text-center align-self-center p-1">
                                <small class="m-0 text-secondary">
                                    از
                                </small>
                            </div>
                            <div class="col-xl-12 align-self-center p-1">
                                <input type="number" min=0 max="10000000" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field w-100 text-center rounded-custom border text-secondary" />
                            </div>
                            <div class="col-xl-12 text-center align-self-center p-1">
                                <small class="m-0 text-secondary">
                                    تومان
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 p-1">
                <button type="submit" @click="filterProducts()" class="btn btn-success w-100 rounded-custom">
                    اعمال فیلتر
                </button>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script>
        // price range
        (function ($) {
            $("#min_price,#max_price").on('change', function () {
                $('#price-range-submit').show();
                var min_price_range = parseInt($("#min_price").val());
                var max_price_range = parseInt($("#max_price").val());
                if (min_price_range > max_price_range) {
                    $('#max_price').val(min_price_range);
                }
                $("#slider-range").slider({
                    values: [min_price_range, max_price_range]
                });
            });
            $("#min_price,#max_price").on("paste keyup", function () {
                $('#price-range-submit').show();
                var min_price_range = parseInt($("#min_price").val());
                var max_price_range = parseInt($("#max_price").val());
                if (min_price_range == max_price_range) {
                    max_price_range = min_price_range + 100;
                    $("#min_price").val(min_price_range);
                    $("#max_price").val(max_price_range);
                }
                $("#slider-range").slider({
                    values: [min_price_range, max_price_range]
                });
            });
            $(function () {
                $("#slider-range").slider({
                    range: true,
                    orientation: "horizontal",
                    min: 0,
                    max: {{$max != null ? @$max->old_price : 10000000}},
                    values: [0, {{$max != null ? @$max->old_price : 10000000}}],
                    step: 100,
                    slide: function (event, ui) {
                        if (ui.values[0] == ui.values[1]) {
                            return false;
                        }
                        $("#min_price").val(ui.values[0]);
                        $("#max_price").val(ui.values[1]);
                    }
                });
                $("#min_price").val($("#slider-range").slider("values", 0));
                $("#max_price").val($("#slider-range").slider("values", 1));
            });
            $("#slider-range,#price-range-submit").click(function () {
                var min_price = $('#min_price').val();
                var max_price = $('#max_price').val();
                $("#searchResults").text("Here List of products will be shown which are cost between " + min_price + " " + "and" + " " + max_price + ".");
            });
        })(jQuery);

        // price range
        (function ($) {
            $("#min_price_xs,#max_price_xs").on('change', function () {
                $('#price-range-submit').show();
                var min_price_xs_range = parseInt($("#min_price_xs").val());
                var max_price_xs_range = parseInt($("#max_price_xs").val());
                if (min_price_xs_range > max_price_xs_range) {
                    $('#max_price_xs').val(min_price_xs_range);
                }
                $("#slider-range-xs").slider({
                    values: [min_price_xs_range, max_price_xs_range]
                });
            });
            $("#min_price_xs,#max_price_xs").on("paste keyup", function () {
                $('#slider-range-xs').show();
                var min_price_xs_range = parseInt($("#min_price_xs").val());
                var max_price_xs_range = parseInt($("#max_price_xs").val());
                if (min_price_xs_range == max_price_xs_range) {
                    max_price_xs_range = min_price_xs_range + 100;
                    $("#min_price_xs").val(min_price_xs_range);
                    $("#max_price_xs").val(max_price_xs_range);
                }
                $("#slider-range-xs").slider({
                    values: [min_price_xs_range, max_price_xs_range]
                });
            });
            $(function () {
                $("#slider-range-xs").slider({
                    range: true,
                    orientation: "horizontal",
                    min: 0,
                    max: {{$max != null ? @$max->old_price : 10000000}},
                    values: [0, {{$max != null ? @$max->old_price : 10000000}}],
                    step: 100,
                    slide: function (event, ui) {
                        if (ui.values[0] == ui.values[1]) {
                            return false;
                        }
                        $("#min_price_xs").val(ui.values[0]);
                        $("#max_price_xs").val(ui.values[1]);
                    }
                });
                $("#min_price_xs").val($("#slider-range-xs").slider("values", 0));
                $("#max_price_xs").val($("#slider-range-xs").slider("values", 1));
            });
            $("#slider-range-xs,#price-range-submit").click(function () {
                var min_price_xs = $('#min_price_xs').val();
                var max_price_xs = $('#max_price_xs').val();
                $("#searchResults").text("Here List of products will be shown which are cost between " + min_price_xs + " " + "and" + " " + max_price_xs + ".");
            });
        })(jQuery);

    </script>
@stop

