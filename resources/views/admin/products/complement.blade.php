
@php
    $pro2 = \App\Models\Product::orderBy('sort','ASC')->get();
    $article = \App\Models\Content::article()->orderBy('id','DESC')->get();
    $datas = null;
    if($edit){
      $pro2 = \App\Models\Product::orderBy('sort','ASC')->where('id','<>',$data->id)->get();
        $datas = \App\Library\Relate::relateData($edit->id,$datable_type);
    }
@endphp

<input name="datable_type" type="hidden" value="{{$datable_type}}" />
<div class="col-lg-6 form-group">
    <div class="border p-1">
        <label for="category_id" class="col-form-label">
            مکمل ها:
        </label>
        <div class="bg-light p-3">
            <input type="text" class="form-control mb-2" id="myInput12" onkeyup="myFunction12()" placeholder="جستجو ..">
            <div class="sd-checkbox">
                <ul id="myUL12" class="p-0 m-0" style="list-style-type:none">

                    <li class="d-none">
                        <label class="custom-ch">

                            <input type="hidden" name="comps_ids[]" value="{{'App\Models\Product|-1'}}" checked="checked" multiple >
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    @foreach($pro2 as $row6)
                        <li>
                            <label class="custom-ch">
                                {{$row6->title}}
                                <input type="checkbox" name="comps_ids[]" value="{{'App\Models\Product|'.$row6->id}}" @if($datas && in_array('App\Models\Product|'.$row6->id.'|2',$datas)) checked="checked" multiple @endif >
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function persianToEnglish(str) {
        const persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g];
        const englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        for (let i = 0; i < persianNumbers.length; i++) {
            str = str.replace(persianNumbers[i], englishNumbers[i]);
        }
        return str;
    }

    function myFunction12() {
        var input = document.getElementById("myInput12");
        var filter = persianToEnglish(input.value).toUpperCase(); 
        var ul = document.getElementById("myUL12");
        var li = ul.getElementsByTagName("li");

        for (var i = 0; i < li.length; i++) {
            var la = li[i].getElementsByTagName("label")[0];
            var txtValue = la.innerText || la.textContent;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";  
            } else {
                li[i].style.display = "none";  
            }
        }
    }
</script>

