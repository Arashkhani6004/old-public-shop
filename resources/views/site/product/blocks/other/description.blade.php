<p class="h5 ismb d-flex align-items-center">
	<i class="bi bi-caret-left-fill text-a me-2"></i>
	توضیحات محصول
</p>
<div class="description px-1">
	@if($product->description != null)
	{!! @$product->description !!}
	@else
	<div class="my-5">
		<lottie-player src="https://assets9.lottiefiles.com/private_files/lf30_QR3oyU.json" background="transparent"
			speed="1" class="w-25 h-auto mx-auto" loop autoplay></lottie-player>
	</div>
	@endif
        @if(@$product->tags->count() > 0)
	<p class="ismb">
		تگ ها
	</p>
	<ul class="p-0 m-0">
        @foreach(@$product->tags as $tag)
		<li style="display: inline-table; padding: 2.5px 0.5px">
			<a href="{{url('/tag/'.str_replace(' ', '-',$tag->url))}}" class="d-flex border px-2 py-1 rounded-3 text-secondary bg-white shadow-sm" style="font-size:0.8rem;">
                {{@$tag->title}}			</a>
		</li>
        @endforeach

	</ul>
        @endif
</div>
