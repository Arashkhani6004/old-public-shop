
<!-- replyModal -->
s
			<div class="modal-body bg-light">
                <form method="post" action="{{URL::action('Site\HomeController@postReply')}}"
                      enctype="multipart/form-data" class="m-0">
                    {{ csrf_field() }}
                    <input type="hidden" name="commentable_id" value="{{$product->id}}">
                    <input type="hidden" name="commentable_type" value="{{"App\Models\Product"}}">
                    <input type="hidden" name="parent_id" value="{{$comment->id}}">
					<div class="row m-0 w-100">
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
							<div class="form-floating">
								<textarea class="form-control border-0" placeholder="متن نظر شما" id="textarea1" name="content"
									style="height: 7.5rem"></textarea>
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

