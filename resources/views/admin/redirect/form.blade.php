<div class="row w-100 m-0">
    {{ csrf_field() }}

    <div class="col-lg-6 form-group">
        <label for="old_address" class="col-form-label">آدرس قدیمی</label>
        <input id="old_address" name="old_address" type="text" class="form-control" value="@if(isset($data->old_address)){{$data->old_address}}@endif">
    </div>
    <div class="col-lg-6 form-group">
        <label for="new_address" class="col-form-label">آدرس جدید</label>
        <input id="new_address" name="new_address" type="text" class="form-control" value="@if(isset($data->new_address)){{$data->new_address}}@endif">
    </div>
    <div class="col-lg-12 p-2">
        <div class="form-group">
            <button type="submit" class="btn btn-space btn-success m-0 px-5">ذخیره</button>
        </div>
    </div>
</div>

@section('js')

@endsection
