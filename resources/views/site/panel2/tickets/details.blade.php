@extends('site.panel.master')
@section('content')
{{--  --}}
<div class="card rounded-custom p-3 border-0 h-100">
	<div class="row w-100 m-0">
		<div class="col-sm-12 p-1">
			<p class="ismb h5 m-0 d-flex align-items-center justify-content-between">
				جزییات تیکت
				<i class="bi bi-pencil-square text-a h4 my-0 me-2 d-flex"></i>
			</p>
			<hr class="hr-panel">
		</div>
		<div class="col-sm-12 p-1">
			<div class="row w-100 m-0">
				<div class="bg-light rounded-custom p-2">
					<!-- user -->
					<div class="col-sm-12 @if($start->user_id == \Illuminate\Support\Facades\Auth::id()) text-start  user @endif p-1">
						<div class="card p-3 border-0 rounded-3">
							<p class="ismb m-0">
                                @if($start->user_id == \Illuminate\Support\Facades\Auth::id())
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
									fill="currentColor" class="bi bi-person-circle me-2 text-a"
									viewBox="0 0 16 16">
									<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
									<path fill-rule="evenodd"
										d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
								</svg>
                                    @endif
                                {{@$start->subject}}
							</p>
							<div class="text-justify text-secondary">
								<p>
								{{@$start->message}}
								</p>
							</div>
							<small class="mt-2">
                                {{jdate('d F Y',@$start->created_at->timestamp)}}
								- <span>{{@$start->user->name}}</span>
							</small>
                            @if(isset($start->file))
                                <div class="border bg-light shadow-sm p-2 ">
                                    <div class="row w-100 m-0 gy-2">
                                        <div class="col-sm-12 p-1">
                                            <a href="{{asset('assets/uploads/content/ticket/'.$start->file)}}" download
                                               class="btn btn-success btn-circle">
                                                <i class="fa fa-download"></i>
                                                دانلود فایل ضمیمه ابتدایی
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
						</div>
					</div>
					<!-- admin -->
                    @foreach($end as $row)
					<div class="col-sm-12 @if($row->user_id == \Illuminate\Support\Facades\Auth::id()) text-start  user @else text-end admin @endif p-1">
						<div class="card p-3 border-0 rounded-3">
							<p class="ismb m-0">
                                {{@$row->subject}}
                                @if($row->user_id == \Illuminate\Support\Facades\Auth::id())
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         fill="currentColor" class="bi bi-person-circle me-2 text-a"
                                         viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                        <path fill-rule="evenodd"
                                              d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                    </svg>
                              @else
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
									fill="currentColor" class="bi bi-person-workspace ms-2 text-a"
									viewBox="0 0 16 16">
									<path
										d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
									<path
										d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z" />
								</svg>
                                @endif
							</p>
							<div class="text-justify text-secondary">
								<div class="text-end">
									<p>
                                        {{@$row->message}}
									</p>
								</div>
							</div>
							<small class="mt-2">
                                {{jdate('d F Y',@$row->created_at->timestamp)}}
                                - <span>{{@$row->user->name}}</span>
							</small>
                            @if(isset($row->file))
                                <div class="border bg-light shadow-sm p-2 ">
                                    <div class="row w-100 m-0 gy-2">
                                        <div class="col-sm-12 p-1">
                                            <a href="{{asset('assets/uploads/content/ticket/'.$row->file)}}" download
                                               class="btn btn-success btn-circle">
                                                <i class="fa fa-download"></i>
                                                دانلود فایل ضمیمه
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
						</div>
					</div>
                    @endforeach
					<div class="col-sm-12 p-1">
                        <form action="{{URL::action('Panel\TicketController@postTicketDetails')}}" method="post" class="m-0">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{$start->id}}">
							<div class="send-ticket border rounded-custom">
								<div class="form-floating">
									<textarea class="form-control border-0" placeholder="نوشتن پاسخ" id="textarea" name="message"></textarea>
									<label for="textarea">
										نوشتن پیام
									</label>
								</div>
								<button type="submit" class="btn btn-success rounded-custom">
									ارسال
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop
