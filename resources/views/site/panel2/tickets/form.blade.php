@extends('site.panel.master')
@section('content')
{{--  --}}
<div class="card rounded-custom p-3 border-0 h-100">
	<div class="row w-100 m-0">
		<div class="col-sm-12 p-1">
			<p class="ismb h5 m-0 d-flex align-items-center justify-content-between">
				نوشتن تیکت جدید
				<i class="bi bi-pencil-square text-a h4 my-0 me-2 d-flex"></i>
			</p>
			<hr class="hr-panel">
		</div>
		<div class="col-sm-12 p-1">
			<div class="row w-100 m-0">
				<div class="col-xxl-7 col-xl-8 col-md-12 col-sm-8 col-xs-12 mx-auto p-0">
                    <form action="{{URL::action('Panel\TicketController@postNewTicket')}}" method="post" class="m-0"
                          enctype="multipart/form-data">
                        @csrf
						<div class="row w-100 m-0">
							<div class="col-sm-12 p-1">
								<div class="form-floating">
									<input type="text" class="form-control" id="nameInput" name="subject"
										placeholder="">
									<label for="nameInput">
										عنوان تیکت
									</label>
								</div>
							</div>
                            <div class="col-sm-12 p-1">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect"
                                            aria-label="Float[ing label select example" name="department_id">
                                        <option value="0" selected>
                                            انتخاب دپارتمان
                                        </option>
                                        @foreach($departments as $row)
                                            <option value="{{$row->id}}">
                                                {{$row->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">دپارتمان</label>
                                </div>
                            </div>
							<div class="col-sm-12 p-1">
								<div class="form-floating">
									<textarea class="form-control" placeholder="متن پیام خود را بنویسید" name="message"
										id="floatingTextarea2" style="height: 100px"></textarea>
									<label for="floatingTextarea2">
										متن تیکت خود را بنویسید
									</label>
								</div>
							</div>
                            <div class="col-sm-12 p-1">
                                <div class="form-floating">
                                    <input type='file' name="file" />
                                    <label for="imageUpload">فایل ضمیمه</label>
                                </div>

                            </div>

                            <div class="col-sm-12 p-1">
								<button type="submit" class="btn btn-success rounded-custom w-100">
									ارسال تیکت
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@stop
