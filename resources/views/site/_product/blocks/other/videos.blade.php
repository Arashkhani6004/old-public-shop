<h2 class="fw-bolder h4 text-dark">
    ویدئو و تیزر مربوط به
    <span>
		"{{$product->title}}"
	</span>
</h2>
<div class="row w-100 m-0 videos pt-3">
    <div class="col-xl-6 p-1">
        @if(isset($product->video_link))
        <div dir="ltr" class="bg-light p-2 border videopro" style="">
            {!! $product->video_link !!}
        </div>
            @else
            <div class="my-5">
                <lottie-player src="https://assets10.lottiefiles.com/private_files/lf30_imyUMa.json"
                               background="transparent" speed="1" class="w-50 h-auto mx-auto" loop autoplay></lottie-player>
            </div>
        @endif
    </div>
</div>
<style>
    .videopro span {
        display: none !important;
    }
    .videopro iframe {
        width: 100% !important;
    }
</style>
