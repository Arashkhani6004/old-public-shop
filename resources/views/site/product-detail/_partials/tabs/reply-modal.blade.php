<div class="modal fade" id="exampleModal{{ @$comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 p-0">
                <button type="button" class="btn bg-transparent border-0 ms-auto shadow-none" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="bi bi-x-lg fs-4 text-light"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="comment-form ">
                    <form method="post" action="{{ URL::action('Site\HomeController@postReply') }}"
                        enctype="multipart/form-data" class="m-0">
                        {{ csrf_field() }}
                        <input type="hidden" name="commentable_id" value="{{ $product->id }}">
                        <input type="hidden" name="commentable_type" value="{{ 'App\Models\Product' }}">
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label small mb-1 fm-li">
                                موضوع
                            </label>
                            <input type="text" class="form-control" name="title" id="exampleFormControlInput1"
                                placeholder="موضوع">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label small mb-1 fm-li">نظر</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-form position-relative">ثبت</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
