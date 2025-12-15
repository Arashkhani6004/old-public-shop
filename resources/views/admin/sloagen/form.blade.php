<div class="row w-100 m-0">
	{{ csrf_field() }}
	<div class="col-lg-12 p-2 form-group m-0">
		<label for="title" class="col-form-label">عنوان</label>
		<textarea class="form-control" type="text" id="title" rows="1"   required oninvalid="swal('ارور',' وارد کردن عنوان اجباریست','error')" name="title">@if(isset($data->title)){{$data->title}}@endif</textarea>
	</div>
	<div class="col-lg-12 p-2 form-group m-0">
		<label for="image" class="col-form-label">تصویر</label>
		<input class="form-control" type="file" name="image">
		@if(isset($data->image))
		<img src="{{asset('assets/uploads/content/sloagen/'.$data->image)}}" class="w-100 my-1">
		@endif
	</div>
    <div class="col-lg- form-group">
        <label for="parent_id" class="col-form-label">دسته</label>
        <br>
        <input id="check-all"
               style="opacity: 1;position:static;"
               type="checkbox" class="me-1" />
        انتخاب همه
        <div class="bg-light p-3">
            <input type="text" class="form-control mb-2" id="myInput2" onkeyup="myFunction2()"
                   placeholder="جستجو ..">
            <div class="sd-checkbox">
                <ul id="myUL2" class="p-0 m-0" style="list-style-type:none">
                    @foreach ($categories as $key => $row)
                        <li>
                            <label class="custom-ch">
                                {{ $row['title'] }}
                                <input type="checkbox" value="{{ $row['id'] }}" @if (in_array($row['id'], $selectedCategories)) checked="checked" @endif name="category_id[]"
                                       class="form-control category-checkbox" multiple>
                                <input class="leaflet-control-layers-selector"
                                       name="leaflet-base-layers"></input>
                                <span class="checkmark" id="chek"></span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-12 p-2">
		<div class="form-group m-0">
			<button type="submit" class="btn btn-space btn-success m-0 px-5">ذخیره</button>
		</div>
	</div>
</div>

@section('js')
    <script>
        document.getElementById('check-all').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('.category-checkbox');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });
    </script>
@endsection
