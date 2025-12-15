@extends('layouts.admin.master')
@section('title', 'محصولات')
@section('content')
    <div class="container-fluid dashboard-content">
        <div class="row w-100 m-0">
            <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12 col-12 px-0">
                <div class="page-header">
                    <h3 class="bg-white py-2 px-4 rounded-lg">
                        متغیر ها {{ $product->title }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="row" id="app68">
            <div class="card col-lg-12">
                <div class="row w-100 m-0">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div>
                            <div class="card-body px-1">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row w-100 m-0">
                                            <div class="col-sm-12">
                                                {{-- from Add --}}
                                                <form id="myform" name="form1" id="form-sub" v-on:submit.prevent="required" method="POST" action="{{URL::action('Admin\VariableController@postAddVariable')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <div class="card" v-for="me in number">
                                                        <div class="row g-1">
                                                            <div class="col-4">
                                                                <!-- Name input -->
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="form9Example1">عنوان <span style="color:red">*</span></label>
                                                                    <input type="text" :name="'values[' + me + '][title]'" :id="'title'+ me" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <!-- Email input -->
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="form9Example2">موجودی <span style="color:red">*</span></label>
                                                                    <input type="text" :name="'values[' + me + '][stock]'" :id="'stock'+ me" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <!-- Email input -->
                                                                <div class="form-outline">
                                                                    <label class="col-form-label"> تصویر <span style="color:red">*</span></label>
                                                                    <input :name="'values[' + me + '][image][]'" accept=".jpg" :id="'image'+ me" class="form-control" type="file" multiple>
                                                                        <span style="color:red">فرمت عکس ها باید jpg باشد .</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <div class="row g-1">
                                                            <div class="col">
                                                                <!-- Name input -->
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="form9Example3">قیمت <span style="color:red">*</span></label>
                                                                    <input type="text" :name="'values[' + me + '][price]'" :id="'price'+ me" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <!-- Email input -->
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="form9Example4">قیمت بعد
                                                                        تخفیف</label>
                                                                    <input type="text" :name="'values[' + me + '][discounted_price]'" :id="'discounted_price'+ me" class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="px-2 py-3">
                                                        <a @click="plusMe()" id="submitForm" class="btn btn-default btn-primary">
                                                            <span class="fa fa-plus">اضافه کردن چندتایی</span>
                                                        </a>
                                                        <button type="submit" class="btn btn-space btn-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-dotted me-2" viewBox="0 0 16 16">
                                                                <path d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z">
                                                                </path>
                                                            </svg>
                                                            ثبت
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if ($variables)
                            <div class="card">
                                <div class="card-body px-1">
                                    <div class="table-responsive">
                                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                            <div class="row w-100 m-0">
                                                <div class="col-sm-12 p-0">
                                                    {{-- from Edit --}}
                                                    @foreach ($variables as $variable)
                                                        <hr>
                                                        <form method="POST" action="{{ URL::action('Admin\VariableController@postEditVariable', $variable->id) }}" enctype="multipart/form-data" style="border-radius:0.75rem;background: #5969ff0f;
                                                            padding: 0.5rem;">
                                                            @csrf
                                                            <input type="hidden" name="pro_id" value="{{ $product->id }}">
                                                            <div class="row g-1">
                                                                <div class="col-4 p-2 ">
                                                                    <div class="form-outline">
                                                                        <label class="form-label" for="form9Example1">عنوان</label>
                                                                        <input type="text" value="{{ $variable->title }}" name="title" id="form9Example1" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-4 p-2">
                                                                    <div class="form-outline">
                                                                        <label class="form-label" for="form9Example2">موجودی</label>
                                                                        <input type="text" value="{{ $variable->stock }}" name="stock" id="form9Example2" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-4 p-2">
                                                                    <div class="form-outline">
                                                                        <label class="col-form-label"> تصویر </label>
                                                                        <input name="image[]" value="{{ $variable->image }}" class="form-control" type="file" multiple accept=".jpg">
                                                                    </div>
                                                                    <button type="button" class="btn btn-info mt-3" data-toggle="modal" data-target="#example-{{ $variable->id }}">
                                                                        <i class="fa fa-images"></i>
                                                                        تصاویر
                                                                    </button>
                                                                    {{-- Start Modal --}}
                                                                    <div class="modal fade" id="example-{{ $variable->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">تصاویر
                                                                                    </h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    @php
                                                                                        $images = App\Models\Image::where('product_variable_id', $variable->id)->get();
                                                                                    @endphp
                                                                                    <div class="d-flex d-flex justify-content-center">
                                                                                        <div class="row">
                                                                                            @foreach ($images as $img)
                                                                                                <div class="col border row m-0">
                                                                                                    <div class="col-12 text-centerb">
                                                                                                        <img class="m-auto" src="{{ asset('assets/uploads/content/pro/small/' . $img->file) }}" alt="" width="100px">
                                                                                                    </div>
                                                                                                    <div class="col-12 text-center">
                                                                                                        <a href="{{ route('admin.variable.deleteiamge', ['id' => $img->id]) }}" class="btn btn-danger m-auto btn-sm">حذف</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{-- End Modal --}}
                                                                </div>
                                                            </div>
                                                            <div class="row g-1">
                                                                <div class="col-4 p-2 align-self-center">
                                                                    <div class="form-outline">
                                                                        <label class="form-label" for="form9Example3">قیمت</label>
                                                                        <input type="text" name="price" value="{{ $variable->price }}" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-4 p-2 align-self-center">
                                                                    <div class="form-outline">
                                                                        <label class="form-label" for="form9Example4">قیمت
                                                                            بعد
                                                                            تخفیف</label>
                                                                        <input type="text" name="discounted_price" value="{{ $variable->discounted_price }}" id="form9Example4" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-4 p-2 align-self-center">
                                                                    <div class="d-flex align-items-center gap-4">
                                                                        <button type="submit" class="btn btn-space btn-primary">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-dotted me-2" viewBox="0 0 16 16">
                                                                                <path d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z">
                                                                                </path>
                                                                            </svg>
                                                                            ویرایش
                                                                        </button>
                                                                        <a href="{{ URL::action('Admin\VariableController@getDeleteVariable', $variable->id) }}" type="button" onclick="return confirm('آیا از حذف اطلاعات مطمئن هستید؟');" class="btn btn-space btn-danger" data-toggle="tooltip" title="" data-original-title="حذف"><i class="fa fa-trash"></i> حذف</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="row">
                                                                <div class="col-2">
                                                                    <div class="px-2 py-3">

                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="px-2 py-3">

                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                        </form>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('assets/admin/js/vue.js') }}"></script>
    <script src="{{ asset('assets/admin/js/axios.min.js') }}"></script>
    <script>
        var app = new Vue({
            el: '#app68',
            data: {
                number: 1,
            },
            methods: {
                plusMe: function() {
                    var title = document.getElementById('title'+ this.number).value;
                    var stock = document.getElementById('stock'+ this.number).value;
                    var price = document.getElementById('price'+ this.number).value;
                    var image = document.getElementById('image'+ this.number).value;
                    var discounted_price = document.getElementById('discounted_price'+ this.number).value;
                    if (title == "" || stock == "" || price == "" || image == "")
                    {
                        swal(
                            {title: "خطا!",
                                text: "اول فرم را تکمیل کنید!!",
                                icon: "error",
                            });
                        return false;
                    }
                    this.number = this.number + 1;
                },
                minesMe: function() {
                    this.number = this.number - 1;
                },

                required: function(){
                    var title = document.getElementById('title'+ this.number).value;
                    var stock = document.getElementById('stock'+ this.number).value;
                    var price = document.getElementById('price'+ this.number).value;
                    var image = document.getElementById('image'+ this.number).value;
                    var discounted_price = document.getElementById('discounted_price'+ this.number).value;
                    if (title == "" || stock == "" || price == "" || image == ""){
                        swal(
                            {title: "خطا!",
                                text: "لطفا فرم را تکمیل کنید!!",
                                icon: "error",
                            });
                        return false;
                    };
                    if (!/^[\u06F0-\u06F90-9]+$/.test(price) || !/^[\u06F0-\u06F90-9]+$/.test(stock)) {
                        swal(
                            {title: "خطا!",
                                text: "اموجودی و قیمت باید عدد باشند!!",
                                icon: "error",
                            });
                        return false;
                    };
                    if (discounted_price != "" && !/^[\u06F0-\u06F90-9]+$/.test(discounted_price)){
                        swal(
                            {title: "خطا!",
                                text: " قیمت تخفیف باید عدد باشد!!",
                                icon: "error",
                            });
                        return false;
                    }
                    document.getElementById('myform').submit();
                }
            }
        });
    </script>
    {{-- <script>
        function required()
        {
        var x = document.getElementsByTagName('input')
        if (x == "" )
            {
                alert("Please input a Value");
                return false;
            }
        }
    </script> --}}
@stop
