@extends('layouts.site.master')
@section('title'){{@$product->title_seo ? $product->title_seo : $product->title}} @stop
@section('image_seo', @$product->images[0]->file ? asset('assets/uploads/content/pro/big/'.@$product->images[0]->file) : asset('assets/uploads/content/set/'.@$setting_header->logo))

@section('og_type', 'product')	

@section('canonical'){{$product->keyword ? $product->keyword : trim(url()->current())}}@stop

@section('description')
    @if($product->description_seo != null)
        {!! $product->description_seo !!}
    @else
        {!! strip_tags(\Illuminate\Support\Str::limit($product->description,100)) !!}
    @endif
@stop

@section('torob')
    <meta name="product_id" content="{{@$product->id}}">
    <meta name="product_name" content="{{@$product->title ? $product->title : @$product->title_seo }}">
    @if(count(@$product->variable) > 0)
        @if(@$product->variable[0]->discounted_price > 0)
            <meta name="productprice" content="{{@$product->variable[0]->discounted_price}}">
            <meta name="productoldprice" content="{{@$product->variable[0]->price}}">
        @else
            <meta name="productprice" content="{{@$product->variable[0]->price}}">
        @endif
    @else
        @if(@$product->price != null)
            <meta name="productprice" content="{{@$product->price}}">
            <meta name="productoldprice" content="{{@$product->old_price}}">
        @else
            <meta name="productprice" content="{{@$product->old_price}}">
        @endif
    @endif
    <meta name="availability" content="{{@$product->count > 0 ? 'instock' : 'outofstock'}}">
@endsection

