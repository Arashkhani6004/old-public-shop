<div class="side-panel card rounded-custom p-3 border-0 h-100">
	<div class="row w-100 m-0">
		<div class="col-sm-12 p-0">
			<div class="row w-100 m-0 user-box">
				<div class="col-lg-3 col-md-4 mx-auto col-sm-2 col-xs-3 align-self-center text-center p-1">
					<div class="mx-auto rounded-circle max-content overflow-hidden avatarbox">
                        @if(@$user->avatar != null && file_exists('assets/uploads/content/users/'.@$user->avatar))

                            <img src=" {{asset('assets/uploads/content/users/'.$user->avatar)}}" alt="" class="w-100 rounded-circle">
                            @else
						<img src="{{asset('assets/site/images/user.png')}}" alt="" class="w-100 rounded-circle">
                        @endif
					</div>
				</div>
				<div class="col-lg-9 col-md-12 col-sm-10 col-xs-9 align-self-center p-0">
					<div class="row w-100 m-0">
						<div class="col-sm-6 col-xs-6 text-center p-0">
							<p class="my-0 fw-bolder text-dark h5">
							{{@$user->orders->count()}}
							</p>
							<p class="my-0 text-secondary h6">
								سفارشات
							</p>
						</div>
						<div class="col-sm-6 col-xs-6 text-center p-0">
							<p class="my-0 fw-bolder text-dark h5">
                                {{@$user->likes->count()}}
							</p>
							<p class="my-0 text-secondary h6">
								علاقه مندی ها
							</p>
						</div>
					</div>
				</div>
				<div class="col-xl-12 px-1 pt-2 pb-1 name">
					<p class="m-0">
                        {{@$user->name}}
					</p>
					<p class="m-0">
                        {!! @$user->mobile !!}

					</p>
				</div>
			</div>
		</div>
		<div class="col-xxl-12 px-1">
			<hr class="my-2">
		</div>
		<div class="col-xxl-12 p-1">
			<div class="side-box">
				<ul class="p-0 m-0">
					<li class="list-unstyled py-1">
						
						<a href="{{route('panel.dashboard')}}" class="d-flex p-2 align-items-center rounded-custom @if($seg[1] == 'dashboard' ) active @endif">
							<i class="bi bi-speedometer2 me-2 d-flex"></i>
							داشبورد
						</a>
					</li>
					<li class="list-unstyled py-1">
						<a href="{{route('panel.edit')}}" class="d-flex p-2 align-items-center rounded-custom @if($seg[1] == 'edit-info' ) active @endif">
							<i class="bi bi-pencil-square me-2 d-flex"></i>
							ویرایش اطلاعات
						</a>
					</li>
{{--					<li class="list-unstyled py-1">--}}
{{--						<a hresf="{{route('panel.pass')}}" class="d-flex p-2 align-items-center rounded-custom @if($seg[1] == 'reset-password' ) active @endif">--}}
{{--							<i class="bi bi-key me-2 d-flex"></i>--}}
{{--							بازیابی رمز عبور--}}
{{--						</a>--}}
{{--					</li>--}}
					<li class="list-unstyled py-1">
						<a href="{{route('panel.orders')}}" class="d-flex p-2 align-items-center rounded-custom @if($seg[1] == 'orders' ) active @endif">
							<i class="bi bi-handbag me-2 d-flex"></i>
							سفارشات
						</a>
					</li>
					<li class="list-unstyled py-1">
						<a href="{{url('/panel/tracking')}}" class="d-flex p-2 align-items-center rounded-custom">
							<i class="bi bi-box-seam me-2 d-flex"></i>
							پیگیری سفارش
						</a>
					</li>
					<li class="list-unstyled py-1">
						<a href="{{ route('panel.address') }}" class="d-flex p-2 align-items-center rounded-custom @if($seg[1] == 'addresses' ) active @endif">
							<i class="bi bi-map me-2 d-flex"></i>
							آدرس ها
						</a>
					</li>
					<li class="list-unstyled py-1">
						<a href="{{route('panel.favorites')}}" class="d-flex p-2 align-items-center rounded-custom @if($seg[1] == 'favorites' ) active @endif">
							<i class="bi bi-suit-heart me-2 d-flex"></i>
							علاقه مندی ها
						</a>
					</li>
					<li class="list-unstyled py-1">
						<a href="{{route('panel.tickets')}}" class="d-flex p-2 align-items-center rounded-custom @if($seg[1] == 'tickets' ) active @endif">
                            @php $tickcount =App\Models\Ticket::where('user_id',auth()->user()->id)->whereNull('parent_id')->where('status','1')->count();
                            @endphp
							<i class="bi bi-mailbox me-2 d-flex"></i>
							تیکت ها
                            <span class="d-flex p-2 align-items-center rounded-custom">{{$tickcount}}</span>
						</a>
					</li>
					<li class="list-unstyled py-1">
						<a href="{{ route('panel.logout') }}" class="d-flex p-2 align-items-center rounded-custom">
							<i class="bi bi-power me-2 d-flex"></i>
							خروج از حساب
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div> 
