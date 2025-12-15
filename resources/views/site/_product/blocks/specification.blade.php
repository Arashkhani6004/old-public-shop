@foreach($row->children as $item)

    <div class="form-check">
<label class="check-box" for="Check{{$item->id}}">
    {{$item->title}}
    <input  type="checkbox" value="{{$item->id}}"
        id="Check{{$item->id}}" @change="filterProducts()" v-model="selected2"
        name="Check{{$item->id}}">
    <span class="checkmark"></span>
</label>

    </div>
@endforeach
