<div class="modal fade" id="shareBlog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title " id="exampleModalLabel">اشتراک گذاری</p>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="d-flex align-items-center justify-content-around">
                    <li class="list-unstyled me-2">
                        <a target="_blank" href="https://t.me/share/url?url={{ url('/blog-detail/' . @$blog->id) }}">
                            <i class="bi bi-telegram telegram rounded-3 p-1 h4 my-0 d-flex"></i>
                        </a>
                    </li>
                    <li class="list-unstyled me-2">
                        <a target="_blank" href="whatsapp://send?text={{ url('/blog-detail/' . @$blog->id) }}">
                            <i class="bi bi-whatsapp whatsapp rounded-3 p-1 h4 my-0 d-flex"></i>
                        </a>
                    </li>
                    <li class="list-unstyled me-2">
                        <a href="https://www.instagram.com/?url={{ url('/blog-detail/' . @$blog->id) }}">
                            <i class="bi bi-instagram instagram rounded-3 p-1 h4 my-0 d-flex"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
