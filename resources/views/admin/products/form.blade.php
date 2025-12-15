{{ csrf_field() }}
<div class="row w-100 m-0">
    <div class="col-lg-6 p-2 form-group">
        <label for="title" class="col-form-label">
            <span class="text-danger">*</span>عنوان فارسی :
        </label>
        <input id="title" name="title" type="text" class="form-control" value="@if(isset($data->title)){{ $data->title }}@else{{old('title')}} @endif">
        <label for="title_en" class="col-form-label">
            عنوان انگلیسی:
        </label>
        <input id="title_en" name="title_en" type="text" class="form-control" value="@if(isset($data->title_en)){{ $data->title_en }}@else{{old('title_en')}} @endif">
    </div>
    <div class="col-lg-6 form-group">
        <label for="title" class="col-form-label">h1</label>
        <input id="title" name="title2" type="text" class="form-control" value="@if(isset($data->title2)){{ $data->title2 }}@else{{old('title2')}} @endif">
        <label for="url" class="col-form-label">کنونیکال</label>
        <input id="url" name="keyword" type="text" class="form-control" value="@if(isset($data->keyword)){{ $data->keyword }}@else{{old('keyword')}} @endif">
    </div>
    <div class="col-lg-6 form-group">
        <label for="url" class="col-form-label"><span class="text-danger">*</span>url</label>
        <input name="url" type="text" class="form-control" onkeydown="replaceSpace(event)"  id="url" value="@if(isset($data->url)){{ $data->url }}@else{{old('url')}} @endif">
    </div>
    <div class="col-lg-6 form-group">
        @if(isset($data) && count($data->variable) > 0)
            @if (count($data->variable) > 0)
                <label for="url">موجودی : لطفا برای تغییر موجودی موجودی های متغیر هارو عوض کنید</label>
            @else
                <label for="url" class="col-form-label">موجودی</label>
            @endif
            <input id="url" name="count" type="text" class="form-control" value="@if(isset($data->count)){{ $data->count }}@else{{old('count')}} @endif" readonly="readonly">
        @else
            <label for="url" class="col-form-label">موجودی</label>
            <input id="url" name="count" type="text" class="form-control" value="@if(isset($data->count)){{ $data->count }}@else{{old('countt')}} @endif">
        @endif
    </div>
    <div class="col-lg-6 p-0 form-group">
        <div class="border p-1">
            <label for="brand_id" class="col-form-label">
                برند :
            </label>
            <div class="bg-light p-3">
                <input type="text" class="form-control mb-2" id="myInput2" onkeyup="myFunction2()" placeholder="جستجو ..">
                <div class="sd-checkbox">
                    <ul id="myUL2" class="p-0 m-0" style="list-style-type:none">
                        @foreach ($brands as $key => $row)
                            <li>
                                <label class="custom-ch">
                                    {{ $row['title'] }}
                                    <input type="radio" value="{{ $row['id'] }}" @if(isset($data->brand_id) && $data->brand_id == $row['id'])  checked="checked" @endif name="brand_id" class="form-control">
                                    <input class="leaflet-control-layers-selector"  type="radio" name="leaflet-base-layers"></input>
                                    <span class="checkmark" id="chek"></span>
                                </label>
                            </li>
                        @endforeach
                        <li>
                            <label class="custom-ch">
                                هیچکدام
                                <input type="radio" value="" name="brand_id" class="form-control">
                                <input class="leaflet-control-layers-selector" type="radio" name="leaflet-base-layers"></input>
                                <span class="checkmark" id="chek"></span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6  form-group">
        <div class="border p-1">
            <label for="category_id" class="col-form-label">
                <span class="text-danger">*</span>انتخاب دسته :
            </label>
            <div class="bg-light p-3">
                <input type="text" class="form-control mb-2" id="myInput" onkeyup="myFunction()" placeholder="جستجو ..">
                <div class="sd-checkbox ">
                    <ul id="myUL" class="p-0 m-0" style="list-style-type:none">
                        @foreach ($category as $key => $row2)
                            @php
                                $cat = \App\Models\Category::find($row2['id']);
                            @endphp
                            <li>
                                <label class="custom-ch">
                                    {{ $row2['title'] }}
                                    <input type="checkbox" value="{{ $row2['id'] }}" @if(isset($data) and in_array($row2['id'], $cat_pro)) checked="checked" @endif name="category_id[]" class="form-control" multiple @if (@$cat->childs && count(@$cat->childs) > 0) disabled @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 p-2 form-group">
    <div class="border p-1">
        <label class="col-form-label">
            اگر دسته انتخاب شده برای محصولتان دارای مشخصه نیست لطفا قیمت ها را پر کنید :
        </label>
        <div class="row w-100 m-0 bg-light p-2">
            @if(isset($data) && count($data->variable) > 0)
                <input name="old_price" type="hidden" class="form-control" value="@if(isset($data->old_price)){{ $data->old_price }}@else{{old('old_price')}} @endif">
                <input name="price" type="hidden" class="form-control" value="@if(isset($data->price)){{ $data->price }}@else{{old('price')}} @endif">
                <div class="col-lg-4 p-1 form-group">
                    <label for="old_price" class="col-form-label">
                        قیمت :‌
                    </label>
                    <input id="old_price" onkeyup="check()" name="old_price" type="text" class="form-control" value="@if(isset($data->old_price)){{ $data->old_price }}@else{{old('old_price')}} @endif" disabled>
                </div>
                <div class="col-lg-4 p-1 form-group">
                    <label for="max" class="col-form-label">
                        قیمت بعد تخفیف :‌
                    </label>
                    <input id="price" onkeyup="check()" name="price" type="text" class="form-control" value="@if(isset($data->price)){{ $data->price }}@else{{old('price')}} @endif" disabled>
                </div>
            @else
                <div class="col-lg-4 p-1 form-group">
                    <label for="old_price" class="col-form-label">
                        قیمت :‌
                    </label>
                    <input id="old_price" onkeyup="check()" name="old_price" type="text" class="form-control" value="@if(isset($data->old_price)){{ $data->old_price }}@else{{old('old_price')}} @endif">
                </div>
                <div class="col-lg-4 p-1 form-group">
                    <label for="max" class="col-form-label">
                        قیمت بعد تخفیف :‌
                    </label>
                    <input id="price" onkeyup="check()" name="price" type="text" class="form-control" value="@if(isset($data->price)){{ $data->price }}@else{{old('price')}} @endif">
                </div>
            @endif
            <div class="col-lg-4 p-1 form-group">
                <label for="max" class="col-form-label">
                    حداقل موجودی در انبار :
                </label>
                <input id="max" name="max" type="text" class="form-control" value="@if(isset($data->max)){{ $data->max }}@else{{old('max')}} @endif">
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 p-2">
    <div class="form-group">
        <label for="description">
            توضیحات :
        </label>
        <textarea class="form-control ckeditor" id="description" name="description" rows="3">@if(isset($data->description)){!! $data->description !!} @else{{old('description')}} @endif</textarea>
    </div>
