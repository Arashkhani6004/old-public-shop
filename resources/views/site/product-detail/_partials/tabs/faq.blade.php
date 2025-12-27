<p class="fm-b d-flex align-items-center">
    <i class="bi bi-caret-left-fill fs-4 me-1 d-flex primary-color"></i>
    سوالات متداول راجع به
    {{ @$product->title }}
</p>
@if (count($questions) > 0)
    <div class="accordion faq-section" id="accordionExample12">
        @foreach ($questions as $key => $row)
            <div class="accordion-item">
                <div class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne{{ $row->id }}" aria-expanded="false"
                        aria-controls="collapseOne{{ $row->id }}">
                        {!! @$row->question !!}
                    </button>
                </div>
                <div id="collapseOne{{ $row->id }}" class="accordion-collapse collapse"
                    data-bs-parent="#accordionExample12">
                    <div class="accordion-body">
                        {!! @$row->answer !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="col-xxl-2 col-xl-3 col-6 m-auto p-0">
        <img src="{{ asset('assets/site/images/empty-states/des-empty.svg') }}" class="w-100" alt="empty"
            title="empty" loading="lazy" />
    </div>
    <p class="text-center text-dark small">
        سوال متداولی راجع به این محصول وجود ندارد!
    </p>
@endif
