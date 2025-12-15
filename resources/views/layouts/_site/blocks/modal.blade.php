<div id="modal" class="modal box-10">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-modal-header w-100 p-0">
            <div class="modal-header img-modal">
                <button type="button" id="close-btn" class="btn-close m-0 p-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-lg-3 p-0">
                <!-- size desktop:1300*750 -->
                <img class="img w-100 d-none d-lg-block" src="{{ asset('assets/uploads/content/set/' . $setting_header->modal_img) }}">
                @if(App\Library\Helper::isMobile())
                    <!-- size mobile:700*950 -->
                    <img class="img w-100 d-block d-lg-none" src="{{ asset('assets/uploads/content/set/' . $setting_header->modal_mobile_img) }}">
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById("modal");
    const closeBtn = document.getElementById("close-btn");
    const modalFileName = "{{ basename($setting_header->modal_img) }}"; // استفاده از basename برای گرفتن فقط نام فایل
    if (localStorage.getItem('modalShownFile') !== modalFileName) {
        modal.classList.add("show");
        localStorage.setItem('modalShownFile', modalFileName);
    }
    closeBtn.onclick = function() {
        modal.classList.remove("show");
    }
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.classList.remove("show");
        }
    }
</script>

<style>
    .img-modal{
        border: unset !important;
    }
    .box-10{
        z-index: 2000;
        translate: 0 100%;
        display: none;
    }
    .box-10.show {
        translate: 0 0;
        display: block;
        animation: b 0.25s ease-in-out;
        opacity: 1;
    }

    @keyframes b{
        0%{
            opacity: 0;
        }
        100%{
            opacity: 1;
        }
    }

    .box-10.show img{
        translate: 0 0;
        display: block;
        animation: d 1s ease-in-out;
        filter: drop-shadow(0px 0px 20px black);
    }

    @keyframes d{
        0%{
            display: none;
            translate: 0 100%;
        }
        100%{
            display: block;
            translate: 0% 0;
        }
    }

    @media (max-width: 576px) {
        .box-10.show img{
            filter: drop-shadow(0px 0px 12px black);
        }
    }
</style>
