<div class="row w-100 m-0">
    {{ csrf_field() }}
    <div class="col-lg-4 form-group">
        <label for="title" class="col-form-label">عنوان</label>
        <input id="title" name="title" type="text" class="form-control"
            value="@if (isset($data->title)) {{ $data->title }} @endif">
    </div>
    <div class="col-lg-4 form-group">
        <label for="title" class="col-form-label">عنوان۲</label>
        <input id="title" name="title2" type="text" class="form-control"
            value="@if (isset($data->title2)) {{ $data->title2 }} @endif">
    </div>
    <div class="col-lg-4 form-group">
        <label for="title" class="col-form-label">url</label>
        <input id="url" name="url" type="text" class="form-control"
            value="@if (isset($data->url)) {{ $data->url }} @endif">
    </div>
    <div class="col-lg-4 form-group">
        <label for="title" class="col-form-label">کنونیکال</label>
        <input id="keyword" name="keyword" type="text" class="form-control"
            value="@if (isset($data->keyword)) {{ $data->keyword }} @endif">
    </div>
    <div class="col-lg-4 form-group">
        <label for="parent_id" class="col-form-label">دسته</label>
        <input id="someinput"> <select id="optlist" class="form-control" name="parent_id"
            value="@if (isset($data->parent_id)) {{ $data->parent_id }} @endif">
            <option value="">انتخاب دسته : </option>
            @foreach ($categories as $row)
                <option value="{{ $row['id'] }}"
                    @if (isset($data->parent_id)) @if ($data->parent_id == $row['id']) selected @endif @endif
                    >{{ $row['title'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-4 form-group">
        <label>تصویر کاور(آیکون وارد کنید) </label>

        <input class="form-control" type="file" name="cover">
        @if (isset($data->cover)) <img
                src="{{ asset('assets/uploads/content/cat/' . $data->cover) }}" style="height: 150px; width: 100%">
        @endif


    </div>
    <div class="col-lg-4 form-group">
        <label>تصویر داخل سایدبار </label>

        <input class="form-control" type="file" name="mega">
        @if (isset($data->mega)) <img
                src="{{ asset('assets/uploads/content/cat/' . $data->mega) }}" style="height: 150px; width: 100%">
        @endif


    </div>
    <div class="col-lg-4 form-group">
        <label>url  تصویر داخل سایدبار </label>
        <input id="mega_url" name="mega_url" type="text" class="form-control" value="@if (isset($data->mega_url)) {{ $data->mega_url }} @endif">
    </div>


    <div class="col-lg-12 p-2">
        <div class="form-group">
            <label>توضیحات</label>
            <textarea class="form-control ckeditor" type="text" name="description">
@if (isset($data->description)){!! $data->description !!}@endif
</textarea>
        </div>
    </div>

    <div class="col-lg-4 p-2">
        <div class="form-group">
            <label>توضیحات سئو</label>
            <textarea class="form-control" type="text" name="description_seo">
@if (isset($data->description_seo)){{ $data->description_seo }}@endif
</textarea>
        </div>
    </div>
    <div class="col-lg-4 p-2">
        <div class="form-group">
            <label>عنوان سئو</label>
            <input class="form-control" type="text" name="title_seo"
                value="@if (isset($data->title_seo)) {{ $data->title_seo }} @endif">
        </div>
    </div>
    <div class="col-lg-3 form-group">
        <label class="col-12 col-sm-3 col-form-label text-sm-right">
            نمایش در منو بالا
        </label>
        <div class="col-12 col-sm-8 col-lg-6 pt-1">
            <div class="switch-button switch-button-yesno">
                <input type="checkbox" value="1" @if (isset($data->show_menu) && $data->show_menu == 1) checked="checked" @endif
                    name="show_menu" id="show_menu">
                <span>
                    <label for="show_menu"></label>
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 form-group">
        <label class="col-12 col-sm-3 col-form-label text-sm-right">
            نمایش در فوتر
        </label>
        <div class="col-12 col-sm-8 col-lg-6 pt-1">
            <div class="switch-button switch-button-yesno">
                <input type="checkbox" value="1" @if (isset($data->show_footer) && $data->show_footer == 1) checked="checked" @endif
                    name="show_footer" id="show_footer">
                <span>
                    <label for="show_footer"></label>
                </span>
            </div>
        </div>
    </div>

    <div class="col-lg-3 form-group">
        <label class="col-12 col-sm-3 col-form-label text-sm-right">
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
    <div class="col-lg-3 form-group">
        <label class="col-12 col-sm-3 col-form-label text-sm-right">
            نمایش
        </label>
        <div class="col-12 col-sm-8 col-lg-6 pt-1">
            <div class="switch-button switch-button-yesno">
                <input type="checkbox" value="1" @if (isset($data->status) && $data->status == 1) checked="checked" @endif name="status" id="status">
                <span>
                    <label for="status"></label>
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-12 p-2">
        <div class="form-group">
            <button type="submit" class="btn btn-space btn-success m-0 px-5">ذخیره</button>
        </div>
    </div>
</div>

@section('js')
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
