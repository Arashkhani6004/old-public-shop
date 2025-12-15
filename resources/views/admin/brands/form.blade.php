<script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js" charset="utf-8"></script>
{{ csrf_field() }}
<div class="row">
    <div class="col-lg-6 form-group">
        <label for="title" class="col-form-label">عنوان</label>
        <input id="title" name="title" type="text" class="form-control"
               value="@if(isset($data->title)){{$data->title}}@endif">
    </div>
    <div class="col-lg-6 form-group">
        <label for="title2" class="col-form-label">عنوان۲</label>
        <input id="title2" name="title2" type="text" class="form-control"
               value="@if(isset($data->title2)){{$data->title2}}@endif">
    </div>
    <div class="col-lg-6 form-group">
        <label for="url" required oninvalid="swal('ارور',' url اجباریست','error')" class="col-form-label">url</label>
        <input id="url" name="url" type="text" class="form-control"
               value="@if(isset($data->url)){{$data->url}}@endif">
    </div>
    <div class="col-lg-6 form-group">
        <label for="keyword" class="col-form-label">کنونیکال</label>
        <input id="keyword" name="keyword" type="text" class="form-control"
               value="@if(isset($data->keyword)){{$data->keyword}}@endif">
    </div>
    <div class="col-lg-4 form-group">
        <label>تصویر  </label>

        <input class="form-control" type="file" name="image" accept=".jpg">
        @if(isset($data->image)) <img src="{{asset('assets/uploads/content/brand/big/'.$data->image)}}" style="height: 150px; width: 100%"> @endif


    </div>

    <div class="form-group">
        <label for="description" class="col-form-label">توضیحات </label>
        <textarea class="form-control ckeditor" id="description" name="description" rows="3">
            @if(isset($data->description)){!!$data->description !!}@endif</textarea>
    </div>
    <div class="col-lg-6 form-group ">
        <label for="title_seo" class="col-form-label">عنوان سئو </label>
        <input id="title_seo" name="title_seo" type="text" class="form-control"
               value="@if(isset($data->title_seo)){{$data->title_seo}}@endif">
        <label for="tags" class="col-form-label">برچسب‌ها</label>
        <input type="text" class="form-control" name="tags" id="tags"
               value="@if(isset($data->tags)) @foreach($tag as $row2){{$row2->title}} @if(!$loop->last) , @endif @endforeach @endif">


    </div>
    <div class="col-lg-6 form-group">
        <label for="description_seo" class="col-form-label">توضیحات سئو</label>
        <textarea class="form-control" id="description_seo" name="description_seo" rows="4">
			@if(isset($data->description_seo)){!!$data->description_seo !!}@endif</textarea>
    </div>
    <div class="col-lg-3 form-group">
        <label class="col-12 col-sm-3 col-form-label text-sm-right">
            نمایش
        </label>
        <div class="col-12 col-sm-8 col-lg-6 pt-1">
            <div class="switch-button switch-button-yesno">
                <input type="checkbox" value="1" @if(isset($data->status) && $data->status == 1) checked="checked" @endif name="status" id="status">
                <span>
                    <label for="status"></label>
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
                <input type="checkbox" value="1" @if(isset($data->footer) && $data->footer == 1) checked="checked" @endif name="footer" id="footer">
                <span>
                    <label for="footer"></label>
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
    <div class="col-lg-12 p-2">
        <div class="form-group">
            <button type="submit" class="btn btn-space btn-success m-0 px-5">ذخیره</button>
        </div>
    </div>
</div>
@section('js')
    <script src="{{asset('assets/admin/js/selectize.js')}}"></script>
    <script>
        $( document ).ready(function() {
            $('#tags').selectize({
                plugins: ['remove_button'],
                delimiter: ',',
                persist: false,
                valueField: 'tag',
                labelField: 'tag',
                searchField: 'tag',
                create: function(input) {
                    return {
                        tag: input
                    }
                }
            });
        });
        var tags = [
                @foreach ($tag as $tags)
            {tag: "{{$tags}}" },
            @endforeach
        ];

    </script>
@endsection
