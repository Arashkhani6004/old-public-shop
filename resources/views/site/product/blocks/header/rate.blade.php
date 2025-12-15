<div class="d-flex align-items-center justify-content-between rate p-2 bg-light">
	<div class="d-flex align-items-center">
		<div class="star-ratings-sprit mb-1">
            @php
                $star =
                App\Models\Comment::where('commentable_id',$product->id)->where('commentable_type','App\Models\Product')->whereNull('parent_id')->whereNotNull('star')->where('status','1')->pluck('star')->toArray();

                //Our array, which contains a set of numbers.
                //Calculate the average.

                if (array_sum(@$star) != 0 || count(@$star) != 0){
                    @$average = array_sum(@$star) / count(@$star);
                }
                else{
                    $average = 0;
                }


            @endphp
			<span class="star-ratings-sprit-rating" style="width:{{(@$average)*20}}%;"></span>
		</div>

		<span class="badge bg-secondary ms-2">
				 @if (is_nan($average) || is_infinite($average))
                {{0}}
            @else
                {{@$average}}
            @endif
		</span>
		<span class="bg-outline ms-2">
			({{@$comments_count.' '. 'نظر'}} )
		</span>
	</div>
	<ul class="p-0 m-0 d-flex align-items-center">
		<li class="list-unstyled ms-3">
			<a target="_blank" href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
				<i class="bi bi-share text-dark d-flex h5 my-0"></i>
			</a>


		</li>
        @php

            $likes =
            \App\Models\Like::where('likeable_id',$product->id)->where('likeable_type','App\Models\Product')->where('user_id',\Illuminate\Support\Facades\Auth::id())->first();

        @endphp
        @if(!isset($likes))
            <form action="{{URL::action('Panel\LikeController@postLike')}}" method="post" class="m-0">
                @csrf
                <input type="hidden" name="likeable_type" value="{{'App\Models\Product'}}">
                <input type="hidden" name="likeable_id" value="{{$product->id}}">
                <li class="float-end list-unstyled ms-3">
                    <button type="submit" class="btn p-0 btn-lg" id=heart>
                        <i class="bi bi-suit-heart  d-flex h5 my-0"></i>
                    </button>
                </li>
            </form>
        @else
            <li class="float-end list-unstyled ms-3">
                <a href="{{URL::action('Panel\LikeController@getDeleteLike',$likes->id)}}"
                   class="btn p-0 btn-lg">
                    <i class="bi bi-suit-heart text-danger d-flex h5 my-0"></i>
                </a>
            </li>
        @endif
	</ul>
</div>