</div>
<div class="col-lg-12 p-2 form-group">
    <div class="border p-1">
        <label for="category_id" class="col-form-label">
            انتخاب تگ :
        </label>
        <div class="bg-light p-3">
            <input type="text" class="form-control mb-2" id="myInputTag" onkeyup="myFunctionTag()" placeholder="جستجو ..">
            <div class="sd-checkbox ">
                <ul id="myULtag" class="p-0 m-0" style="list-style-type:none">
                    @foreach ($tags as $key => $row55)
                        <li>
                            <label class="custom-ch">
                                {{ $row55['title'] }}
                                <input type="checkbox" value="{{ $row55['id'] }}" @if(isset($data) and in_array($row55->id, $tas)) checked="checked" @endif name="tag_id[]" class="form-control" multiple>
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row w-100 m-0">
    <div class="col-lg-6 p-2 form-group">
        <label for="title_seo">
            عنوان سئو :
        </label>
        <input id="title_seo" name="title_seo" type="text" class="form-control" value="@if(isset($data->title_seo)){{ $data->title_seo }}@else{{old('title_seo')}} @endif">
        <label for="video_link">
            لینک آپارات :
        </label>
        <input id="video_link" name="video_link" type="text" class="form-control" value="@if(isset($data->video_link)){{ $data->video_link }}@else{{old('video_link')}} @endif">
    </div>
    <div class="col-lg-6 p-2 form-group">
        <label for="description_seo">توضیحات سئو:</label>
        <textarea class="form-control" id="description_seo" name="description_seo" rows="4">
            @if(isset($data->description_seo)){!! $data->description_seo !!}@else{{old('description_seo')}}@endif
        </textarea>
    </div>
</div>
<div class="row w-100 m-0">
    @include('admin.products.relate', ['datable_type' => 'App\Models\Product','edit' => isset($data) ? $data : false,])
    @include('admin.products.complement', ['datable_type' => 'App\Models\Product','edit' => isset($data) ? $data : false,])
