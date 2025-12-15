@extends('layouts.site.master')
@section('content')
<section v-if="loding == true && cartItems.length > 0">
    <main class="content" >
        <div class="cart">
			<div class="bg-b-light py-3">
				<div class="container">
					<div class="row w-100 m-0">
						<div class="col-sm-12 p-1 px-xs-2">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="/">
											خانه
										</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">
										سبد خرید
									</li>
								</ol>
							</nav>
						</div>
						<div class="col-lg-9 p-0">
                            <div class="loader" >
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>

    </main>
    @section('css')
        <style>
            .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
            }

            /* Safari */
            @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
            }
            </style>
    @endsection
</section>
<section v-else>
    <main class="content" v-if="order && cartItems.length > 0">
            <div class="cart">
                <div class="bg-b-light py-3">
                    <div class="container">
                        <div class="row w-100 m-0">
                            <div class="col-sm-12 p-1 px-xs-2">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="/">
                                                خانه
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            سبد خرید
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-lg-9 p-0">
                                @include('site.cart2.blocks.buy-details')
                            </div>
                            <div class="col-lg-3 p-0">
                                @include('site.cart2.blocks.price-details')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="modal fade" id="addAddresModal" tabindex="-1" aria-labelledby="addAddresModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content rounded-custom">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAddresModalLabel">
                            وارد کردن آدرس
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-2">
                        <div class="col-sm-12 p-1">
                            <form class="m-0" method="post"
                                action="{{URL::action('Site\ShopController@postAddAddress')}}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="order_id" :value="order.id">
                                <div class="row w-100 m-0">
                                    <div class="col-xxl-6 p-1">
                                        <div class="form-floating">
                                            <select name="state_id" class="form-select" id="floatingSelect" required
                                                    aria-label="Floating label select example"
                                                    v-model="selectedState"
                                                    @change="getEditCities(selectedState)">
                                                <option value=""> انتخاب استان </option>
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingSelect">
                                                استان<span class="text-danger">*</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 p-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelect"
                                                    aria-label="Floating label select example" required
                                                    v-model="selectedCity" name="city_id">
                                                <option value="">انتخاب شهر </option>
                                                <option v-for="city in cities" :value="city.id">@{{city.name}}
                                                </option>
                                            </select>
                                            <label for="floatingSelect">
                                                شهر<span class="text-danger">*</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 p-1">
                                        <div class="form-floating">
                                            <input type="text" autocomplete="off" class="form-control" id="recipient_name" name="recipient_name" placeholder=" نام و نام خانوادگی تحویل گیرنده">
                                            <label for="floatingInput">
                                                <i class="bi bi-mailbox h6 m-0"></i>
                                                نام و نام خانوادگی تحویل گیرنده

                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 p-1">
                                        <div class="form-floating">
                                            <input onkeyup="chakeNumber(this.id)" type="text" autocomplete="off" class="form-control" id="recipient_phone" name="recipient_phone" placeholder="شماره تماس تحویل گیرنده  ">
                                            <label for="floatingInput">
                                                <i class="bi bi-mailbox h6 m-0"></i>
                                                شماره تماس تحویل گیرنده

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-xxl-6 p-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInput"
                                                name="postal_code" placeholder="کد پستی">
                                            <label for="floatingInput">
                                                <i class="bi bi-mailbox h6 m-0"></i>
                                                کد پستی
                                                <span class="text-danger">
                                                    *
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 p-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInput"
                                                name="transferee_mobile" placeholder="شماره گیرنده" required
                                                oninvalid='swal("", " شماره گیرنده اجباری است", "error")' />
                                            <label for="floatingInput">
                                                <i class="bi bi-telephone h6 m-0"></i>
                                                شماره تماس
                                                <span class="text-danger">
                                                    *
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12 p-1">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="نشانی پستی" required
                                                oninvalid='swal("", "نشانی پستی اجباری است", "error")'
                                                id="floatingTextarea" id="location" name="location"></textarea>
                                            <label for="floatingTextarea">
                                                <i class="bi bi-geo-alt h6 m-0"></i>
                                                نشانی پستی
                                                <span class="text-danger">
                                                    *
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 ms-auto p-1">
                                        <button type="submit" class="btn btn-success rounded-custom w-100">
                                            افزودن آدرس
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if($addresses != null)
                        <div class="col-sm-12 p-1">
                            <div class="row w-100 m-0">
                                @foreach($addresses as $row)
                                <div class="col-xxl-6 p-1">
                                    <div class="card bg-light border-0 shadow-sm rounded-0 p-1">
                                        <div class="row w-100 m-0">
                                            <div class="col-xxl-12 p-1">
                                                {{--										<p class="ismb text-dark m-0">--}}
                                                {{--											عنوان آدرس--}}
                                                {{--										</p>--}}
                                            </div>
                                            <div class="col-xxl-12 p-1">
                                                <p class="m-0 d-flex align-items-center">
                                                    <i class="bi bi-geo-alt text-a d-flex h5 me-2 my-0"></i>
                                                    <span class="text-secondary">
                                                        استان :
                                                        {{@$row->state->name}}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-xxl-12 p-1">
                                                <p class="m-0 d-flex align-items-center">
                                                    <i class="bi bi-geo-alt text-a d-flex h5 me-2 my-0"></i>
                                                    <span class="text-secondary">
                                                        شهر :
                                                    {{@$row->city->name}}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-xxl-12 p-1">
                                                <p class="m-0 d-flex align-items-center">
                                                    <i class="bi bi-geo-alt text-a d-flex h5 me-2 my-0"></i>
                                                    <span class="text-secondary">
                                                        آدرس پستی :
                                                        {{@$row->location}}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-xxl-12 p-1">
                                                <p class="m-0 d-flex align-items-center">
                                                    <i class="bi bi-mailbox text-a d-flex h5 me-2 my-0"></i>
                                                    <span class="text-secondary">
                                                        کد پستی :
                                                        {{@$row->postal_code}}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-xxl-12 p-1">
                                                <p class="m-0 d-flex align-items-center">
                                                    <i class="bi bi-telephone text-a d-flex h5 me-2 my-0"></i>
                                                    <span class="text-secondary">
                                                        شماره تماس :
                                                        {{@$row->transferee_mobile}}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-xxl-6 p-1">
                                                @if($row->default_address == 1)
                                                <a href="{{URL::action('Site\ShopController@defaultAddress',$row->id)}}"
                                                    class="m-0 d-flex align-items-center text-success py-1 px-2 me-auto border border-success max-content">
                                                    <i class="bi bi-check-square-fill d-flex h5 me-2 my-0"></i>
                                                    آدرس پیش فرض
                                                </a>
                                                @else
                                                <a href="{{URL::action('Site\ShopController@defaultAddress',$row->id)}}"
                                                    class="m-0 d-flex align-items-center btn btn-outline-info rounded-0 py-1 px-2 me-auto max-content">
                                                    <i class="bi bi-square-fill d-flex h5 me-2 my-0"></i>
                                                    انتخاب به عنوان پیش فرض
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
    <main class="content py-5 bg-b-light " v-else>
        <input type="hidden" v-model="loding" value="false" />
        <div class="my-5">
            <lottie-player src="https://assets9.lottiefiles.com/datafiles/hYQRPx1PLaUw8znMhjLq2LdMbklnAwVSqzrkB4wG/bag_error.json" background="transparent" speed="1" class="w-25 h-auto mx-auto" loop autoplay></lottie-player>
        </div>
        <p class="h2 ismb text-center text-secondary my-2">
            سبد شما خالی است!
        </p>
    </main>
</section>

@stop
