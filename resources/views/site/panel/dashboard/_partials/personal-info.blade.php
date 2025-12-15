<div class="col-lg-4 col-12 p-1 py-lg-0 py-1">
    <div class="box-dash shadow-sm">
        <div class="icon">
            <i class="bi bi-info-square d-flex fs-5"></i>
        </div>
        <p class="fm-b m-0 mt-2">
            اطلاعات کاربری
        </p>
        <ul class="p-0 m-0 mt-2">
            <li class="list-unstyled my-1 d-flex align-items-center justify-content-between">
                <p class="m-0 fm-li small">نام : <span class="fm-md"> {{ @$user->name }}</span></p>
            </li>
            <li class="list-unstyled my-1 d-flex align-items-center justify-content-between">
                <p class="m-0 fm-li small"> شماره تماس : <span class="fm-md"> {{ @$user->mobile }}</span></p>
            </li>
        </ul>
        <a href="{{ route('panel.edit') }}" class="edit-info">
            <i class="bi bi-pencil-square d-flex fs-5"></i>
        </a>
    </div>
</div>
<div class="col-lg-4 col-12 p-1 py-lg-0 py-1">
    <div class="box-dash shadow-sm">
        <div class="icon">
            <i class="bi bi-handbag d-flex fs-5"></i>
        </div>
        <p class="fm-b m-0 mt-2">
            سفارشات
        </p>
        <ul class="p-0 m-0 mt-2">
            <li class="list-unstyled my-1 d-flex align-items-center justify-content-between">
                <p class="m-0 fm-md small">{{ @$user->orders->count() }}<span class="fm-li ms-1">سفارش</span></p>
            </li>
            <li class="list-unstyled my-1 d-flex align-items-center justify-content-between">
                <a href="{{ route('panel.orders') }}" class="d-flex align-items-center fm-re text-dark small">
                    مشاهده همه
                    <i class="bi bi-arrow-left-short d-flex"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="col-lg-4 col-12 p-1 py-lg-0 py-1">
    <div class="box-dash shadow-sm">
        <div class="icon">
            <i class="bi bi-mailbox d-flex fs-5"></i>
        </div>
        <p class="fm-b m-0 mt-2">
            تیکت ها
        </p>
        @php
        $tickcount = App\Models\Ticket::where('user_id', auth()->user()->id)
                ->whereNull('parent_id')
                ->where('status', '1')
                ->count();
        @endphp
        <ul class="p-0 m-0 mt-2">
            <li class="list-unstyled my-1 d-flex align-items-center justify-content-between">
                <p class="m-0 fm-md small">{{ $tickcount }}<span class="fm-re ms-1">تیکت</span></p>
            </li>
            <li class="list-unstyled my-1 d-flex align-items-center justify-content-between">
                <a href="{{ route('panel.tickets') }}" class="d-flex align-items-center fm-re text-dark small">
                    مشاهده همه
                    <i class="bi bi-arrow-left-short d-flex"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
