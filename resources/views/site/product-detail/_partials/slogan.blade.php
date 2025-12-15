@if ($sloagens->count() > 0)
    <div class="slogan">
        <ul class="m-0 p-0">
            @foreach ($sloagens as $slo)
                <li class="list-unstyled d-flex align-items-center fm-re small">
                    <img src="{{ @$slo->image ? asset('assets/uploads/content/sloagen/' . $slo->image) : asset('assets/site/images/notfound.png') }}"
                        width="30" alt="{{ @$slo->title }}" title="{{ @$slo->title }}" loading="lazy" class="me-2">
                    {{ @$slo->title }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
