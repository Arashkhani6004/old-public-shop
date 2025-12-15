@extends('site.panel.master')
@section('content')

<div class="card rounded-custom p-3 border-0 h-100">
	<div class="row w-100 m-0">
		<div class="col-sm-12 p-1">
			<p class="ismb h5 m-0 d-flex align-items-center justify-content-between">
				تیکت ها
				<i class="bi bi-mailbox text-a h4 my-0 me-2 d-flex"></i>
			</p>
			<hr class="hr-panel">
		</div>
		<div class="col-sm-12 p-1">
			<div class="row w-100 m-0">
				<a href="{{route('panel.new-tickets')}}" class="btn btn-sm border text-a ms-auto max-content d-flex align-items-center mb-2 rounded-0 fw-bolder">
					<i class="bi bi-plus-lg me-2 d-flex"></i>
					نوشتن تیکت جدید
				</a>

                @if($tickets->count() > 0)
                @foreach($tickets as $key=> $row)
				<div class="col-sm-12 px-0 py-0">
					<div class="card bg-light rounded-0 p-1">
						<div class="row w-100 m-0 bg-white">
							<div class="col-xl-1 col-sm-1 col-xs-1 text-center px-0 py-2 border">
								{{@$key+1}}
							</div>
							<div class="col-xl-4 col-md-11 col-sm-4 col-xs-11 text-center px-0 py-2 border">
						{{@$row->subject}}
							</div>
							<div class="col-xl-3 col-md-5 col-sm-3 col-xs-5 text-center px-0 py-2 border">
                                {{jdate('Y/m/d H:i',$row->created_at->timestamp)}}
							</div>
							<div class="col-xl-3 col-md-5 col-sm-3 col-xs-5 text-center px-0 py-2 border">
                                @if($row->status == 0)
                                    <span class="badge bg-info">
							در انتظار پاسخ
						</span>
                                @elseif($row->status == 1)
                                    <span class="badge bg-success">
							پاسخ داده شده
						</span>
                                @elseif($row->status == 2)
                                    <span class="badge bg-danger">
							بسته شده
						</span>
                                @elseif($row->status == 3)
                                    <span class="badge text-dark">
							مرجوع شد
						</span>
                                @endif
							</div>
							<div class="col-xl-1 col-md-2 col-sm-1 col-xs-2 text-center px-0 py-2 border">
								<a href="{{URL::action('Panel\TicketController@ticketDetail',$row->id)}}" class="btn btn-sm btn-outline-secondary">
									<i class="bi bi-eye-fill d-flex"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
                @endforeach
                    @else
                <div class="col-sm-12 py-5 px-0">
					@include('site.panel.blocks.empty-tickets')
                    </div>
                @endif
			</div>
		</div>
	</div>
</div>
@stop
{{--  --}}