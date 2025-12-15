<!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('layouts.site.blocks.head')

<body>
<div id="shop68" v-cloak>
	@include('layouts.site.blocks.menu')
	@include('layouts.site.blocks.menu-app')

	<!-- start content -->
	<main class="content">
		<div class="panel-user">
			<div class="bg-b-light py-3">
				<div class="container">
					<div class="row w-100 m-0">
						<div class="col-sm-12 p-1 px-xs-2">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="{{url('/')}}">
											خانه
										</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">
										داشبورد
									</li>
								</ol>
							</nav>
						</div>
						<div class="col-sm-12 p-0">
							<div class="row w-100 m-0">
								<div class="col-xl-3 col-md-4 col-sm-12 p-1">
									@include('site.panel.blocks.side-panel')
								</div>
								<div class="col-xl-6 col-md-4 col-sm-12 p-1">
									@yield('content')
								</div>
                                @if($seg[1] != 'favorites' )
								<div class="col-xl-3 col-md-4 col-sm-12 p-1">
									@include('site.panel.blocks.favorites')
								</div>
                                @endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<!-- end content -->

	@include('layouts.site.blocks.footer')
</div>
	@include('layouts.site.blocks.script')
</body>

</html>
