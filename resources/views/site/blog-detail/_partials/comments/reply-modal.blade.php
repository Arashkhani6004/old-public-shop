<div class="modal fade" id="exampleModal{{ @$comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 p-0">
                <button type="button" class="btn bg-transparent border-0 ms-auto shadow-none" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="bi bi-x-lg fs-4 "></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ URL::action('Site\HomeController@postReply') }}"
                    enctype="multipart/form-data" class="m-0">
                    {{ csrf_field() }}
                    <input type="hidden" name="commentable_id" value="{{ $blog->id }}">
                    <input type="hidden" name="commentable_type" value="{{ 'App\Models\Content' }}">
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    @include('site.blog-detail._partials.comments.form')
                </form>
            </div>

        </div>
    </div>
</div>
