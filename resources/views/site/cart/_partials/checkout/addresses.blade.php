@if (\Illuminate\Support\Facades\Auth::check())
    <button type="submit" class="btn btn-text text-success p-0 btn-sm small border-0 mb-2 d-flex align-items-center"
        data-bs-toggle="modal" data-bs-target="#addAddresModal">
        <i class="bi bi-plus-lg d-flex me-1"></i>
        افزودن آدرس
    </button>

    <div class="address-item p-2 mb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="form-check">
                <label class="form-check-label font-small fm-re" for="flexCheckDefault3">
                    آدرس جهت ارسال
                </label>
            </div>
            @if ($default_address !== null)
                <a class="text-secondary d-flex align-items-center font-small fm-re" data-bs-toggle="modal"
                    data-bs-target="#ChangeAddresModal" role="button" aria-expanded="false"
                    aria-controls="collapseExample">
                    <i class="bi bi-pencil d-flex me-1"></i>
                    تغییر
                </a>
            @endif
        </div>
        @if ($default_address !== null)
            <p class="fm-md m-0 mt-2 small">
                {{ @$default_address->state->name }}
                |
                {{ @$default_address->city->name }}
            </p>
            <p class="fm-re m-0 font-small mt-1">
                {{ @$default_address->location }}
            </p>
        @else
            <p class="text-secondary text-center font-small m-0 my-2">آدرس موجود نیست...!
            </p>
        @endif
    </div>

@endif
