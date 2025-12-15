<div class="side-box">
    <ul class="p-0 m-0">
        <li class="list-unstyled py-1">
            <a href="{{ route('panel.dashboard') }}" class="d-flex p-2 align-items-center rounded-12">
                <i class="bi bi-speedometer2 me-2 d-flex"></i>
                داشبورد
            </a>
        </li>
        <li class="list-unstyled py-1">
            <a href="{{ route('panel.edit') }}" class="d-flex p-2 align-items-center rounded-12">
                <i class="bi bi-pencil-square me-2 d-flex"></i>
                ویرایش اطلاعات
            </a>
        </li>
        <li class="list-unstyled py-1">
            @php
            $tickcount = App\Models\Ticket::where('user_id', auth()->user()->id)
                            ->whereNull('parent_id')
                            ->where('status', '1')
                            ->count();
                @endphp
            <a href="{{ route('panel.tickets') }}" class="d-flex p-2 align-items-center rounded-12">
                <i class="bi bi-mailbox me-2 d-flex"></i>
                تیکت ها
                <span class="ms-1 fm-re">({{ $tickcount }})</span>
            </a>
        </li>
        <li class="list-unstyled py-1">
            <a href="{{ route('panel.orders') }}" class="d-flex p-2 align-items-center rounded-12 ">
                <i class="bi bi-handbag me-2 d-flex"></i>
                سفارشات
            </a>
        </li>
        <li class="list-unstyled py-1">
            <a href="{{ route('panel.address') }}" class="d-flex p-2 align-items-center rounded-12 ">
                <i class="bi bi-map me-2 d-flex"></i>
                آدرس ها
            </a>
        </li>
        <li class="list-unstyled py-1">
            <a href="{{ route('panel.logout') }}" class="d-flex p-2 align-items-center rounded-12">
                <i class="bi bi-power me-2 d-flex"></i>
                خروج از حساب
            </a>
        </li>
    </ul>
</div>
