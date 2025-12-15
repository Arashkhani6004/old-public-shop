<a  data-bs-toggle="modal" data-bs-target="#replySecondModal"
	class="btn btn-sm text-secondary d-flex align-items-center">
	<i class="bi bi-reply-fill me-2 h5 my-0"></i>
	پاسخ
</a>
<!-- replySecondModal -->
<div class="modal fade" id="replySecondModal" tabindex="-1" aria-labelledby="replySecondModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="replySecondModalLabel">
					پاسخ به نظر
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body bg-light">
				<form action="" class="m-0">
					<div class="row m-0 w-100">
						<div class="col-md-12 p-1">
							<div class="form-floating">
								<input type="text" class="form-control border-0" id="input1"
									placeholder="عنوان نظر شما">
								<label for="input1">
									عنوان نظر شما
								</label>
							</div>
						</div>
						<div class="col-md-12 p-1">
							<div class="form-floating">
								<textarea class="form-control border-0" placeholder="متن نظر شما" id="textarea1"
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
		</div>
	</div>
</div>