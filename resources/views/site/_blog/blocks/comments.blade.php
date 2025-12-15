<p class="h5 ismb d-flex align-items-center">
	<i class="bi bi-caret-left-fill text-a me-2"></i>
	نظرات کاربران
</p>
<div class="comments">
	<div class="row w-100 m-0">
		<div class="col-xl-4 col-lg-5 col-md-6 p-1">
			<div class="bg-l p-3 rounded-custom">
				<form method="post" action="{{URL::action('Site\HomeController@postComment')}}"
					enctype="multipart/form-data" class="m-0">
					{{ csrf_field() }}
					<input type="hidden" name="commentable_id" value="{{$blog->id}}">
					<input type="hidden" name="commentable_type" value="{{"App\Models\Content"}}">
					<div class="row m-0 w-100">
						<div class="col-md-12 p-1">
							<p class="ismb text-b m-0">
								فرم ارسال نظر
							</p>
						</div>
						<div class="col-md-12 p-1">
							<div class="form-floating">
								<input type="text" class="form-control border-0" id="input1" name="title"
									placeholder="عنوان نظر شما">
								<label for="input1">
									عنوان نظر شما
								</label>
							</div>
						</div>
						<div class="col-md-12 p-1">
							<div class="star-rating bg-white">
								<input type="radio" id="5-stars" name="star" value="5" />
								<label for="5-stars" class="star">
									<i class="bi bi-star-fill d-flex"></i>
								</label>
								<input type="radio" id="4-stars" name="star" value="4" />
								<label for="4-stars" class="star">
									<i class="bi bi-star-fill d-flex"></i>
								</label>
								<input type="radio" id="3-stars" name="star" value="3" />
								<label for="3-stars" class="star">
									<i class="bi bi-star-fill d-flex"></i>
								</label>
								<input type="radio" id="2-stars" name="star" value="2" />
								<label for="2-stars" class="star">
									<i class="bi bi-star-fill d-flex"></i>
								</label>
								<input type="radio" id="1-star" name="star" value="1" />
								<label for="1-star" class="star">
									<i class="bi bi-star-fill d-flex"></i>
								</label>
							</div>
						</div>
						<div class="col-md-12 p-1">
							<div class="form-floating">
								<textarea class="form-control border-0" placeholder="متن نظر شما" id="textarea1"
									name="content" style="height: 7.5rem"></textarea>
								<label for="textarea1">
									متن نظر شما
								</label>
							</div>
						</div>
						<div class="col-xxl-6 ms-auto p-1">
							<button type="submit"
								class="btn btn-success rounded-custom w-100 d-flex align-items-center justify-content-center">
								<i class="bi bi-check2-circle d-flex me-2 h5 my-0"></i>
								ثبت نظر
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		{{--  --}}
		<div class="col-xl-8 col-lg-7 col-md-6 p-1">
			@if(count($comments) > 0)
			<div class="bg-l p-3 rounded-custom">
				<div class="row m-0 w-100">
					<div class="col-md-12 p-1">
						<p class="ismb">
							نظرات شما در مورد این مقاله
						</p>
					</div>
					<div class="col-md-12 p-0">
						@foreach($comments as $comment)
						<div class="p-1">
							<div class="card p-3 border-0 rounded-3">
								<div class="row w-100 m-0">
									<div class="col-xxl-12 p-1">
										<p class="h5 ismb my-1 d-flex align-items-center">
											<i class="bi bi-person-circle me-2 h5 my-0"></i>
											{{@$comment->user->name.' '.@$comment->user->family}}
										</p>
									</div>
									<div class="col-xxl-12 p-1">
										<p class="h5 fw-bolder">
											{{@$comment->title}}
										</p>
										<div class="text-justify text-secondary">
											<p class="m-0">
												{{@$comment->content}}
											</p>
										</div>
									</div>
									<div class="col-xxl-12 p-1">
										<p class="h6 text-secondary my-1 d-flex align-items-center">
											<span class="d-flex align-items-center">
												<i class="bi bi-calendar3 me-2 h5 my-0"></i>
												{{jdate('Y/m/d',$comment->created_at->timestamp)}}
											</span>
											<span class="mx-2">
												-
											</span>
											<span class="d-flex align-items-center">
												{{jdate('H:i',$comment->created_at->timestamp)}}
											</span>
											<span class="mx-2">
												-
											</span>
											<a  data-bs-toggle="modal"
												data-bs-target="#replyModal{{@$comment->id}}"
												class="btn btn-sm text-secondary d-flex align-items-center">
												<i class="bi bi-reply-fill me-2 h5 my-0"></i>
												پاسخ
											</a>
										<div class="modal fade" id="replyModal{{@$comment->id}}" tabindex="-1"
											aria-labelledby="replyModalLabel" aria-hidden="true">
											<div
												class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="replyModalLabel">
															پاسخ به نظر
														</h5>
														<button type="button" class="btn-close"
															data-bs-dismiss="modal"
															aria-label="Close"></button>
													</div>
													@include('site.blog.blocks.replyModal')
												</div>
											</div>
										</div>
									</div>
									</p>
								</div>
								@foreach($comment->replies as $reply)
								<div class="col-xxl-11 ms-auto p-1">
									<div class="card bg-l p-3 border-0 rounded-3">
										<div class="row w-100 m-0">
											<div class="col-xxl-12 p-1">
												<p class="h5 ismb my-1 d-flex align-items-center">
													<i class="bi bi-person-circle me-2 h5 my-0"></i>
													{{@$reply->user->name.' '.@$reply->user->family}}
												</p>
											</div>
											<div class="col-xxl-12 p-1">
												<p class="h5 fw-bolder">
													{{@$reply->title}}
												</p>
												<div class="text-justify text-secondary">
													<p class="m-0">
														{{@$reply->content}}
													</p>
												</div>
											</div>
											<div class="col-xxl-12 p-1">
												<p class="h6 text-secondary my-1 d-flex align-items-center">
													<span class="d-flex align-items-center">
														<i class="bi bi-calendar3 me-2 h5 my-0"></i>
														{{jdate('Y/m/d',$reply->created_at->timestamp)}}
													</span>
													<span class="mx-2">
														-
													</span>
													<span class="d-flex align-items-center">
														{{jdate('H:i',$reply->created_at->timestamp)}}
													</span>
													<span class="mx-2">
														-
													</span>
													<a data-bs-toggle="modal"
														data-bs-target="#replyModal{{@$reply->id}}"
														class="btn btn-sm text-secondary d-flex align-items-center">
														<i class="bi bi-reply-fill me-2 h5 my-0"></i>
														پاسخ
													</a>
												<div class="modal fade" id="replyModal{{@$reply->id}}"
													tabindex="-1" aria-labelledby="replyModalLabel"
													aria-hidden="true">
													<div
														class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title"
																	id="replyModalLabel">
																	پاسخ به نظر
																</h5>
																<button type="button" class="btn-close"
																	data-bs-dismiss="modal"
																	aria-label="Close"></button>
															</div>
															@include('site.blog.blocks.replyModal')
														</div>
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>

						</div>
						@endforeach
					</div>
				</div>
			</div>
			@else
			<div class="my-5">
				<lottie-player src="https://assets7.lottiefiles.com/private_files/lf30_ryphgzdj.json"
					background="transparent" speed="1" class="w-50 h-auto mx-auto" loop autoplay></lottie-player>
			</div>
			@endif
		</div>
	</div>
</div>