@section('content')
    @include('layouts.message-swal')
    <main class="content">
        <div class="product pro-details">
            <div class="bg-b-light py-3">
                <div class="container">
                     @if(App\Library\Helper::isMobile())
                    <div class="list-unstyled p-1 d-block d-md-none">
                        <h1 class="h4 my-0 ismb">
                            @if($product->title2) {{@$product->title2}} @else {{@$product->title}} @endif
                        </h1>
                    </div>
                    @endif
                    <div class="row w-100 m-0">
                        <div class="col-sm-12 p-1">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('/')}}">
                                            خانه
                                        </a>
                                    </li>
                                    @if($product->cats->count() >0)
                                        <li class="breadcrumb-item">
                                            <a href="{{route('site.product.list',['id'=>$product->cats[0]->url])}}">
                                                {{@$product->cats[0]->title}}
                                            </a>
                                        </li>
                                    @endif
                                    @if($product->cats->count() >1)
                                        <li class="breadcrumb-item">
                                            <a href="{{route('site.product.list',['id'=>$product->cats[1]->url])}}">
                                                {{@$product->cats[1]->title}}
                                            </a>
                                        </li>
                                    @endif
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{@$product->title}}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-sm-12 p-1">
                            @include('site.product.blocks.header')
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white other py-3 px-1">
                <div class="container">
                    @include('site.product.blocks.other')
                      @if($relate->count() != 0)
                        @include('site.product.blocks.related')
                    @endif
                    @if($complement->count() != 0)
                        @include('site.product.blocks.complement')
                    @endif
                </div>
            </div>
        </div>
        <div class="position-fixed bg-white mobile-price px-2 py-1 bottom-0 end-0 start-0 d-lg-none d-sm-block d-xs-block">
            <div class="row w-100 m-0">
                <div class="col-sm-12 col-xs-12 m-auto align-self-center px-1">
                    @if(count($product->variable) > 0  && $product->count > 0)
                    <div v-if="variable == 1">

                        <div class="col-xxl-8 col-lg-11 mx-auto p-1 ">
                            <button type="submit"
                                class="btn  w-100 btn-pro-buy d-flex align-items-center justify-content-center " @click="addToCart2({{$product->id}},quantity,true,variableId)">
                                <i class="bi bi-plus h2 my-0 d-flex me-2"></i>
                                افزودن به سبد خرید
                            </button>
                        </div>
                    </div>
                    <div v-else>
                        <div class="col-xxl-8 col-lg-11 mx-auto p-1  ">
                            <button disabled type="submit"
                                class="btn  w-100 btn-pro-buy d-flex align-items-center justify-content-center " >
                                ناموجود
                            </button>
                        </div>
                    </div>
                @else
                    @if( $product->count > 0)

                       <div class=" d-flex align-items-center justify-content-between">
                            <div class=" p-1 ">
                                    <button type="submit"
                                        class="btn  w-100 btn-pro-buy d-flex align-items-center justify-content-center " @click="addToCart2({{$product->id}},quantity,true,)" style="font-size: 14px;">
                                        <i class="bi bi-plus h2 my-0 d-flex me-2"></i>
                                        افزودن به سبد خرید
                                    </button>
                                </div>
                                <div class=" p-1 d-flex text-end">
                                    @if($product->price !== 'ندارد' && $product->price !== null && $product->price !== 0 && $product->count > 0)
                                        <div class="">
                                            <div class="d-flex justify-content-end">
                                                <del class=" d-flex my-1 text-secondary" style="font-size: 12px;">
                                                {{number_format(@$product->old_price)}}تومان
                                                </del>
                                                
                                            </div>
                                            <p class=" my-1 text-b">
                                                {{number_format(@$product->price)}}تومان
                                            </p>
                                            @elseif($product->old_price !== 'ندارد' && $product->count > 0 && $product->old_price != 0 )
                                            <p class=" my-1 text-b">
                                                {{number_format(@$product->old_price)}}تومان
                                            </p>
                                            @else
                                            <p class="ismb h2 my-1 text-b">
                                                تماس بگیرید
                                            </p>
                                        </div>
                                    @endif
                                </div>  
                       </div>
                    @endif
                @endif
                    {{-- <button type="submit" class="btn btn-pro-buy w-100" @click="addToCart2({{$product->id}},quantity,true,specificationId)">
                        افزودن به سبد خرید
                    </button> --}}
                </div>

                {{-- <div class="col-sm-6 col-xs-6 text-end align-self-center p-1">
                    <p class="my-0 text-secondary">

                        @if($product->price_first['old'] !== 'ندارد')
                            <del class="fw-bolder me-2">
                                {!! $product->price_first['old'] !!}
                            </del>
                        @endif
                        @if(round($product->calcute) != 0)
                            <span class="badge bg-b rounded-custom">
						{{round($product->calcute)}}%
					</span>
                        @endif
                    </p>
                    @if($product->price_first['price'] !== 'ندارد')
                        <p class="my-0 ismb text-b">
                            {!! $product->price_first['price'] !!}
                        </p>
                    @else($product->count <= 1)
                        <p class="my-0 ismb text-b">
                            تماس بگیرید
                        </p>
                    @endif
                </div> --}}
            </div>
        </div>
    </main>

@stop
@section('js')
    @if(count($questions)>0)
        <script type="application/ld+json">
{
	"@context": "https://schema.org",
	"@type": "FAQPage",
	"mainEntity": [
		@foreach($questions as $key => $answer) {
			"@type": "Question",
			"name": "{!! strip_tags($answer->question)!!}",
			"acceptedAnswer": {
				"@type": "Answer",
				"text": "{!! strip_tags($answer->answer)!!}"
			}
		}
		@if(count($questions) == $key + 1) @else, @endif
            @endforeach
            ]
        }
</script>
    @endif
    <script type="application/ld+json">
{
	"@context": "https://schema.org/",
	"@type": "Product",
	"name": "{{@$product->title}}",
	"image": "{{asset('assets/uploads/content/pro/big/'.@$product->image[0]->file)}}",
	"description": "{{@$product->description_seo}}.",
	"brand": "{{@$product->title}}",
	"aggregateRating": {
		"@type": "AggregateRating",
		"ratingValue": "4.90",
		"bestRating": "5",
		"worstRating": "1",
		"ratingCount": "490"
	}
}
</script>


@endsection
