{{ csrf_field() }}
<div class="box-body">
    <div class="form-group">
        <hr>
        <div class="row w-100 m-0">
            @foreach($fields as $key=>$row)
                <input name="spf_id[{{$row->id}}]" value="{{$row->id}}" type="hidden" />
                <div class="col-lg-6 col-sm-12 col-xs-12 p-2">
                    <label for="title" class="col-form-label py-0" style="font-size: 16px;">
                        مشخصه  {{$row->title}} :
                    </label>
                    <div class="bg-light p-3">
                        <input type="text" class="form-control mb-2" id="myInput{{$row->id}}" onkeyup="myFunction({{$row->id}})" placeholder="جستجو ..">

                        <div class="sd-checkbox">
                            <ul id="myUL{{$row->id}}" class="p-0 m-0" style="list-style-type:none">
                                @foreach($row->children as $item)
                                    <li>
                                        <label class="custom-ch">
                                            {{$item->title}}
                                            <input type="radio" name="category_id[{{$row->id}}]" value="{{$item->id}}" class="form-control">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @if(!$loop->last)
                    <hr class="mt-3">
                @endif
            @endforeach
            <div class="col-sm-12 col-xs-12 p-2">
                <button type="submit" class="btn btn-success px-5">
                    ذخیره
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function myFunction(id) {
        var input, filter, ul, li, label, i, txtValue;
        input = document.getElementById("myInput" + id);
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL" + id);
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            label = li[i].getElementsByTagName("label")[0];
            txtValue = label.textContent || label.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>
