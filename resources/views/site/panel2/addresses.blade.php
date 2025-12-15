@extends('site.panel.master')
@section('content')

<div class="card rounded-custom p-3 border-0 h-100">
	<div class="row w-100 m-0">
		<div class="col-sm-12 p-1">
			<p class="ismb h5 m-0 d-flex align-items-center justify-content-between">
				آدرس ها
				<i class="bi bi-map text-a h4 my-0 me-2 d-flex"></i>
			</p>
			<hr class="hr-panel">
		</div>
		<div class="col-sm-12 p-1">
			<div class="row w-100 m-0">
				<a class="btn btn-sm border text-a ms-auto max-content d-flex align-items-center mb-2 rounded-0 fw-bolder"  data-bs-toggle="modal" data-bs-target="#addAddressModal">
					<i class="bi bi-plus-lg me-2 d-flex"></i>
					اضافه کردن آدرس
				</a>

            @if($addresses->count() > 0)
                    @foreach($addresses as $row)
				<div class="col-sm-12 px-0 py-1">
					<div class="card bg-light border-0 shadow-sm rounded-0 p-1">
						<div class="row w-100 m-0">
							<div class="col-xxl-12 p-1">
								<p class="ismb text-dark m-0">
							{{@$row->name}}
								</p>
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
								<a href="{{URL::action('Panel\PanelController@defaultAddress',$row->id)}}" class="m-0 d-flex align-items-center text-success py-1 px-2 me-auto border border-success max-content">
									<i class="bi bi-check-square-fill d-flex h5 me-2 my-0"></i>
									آدرس پیش فرض
								</a>
                                @else
								<a href="{{URL::action('Panel\PanelController@defaultAddress',$row->id)}}" class="m-0 d-flex align-items-center btn btn-outline-info rounded-0 py-1 px-2 me-auto max-content">
									<i class="bi bi-square-fill d-flex h5 me-2 my-0"></i>
									انتخاب به عنوان پیش فرض
								</a>
                                @endif
							</div>
							<div class="col-xxl-6 p-1">
                                <a href="{{URL::action('Panel\PanelController@getDeleteAddress',$row->id)}}" type="button"
                                   onclick="return confirm('آیا از حذف اطلاعات مطمئن هستید؟');" class="m-0 d-flex align-items-center btn btn-outline-danger rounded-0 py-1 px-2 ms-auto max-content">
									<i class="bi bi-trash d-flex h5 me-2 my-0"></i>
									حذف آدرس
								</a>
							</div>
						</div>
					</div>
				</div>
                    @endforeach
                @else
            <div class="col-sm-12 py-5 px-0">
					@include('site.panel.blocks.empty-addresess')
                </div>
                @endif
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
@include('site.panel.blocks.add-addres')
@stop
