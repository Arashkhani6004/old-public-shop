<div class="row w-100 m-0">
    {{ csrf_field() }}

    <div class="col-lg-4 form-group">
        <label for="title" class="col-form-label">عنوان به انگلیسی</label>
        <input id="title" name="name" type="text" class="form-control" value="@if(isset($data->name)){{$data->name}}@endif">
    </div>

    <div class="col-lg-4 form-group">
        <label for="icon" class="col-form-label">
            آیکون :
        </label>
        <select class="form-control" id="icon" name="icon" value="@if(isset($data->icon)){{$data->icon}}@endif">
            <option value="instagram" @if(isset($data) && $data->icon=='instagram') selected @endif> instagram</option>
            <option value="telegram" @if(isset($data) && $data->icon=='telegram') selected @endif> telegram </option>
            <option value="whatsapp" @if(isset($data) && $data->icon=='whatsapp') selected @endif> whatsapp </option>
            <option value="twitter" @if(isset($data) && $data->icon=='twitter') selected @endif> twitter </option>
            <option value="bale" @if(isset($data) && $data->icon=='bale') selected @endif> bale</option>
            <option value="robika" @if(isset($data) && $data->icon=='robika') selected @endif> robika </option>
            <option value="eitaa" @if(isset($data) && $data->icon=='eitaa') selected @endif> eitaa </option>
            <option value="sorosh" @if(isset($data) && $data->icon=='sorosh') selected @endif> sorosh </option>
        </select>

    </div>
    <div class="col-lg-4 form-group">
        <label class="col-form-label"> آدرس </label>
        <input id="address" name="address" type="text" class="form-control" value="@if(isset($data->address)){{$data->address}}@endif">
    </div>

    <div class="col-lg-12 p-2">
        <div class="form-group">
            <button type="submit" class="btn btn-space btn-success m-0 px-5">ذخیره</button>
        </div>
    </div>
</div>

@section('js')

@endsection
