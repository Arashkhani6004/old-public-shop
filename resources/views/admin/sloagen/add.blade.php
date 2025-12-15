@extends('layouts.admin.master')
@section('title','جدید')
@section('content')
<div class="container-fluid dashboard-content" id="app34534567">
	<div class="row w-100 m-0">
		<div class="col-lg-6 mx-auto py-1 px-0">
			<h3 class="bg-white py-2 px-4 rounded-lg">
				اضافه کردن
			</h3>
			<div class="card rounded-lg border-0 p-3">
				<form method="post" action="{{URL::action('Admin\SloagenController@postAdd')}}"
					enctype="multipart/form-data">
                    <div class="card rounded-lg border-0 p-3 m-0">
                        <div class="row w-100 m-0">
                            {{ csrf_field() }}
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
                                                        <input type="checkbox" value="{{ $row['id'] }}" @if (isset($data->category_id) && $data->category_id == $row['id'])  checked="checked" @endif name="category_id[]"
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
                            <div class="row w-100 m-0 p-2 border"  v-for="me in number" >
                                <div class="col-lg-12 p-1 m-0 form-group">
                                    <label for="title" class="col-form-label">عنوان</label>
                                    <textarea class="form-control" type="text" id="title" name="title[]"   required oninvalid="swal('ارور',' وارد کردن عنوان اجباریست','error')" >@if(isset($data->title)){{$data->title}}@endif</textarea>
                                </div>
                                <div class="col-lg-12 p-1 m-0 form-group">
                                    <label for="image" class="col-form-label">تصویر</label>
                                    <input class="form-control" type="file" name="image[]">
                                    @if(isset($data->image))
                                        <img src="{{asset('assets/uploads/content/sloagen/'.$data->image)}}" style="width:400px">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 px-0 pt-3">
                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-success m-0">ذخیره</button>
                                </div>
                            </div>
                            <div class="col-lg-6 text-end px-0 pt-3">
                                <a @click="plusMe()" class="btn btn-default btn-primary m-0">
                                    <span class="fa fa-plus">اضافه کردن چندتایی</span>
                                </a>
                            </div>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop
@section('js')

    <script src="{{asset('asset/site/js/lodash.min.js')}}"></script>
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>
    <script src="https://unpkg.com/element-ui/lib/umd/locale/fa.js"></script>
    <script type="text/javascript">
        function myFunction2() {

            var input, filter, ul, li, la, i, txtValue;
            input = document.getElementById("myInput2");
            filter = input.value.toUpperCase();
            var chek = document.getElementById('chek');

            ul = document.getElementById("myUL2");
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
        var app = new Vue({
            el: '#app34534567',
            data:{
                number :1
            },
            methods: {
                plusMe: function(){
                    this.number = this.number+1;
                }
            }
        })
    </script>

    <script>
        document.getElementById('check-all').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('.category-checkbox');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });
    </script>

    <script type="text/javascript">
        $(function() {
            var opts = $('#optlist option').map(function(){
                return [[this.value, $(this).text()]];
            });

            $('#someinput').keyup(function(){
                var rxp = new RegExp($('#someinput').val(), 'i');
                var optlist = $('#optlist').empty();
                opts.each(function(){
                    if (rxp.test(this[1])) {
                        optlist.append($('<option/>').attr('value', this[0]).text(this[1]));
                    }
                });
            });
        });
    </script>
@endsection