</div>
<div class="row w-100 m-0">
    <div class="col-lg-3 col-xs-6 form-group">
        <label class="col-4 col-sm-12 col-form-label text-sm-right">
            فعال
        </label>
        <div class="col-12 col-sm-8 col-lg-6 pt-1">
            <div class="switch-button switch-button-yesno">
                <input type="checkbox" value="1" @if(isset($data->status) && $data->status == 1) checked="checked" @endif
                name="status" id="status">
                <span>
                <label for="status"></label>
            </span>
            </div>
        </div>
        <label class="col-12 col-sm-12 col-form-label text-sm-right">
            {{ @$setting_header->title_3 }}
        </label>
        <div class="col-12 col-sm-8 col-lg-6 pt-1">
            <div class="switch-button switch-button-yesno">
                <input type="checkbox" value="1" @if(isset($data->popular) && $data->popular == 1) checked="checked" @endif name="popular" id="popular">
                <span>
                <label for="popular"></label>
            </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-6 form-group">
        <label class="col-12 col-sm-12 col-form-label text-sm-right">
            {{ @$setting_header->title_2 }}
        </label>
        <div class="col-12 col-sm-8 col-lg-6 pt-1">
            <div class="switch-button switch-button-yesno">
                <input type="checkbox" value="1" @if(isset($data->special) && $data->special == 1) checked="checked" @endif name="special" id="special">
                <span>
                <label for="special"></label>
            </span>
            </div>
        </div>
        <label class="col-12 col-sm-8 col-form-label text-sm-right">
            {{ @$setting_header->title_1 }}
        </label>
        <div class="col-12 col-sm-8 col-lg-6 pt-1">
            <div class="switch-button switch-button-yesno">
                <input type="checkbox" value="1" @if(isset($data->newest) && $data->newest == 1) checked="checked" @endif name="newest" id="newest">
                <span>
                <label for="newest"></label>
            </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-6 form-group">
        <label class="col-12 col-sm-12 col-form-label text-sm-right">
            بزودی ...
        </label>
        <div class="col-12 col-sm-8 col-lg-6 pt-1">
            <div class="switch-button switch-button-yesno">
                <input type="checkbox" value="1" @if(isset($data->soon) && $data->soon == 1) checked="checked" @endif
                name="soon" id="soon">
                <span>
                <label for="soon"></label>
            </span>
            </div>
        </div>
        <label class="col-12 col-sm-12 col-form-label text-sm-right">
            غیر قابل فروش
        </label>
        <div class="col-12 col-sm-8 col-lg-6 pt-1">
            <div class="switch-button switch-button-yesno">
                <input type="checkbox" value="1" @if(isset($data->sell) && $data->sell == 1) checked="checked" @endif
                name="sell" id="sell">
                <span>
                <label for="sell"></label>
            </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 form-group">
        <label class="col-4 col-sm-12 col-form-label text-sm-right">
            ذخیره و ادامه ویرایش
        </label>
        <div class="col-12 col-sm-8 col-lg-6 pt-1">
            <div class="switch-button switch-button-yesno">
                <input type="checkbox" value="1" name="back" id="back">
                <span>
                <label for="back"></label>
            </span>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="form-group">
        <button type="submit" class="btn btn-space btn-success mx-0 mt-4 px-5">
            ذخیره
        </button>
    </div>
</div>
@section('js')
    <script>
        function replaceSpace(event) {
            // اگر دکمه Space زده شد
            if (event.key === " ") {
                event.preventDefault(); // جلوگیری از ورود Space
                const input = event.target;
                // درج "-" در محل مکان‌نما
                const start = input.selectionStart;
                const end = input.selectionEnd;
                input.value = input.value.substring(0, start) + '-' + input.value.substring(end);
                // مکان‌نما را به بعد از "-" ببرید
                input.setSelectionRange(start + 1, start + 1);
            }
        }
    </script>
    <script type="text/javascript">
        function myFunction() {
            var input, filter, ul, li, la, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                la = li[i].getElementsByTagName("label")[0];
                txtValue = la.textContent || la.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
    <script>
        function check() {
            let old_price = parseInt(document.getElementById('old_price').value);
            let price = parseInt(document.getElementById('price').value);
            if (price > old_price) {
                return sweetAlert("خطا", "مقدار قیمت بعد تخفیف باید کوچیک تر از قیمت باشد", "error");
            }
        }
    </script>
    <script type="text/javascript">
        function myFunction2() {
            var input, filter, ul, li, la, i, txtValue;
            input = document.getElementById("myInput2");
            filter = input.value.toUpperCase();
            var chek = document.getElementById('chek');

            ul = document.getElementById("myUL2");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                la = li[i].getElementsByTagName("label")[0];
                txtValue = la.textContent || la.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
    <script type="text/javascript">
        function myFunctionTag() {
            var input, filter, ul, li, la, i, txtValue;
            input = document.getElementById("myInputTag");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myULtag");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                la = li[i].getElementsByTagName("label")[0];
                txtValue = la.textContent || la.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
    <script type="text/javascript">
        $(function() {
            var opts = $('#optlist option').map(function() {
                return [
                    [this.value, $(this).text()]
                ];
            });
            $('#someinput').keyup(function() {
                var rxp = new RegExp($('#someinput').val(), 'i');
                var optlist = $('#optlist').empty();
                opts.each(function() {
                    if (rxp.test(this[1])) {
                        optlist.append($('<option/>').attr('value', this[0]).text(this[1]));
                    }
                });
            });
        });
    </script>
@endsection
