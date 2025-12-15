<script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js" charset="utf-8"></script>
{{ csrf_field() }}
<div class="row">
    <div class="col-lg-6 form-group">
        <label for="title" class="col-form-label">عنوان</label>
        <input id="title" name="title" type="text" class="form-control"
               value="@if(isset($data->title)){{$data->title}}@endif">
    </div>
    <div class="col-lg-6 form-group">
        <label for="price" class="col-form-label">قیمت</label>
        <input id="price" onkeyup="chakeNumber(this.id)" name="price" type="text" class="form-control"
               value="@if(isset($data->price)){{$data->price}}@endif">
    </div>
    <div class="col-lg-6 form-group">
        <label for="max_price" class="col-form-label">حداقل مبلغ برای رایگان شدن سفارش</label>
        <input id="max_price" onkeyup="chakeNumber(this.id)" name="max_price" type="text" class="form-control"
               value="@if(isset($data->max_price)){{$data->max_price}}@endif">
    </div>
    <div class="col-6 p-1 form-group">
        <div class="w-100 p-1">
            <label for="category_id" class="col-form-labelc w-100">
                انتخاب شهر :
            </lab>
            <div class="bg-light p-2">
                <input type="text" class="form-control mb-2" id="myInput" onkeyup="myFunction()"
                    placeholder="جستجو ..">
                <div class="sd-checkbox ">
                    <ul id="myUL" class="p-0 m-0" style="list-style-type:none">
                        <li>
                            <label class="custom-ch">
                                انتخاب همه
                                <input type="checkbox" value="empy" id="chekall" onchange="selectAll(this.id)" class="form-control" multiple >
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        @foreach ($cities as $key => $row2)
                            @php
                            $cat = \App\Models\City::find($row2['id']);
                                                                                    @endphp
                            <li>
                                <label class="custom-ch">
                                    {{ $row2['name'] }}
                                    <input type="checkbox" id="city" value="{{ $row2['id'] }}"
                                        @if (isset($data) and in_array($row2['id'], $cat_pro)) checked="checked" @endif name="city_id[]"
                                        class="form-control" multiple
                                        @if (@$cat->childs && count(@$cat->childs) > 0) disabled @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @if(isset($data))
        <div class="w-100 p-1">
            <label for="category_id" class="col-form-labelc w-100">
                شهر های انتخاب شده :
            </lab>
            <div class="bg-light p-2">

                @foreach ($data->city as $cy)

                {{$cy->name}} |
                @endforeach

            </div>
        </div>
        @endif
    </div>







    <!--<div class="form-group">-->
    <!--    <label for="description" class="col-form-label">توضیحات </label>-->
    <!--    <textarea class="form-control ckeditor" id="description" name="description" rows="3">-->
    <!--        @if(isset($data->description)){!!$data->description !!}@endif</textarea>-->
    <!--</div>-->


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
            پرداخت درب منزل
        </label>
        <div class="col-12 col-sm-8 col-lg-6 pt-1">
            <div class="switch-button switch-button-yesno">
                <input type="checkbox" value="1" @if(isset($data->pay_at_home) && $data->pay_at_home == 1) checked="checked" @endif name="pay_at_home" id="pay_at_home">
                <span>
                    <label for="pay_at_home"></label>
                </span>
            </div>
        </div>
    </div>

    {{-- <div class="col-lg-3 form-group">
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
    </div> --}}
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
    // let price = document.getElementById('price')
    // const numberpattern = /^[0-9+۰-۹]+$/;
    // price.addEventListener('keypress', function(){
    //     console.log(price.value);
    //     if(!numberpattern.test(price.value.trim()))
    //     {

    //     }
    // });

    function chakeNumber(id)
    {
        const numberpattern = /^[0-9+۰-۹]+$/;

        let el = document.getElementById(id)
        console.log(el.value)

        if(!numberpattern.test(el.value.trim()))
        {
            new swal("خطا", "لطفا مقدار را به عدد وارد کنید", "error");
            el.value = "";
            return false;
        }
    }

    function selectAll(value)
    {

        let chekboxs =document.querySelectorAll('#city')

        let all =document.getElementById(value)
        console.log(all)
        if(all.value == 'empy')
        {
            for(cheak of chekboxs)
            {
                    cheak.setAttribute("checked","checked")
                    all.value = 'all'
            }
        }else
        {
            for(cheak of chekboxs)
            {
                     cheak.removeAttribute("checked")
                     all.value = 'empy'
            }
        }





    }

</script>
@endsection
