<div class="bg-l pro-services rounded-custom p-1">
	<div class="row w-100 m-0">
        @foreach($sloagens as $slo)
		<div class="col-xl col-lg-4 col-md col-sm-4 col-xs-6 mx-auto p-1">
			<div class="row w-100 m-0">
				<div class="col-sm-3 col-xs-3 align-self-center p-1">
					<img src="{{ @$slo->image ? asset('assets/uploads/content/sloagen/'.$slo->image) : asset('assets/site/images/notfound.png')}}" alt="{{@$slo->title}}" class="w-100 h-auto">
				</div>
				<div class="col-sm-9 col-xs-9 align-self-center p-1">
					<p class="m-0">
					{{@$slo->title}}
					</p>
				</div>
			</div>ss
		</div>
        @endforeach
	</div>
</div>
