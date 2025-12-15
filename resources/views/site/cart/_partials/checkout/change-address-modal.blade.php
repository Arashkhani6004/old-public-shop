<div class="modal fade" id="ChangeAddresModal" tabindex="-1" aria-labelledby="ChangeAddresModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-custom addresses">
        <div class="modal-header">
            <p class="modal-title fm-b" id="addAddresModalLabel">
                تغییر آدرس
            </p>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @if ($addresses != null)
                @foreach ($addresses as $key => $row)
                    <div class="col-sm-12 p-1">
                        <div class="address-item p-2 @if ($row->default_address == 1) active @endif">
                            <div class="d-flex align-items-center justify-content-between">
                                @if ($row->default_address == 1)
                                    <a href="{{ URL::action('Site\ShopController@defaultAddress', $row->id) }}"
                                        class="m-0 d-flex align-items-center form-check small text-dark me-auto max-content">
                                        <i class="bi bi-check d-flex h5 me-1 my-0"></i>
                                        آدرس پیش فرض
                                    </a>
                                @else
                                    <a href="{{ URL::action('Site\ShopController@defaultAddress', $row->id) }}"
                                        class="m-0 d-flex align-items-center form-check small text-dark me-auto max-content">
                                        <i class="bi bi-circle d-flex h5 me-1 my-0"></i>
                                        انتخاب به عنوان پیش فرض
                                    </a>
                                @endif
                            </div>
                            <p class="fm-md m-0 mt-2">

                                {{ @$row->state->name }}
                                |
                                {{ @$row->city->name }}
                            </p>
                            <p class="fm-re m-0 small mt-1">
                                {{ @$row->location }}
                            </p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
</div>