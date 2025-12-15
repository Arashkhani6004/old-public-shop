@if (count($product->variable) > 0)
<p class="fm-b m-0 mt-0  mb-1">انتخاب رنگ محصول</p>
<ul class="nav nav-pills mb-4 colors" id="pills-tab" role="tablist">
    @foreach($product->variable as $key => $v)
    <li class="nav-item" role="presentation">
        <button class="nav-link @if ($key == 0) active @endif color-tab" style="background: red;" id="pills-{{ $v->id }}-tab" data-bs-toggle="pill"
            data-bs-target="#pills-{{ $v->id }}" type="button" role="tab" aria-controls="pills-{{ $v->id }}" aria-selected=" @if ($key == 0) true @else false @endif">

        </button>
    </li>
    @endforeach
</ul>
@endif
