<div class="col-sm-6 align-self-center p-1">
	<ul class="p-1 m-0 d-flex">
		<li class="list-unstyled me-2 like-cu">
			<div>
				<i class="bi bi-suit-heart-fill rounded-3 p-1 h4 my-0"></i>
			</div>

		</li>
		<li class="list-unstyled me-2">
			<a target="_blank" href="https://t.me/share/url?url={{url('/blog-detail/'.@$blog->id)}}">
				<i class="bi bi-telegram telegram rounded-3 p-1 h4 my-0 d-flex"></i>
			</a>
		</li>
		<li class="list-unstyled me-2">
			<a target="_blank" href="whatsapp://send?text={{url('/blog-detail/'.@$blog->id)}}">
				<i class="bi bi-whatsapp whatsapp rounded-3 p-1 h4 my-0 d-flex"></i>
			</a>
		</li>
		<li class="list-unstyled me-2">
			<a href="https://www.instagram.com/?url={{url('/blog-detail/'.@$blog->id)}}">
				<i class="bi bi-instagram instagram rounded-3 p-1 h4 my-0 d-flex"></i>
			</a>
		</li>

		<li class="list-unstyled me-2">
			@include('site.blog.blocks.share')
		</li>
	</ul>
</div>
<div class="col-sm-6 align-self-center p-1">
	<ul class="p-1 m-0 d-flex align-items-center justify-content-end">
		<li class="list-unstyled ms-2">
			<div class="border d-flex align-items-center px-2 rounded-3 text-secondary">
                {{jdate('d F Y',@$blog->updated_at->timestamp)}}
				<i class="bi bi-calendar-week py-2 h5 my-0 d-flex ms-2"></i>
			</div>
		</li>
		<li class="list-unstyled ms-2">
			<div class="border d-flex align-items-center px-2 rounded-3 text-secondary">
                {{$blog->view}}
				<i class="bi bi-eye py-2 h5 my-0 d-flex ms-2"></i>
			</div>
		</li>
{{--		<li class="list-unstyled ms-2">--}}
{{--			<div class="border d-flex align-items-center px-2 rounded-3 text-secondary">--}}
{{--				۵۴--}}
{{--				<i class="bi bi-suit-heart py-2 h5 my-0 d-flex ms-2"></i>--}}
{{--			</div>--}}
{{--		</li>--}}
	</ul>
</div>
@section('js')
<script>
			$(function() {
				$(".bi-suit-heart-fill").click(function() {
					$(".bi-suit-heart-fill,span").toggleClass("press", 0);
				});
			});
	</script>
@stop
