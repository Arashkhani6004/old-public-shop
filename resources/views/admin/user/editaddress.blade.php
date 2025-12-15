@extends('layouts.admin.master')
@section('title','ویرایش آدرس کاربر')
@section('content')
    <div class="container-fluid dashboard-content" id="app334">
        <div class="row w-100 m-0">
            <div class="col-lg-12 mx-auto py-1 px-0">
                <h3 class="bg-white py-2 px-4 rounded-lg">
                    ویرایش
                </h3>

                <div class="card rounded-lg border-0 p-3">
                    <form class="m-0" method="post" action="{{URL::action('Admin\UserController@postEditAddress',$data->id)}}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row w-100 m-0">
                            <div class="col-xxl-4 p-1">
                                <div class="form-group">
                                    <label for="floatingInput">
                                        <i class="bi bi-pencil h6 m-0"></i>
                                        عنوان آدرس
                                        <span class="text-danger">
									*
									</span>
                                    </label>
                                    <input type="text" class="form-control"  name="name"
                                           placeholder="نام آدرس" value="@if(isset($data->name)){{$data->name}}@endif">

                                </div>
                            </div>
                            <div class="col-xxl-4 p-1">
                                <div class="form-group">
                                    <label for="floatingInput">
                                        <i class="bi bi-mailbox h6 m-0"></i>
                                        کد پستی
                                        <span class="text-danger">
									*
									</span>
                                    </label>
                                    <input type="text" class="form-control" id="floatingInput" name="postal_code"
                                           placeholder="کد پستی" value="@if(isset($data->postal_code)){{$data->postal_code}}@endif">

                                </div>
                            </div>
                            <div class="col-xxl-4 p-1">
                                <label for="floatingInput">
                                    <i class="bi bi-telephone h6 m-0"></i>
                                    شماره تماس
                                    <span class="text-danger">
									*
									</span>
                                </label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="floatingInput" name="transferee_mobile"
                                           placeholder="شماره تماس" value="@if(isset($data->transferee_mobile)){{$data->transferee_mobile}}@endif">

                                </div>
                            </div>
                            <div class="col-xxl-6 p-1">
                                <div class="form-floating">
                                    <select name="state_id" class="form-select" id="floatingSelect"
                                            aria-label="Floating label select example" v-model="selectedState"
                                            @change="setCities(selectedState)">
                                        <option value="">
                                            انتخاب استان
                                        </option>
                                        @foreach($states as $state)
                                            <option @if(isset($data->state_id))
                                                    @if($data->state_id == $state->id)selected
                                                    @endif
                                                    @endif
                                                    value="{{$state->id}}">
                                                {{$state->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">
                                        استان
                                        <span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-6 p-1">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect"
                                            aria-label="Floating label select example" v-model="selectedCity"
                                            name="city_id">
                                        <option value="">
                                            انتخاب شهر
                                        </option>
                                        <option v-for="city in cities" :value="city.id">
                                            @{{city.name}}
                                        </option>
                                    </select>
                                    <label for="floatingSelect">
                                        شهر
                                        <span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>


                            <div class="col-xxl-12 p-1">
                                <div class="form-group">
                                    <label for="floatingTextarea">
                                        <i class="bi bi-geo-alt h6 m-0"></i>
                                        نشانی پستی
                                        <span class="text-danger">
									*
									</span>
                                    </label>
								<textarea class="form-control" placeholder="نشانی پستی" name="location"
                                          id="floatingTextarea" style="height: 5rem">@if(isset($data->location)){{$data->location}}@endif</textarea>

                                </div>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">
                                    انتخاب به عنوان آدرس پیش فرض
                                </label>
                                <div class="col-12  pt-1">
                                    <div class="switch-button switch-button-yesno">
                                        <input type="checkbox" value="1" @if(isset($data->default_address) && $data->default_address == 1) checked="checked" @endif name="default_address" id="status">
                                        <span>
                    <label for="status"></label>
                </span>
                                    </div>
                                </div>
                            </div>


                            <div class="card-footer">
                                <div class="col-lg-12 p-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-space btn-success m-0 px-5">ذخیره</button>
                                    </div>
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
    <script>

        var app = new Vue({
            el: '#app334',
            data:{
                selectedState: 0,
                selectedCity: 0,
                cities: [],


                msg: 'test'
            },
            mounted() {

                this.getCities();


            },
            methods: {
                //Address
                getCities:function ()  {
                    var vm = this;


                    axios.post(`{{route('panel.set-city')}}`, {
                        body: {}
                    })
                        .then(response => {
                            if (response.data.success === true) {
                                vm.cities = response.data.cities;
                            }
                        })
                        .catch(e => {
                            console.log(e);
                        });
                },
                setCities:function ()  {

                    var vm = this;

                    axios.post(`{{route('panel.set-city')}}`, {
                        body: {  state_id: this.selectedState }
                    })
                        .then(response => {
                            if (response.data.success === true) {
                                vm.cities = [];
                                vm.cities = response.data.cities;
                            }
                        })
                        .catch(e => {
                            console.log(e);
                        });
                },
                getEditCities:function (selectedState)  {
                    var vm = this;


                    axios.post(`{{route('panel.set-city-edit')}}`, {
                        body: {
                            state_id: selectedState
                        }
                    })
                        .then(response => {
                            if (response.data.success === true) {
                                vm.cities = response.data.cities;
                            }
                        })
                        .catch(e => {
                            console.log(e);
                        });

                },
            }
        })

    </script>
@endsection
