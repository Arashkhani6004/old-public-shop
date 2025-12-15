
@php
    $pro = \App\Models\Product::orderBy('sort','ASC')->get();
    $article = \App\Models\Content::article()->orderBy('id','DESC')->get();
    $datas = null;
    if($edit){
$pro = \App\Models\Product::orderBy('sort','ASC')->where('id','<>',$data->id)->get();
        $datas = \App\Library\Relate::relateData($edit->id,$datable_type);
}
@endphp

<input name="datable_type" type="hidden" value="{{$datable_type}}" />
<div class="col-lg-6 form-group">
    <div class="border p-1">
        <label for="category_id" class="col-form-label">
            مرتبط ها:
        </label>
        <div class="bg-light p-3">
            <input type="text" class="form-control mb-2" id="myInput3" onkeyup="myFunction3()" placeholder="جستجو ..">
            <div class="sd-checkbox">
                <ul id="myUL3" class="p-0 m-0" style="list-style-type:none">
                    @foreach($pro as $row)
                    <li>
                        <label class="custom-ch">
                            {{$row->title}}
                            <input type="checkbox" name="relates_ids[]" value="{{'App\Models\Product|'.$row->id}}" @if($datas && in_array('App\Models\Product|'.$row->id.'|1',$datas)) checked="checked" multiple @endif >
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    @endforeach
        {{--            @foreach($article as $row)--}}
        {{--            <li>--}}
        {{--                <label class="container-sd shadow-sm px-3" style="border-radius:2vh;">--}}
        {{--                    {{$row->title}}--}}
        {{--                    <input type="checkbox" name="relates_ids[]" value="{{'App\Models\Content|'.$row->id}}"--}}
        {{--                           @if($datas && in_array('App\Models\Content|'.$row->id,$datas))--}}
        {{--                           checked="checked"--}}
        {{--                        @endif>--}}
        {{--                    <span class="checkmark"></span>--}}
        {{--                </label>--}}
        {{--            </li>--}}
        {{--            @endforeach--}}
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function myFunction3() {

        var input, filter, ul, li, la, i, txtValue;
        input = document.getElementById("myInput3");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL3");
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
