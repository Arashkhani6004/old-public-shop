<div class="sort-form mb-2">
    <ul class="p-0 m-0">
        <li class="list-unstyled">
            <div class="form-check form-switch">
                <input class="form-check-input" value="1" type="checkbox" role="switch" id="discounted"
                    @change="filterProducts()" v-model = "discount" />
                <label class="form-check-label w-100 small" for="discounted">محصولات تخفیف دار</label>
            </div>
        </li>
    </ul>
</div>
<div class="sort-form mb-2">
    <ul class="p-0 m-0">
        <li class="list-unstyled">
            <div class="form-check form-switch">
                <input class="form-check-input" value="1" type="checkbox" role="switch" id="available"
                    @change="filterProducts()" v-model = "available" />
                <label class="form-check-label w-100 small" for="available">محصولات موجود</label>
            </div>
        </li>
    </ul>
</div>
{{-- <div class="accordion-item">
    <p class="accordion-header">
        <button class="accordion-button collapsed dynamic-color" type="button" data-bs-toggle="collapse"
            data-bs-target="#filter-two" aria-expanded="false" aria-controls="filter-two">
            دسته بندی
        </button>
    </p>
    <div id="filter-two" class="accordion-collapse collapse" data-bs-parent="#accordionFilter">
        <div class="accordion-body categories">
            @include('site.product-list.components.category')
        </div>
    </div>
</div> --}}
<div class="accordion-item">
    <p class="accordion-header">
        <button class="accordion-button collapsed dynamic-color" type="button" data-bs-toggle="collapse"
            data-bs-target="#filter-four" aria-expanded="false" aria-controls="filter-four">
            برندها
        </button>
    </p>
    <div id="filter-four" class="accordion-collapse collapse" @if (!App\Library\Helper::isMobile()) data-bs-parent="#accordionFilter" @else data-bs-parent="#accordionFlushExampleMobile" @endif >
        <div class="accordion-body p-2">
            <div class="search position-relative mb-2">
                <input type="search" v-on:keyup="getBrands" v-model="searchValue" class="form-control form-control-sm"
                    placeholder="جستجو در فیلتر ها">
                <button type="submit"
                    class="btn btn-search bg-transparent p-2 shadow-none border-0 position-absolute top-0 bottom-0 end-0">
                    <i class="bi bi-search d-flex"></i>
                </button>
            </div>
            <ul class="p-0 m-0 px-2">
                <li class="list-unstyled m-0" v-for="item2 in brandSearch">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" :id="item2.id" :value="item2.id"
                            @change="filterProducts()" v-model="selected3">
                        <label class="form-check-label small" :for="item2.id">
                            @{{ item2.title }}
                        </label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@foreach($fields as $key=>$row)
<div class="accordion-item">
    <p class="accordion-header">
        <button class="accordion-button collapsed dynamic-color" type="button" data-bs-toggle="collapse"
            data-bs-target="#filter-{{$key}}" aria-expanded="false" aria-controls="filter-{{$key}}">
            {{$row->title}}
        </button>
    </p>
    <div id="filter-{{$key}}" class="accordion-collapse collapse" @if (!App\Library\Helper::isMobile()) data-bs-parent="#accordionFilter" @else data-bs-parent="#accordionFlushExampleMobile" @endif>
        <div class="accordion-body p-2">
            <ul class="p-0 m-0 px-2">
                @foreach($row->children as $item)

                <li class="list-unstyled m-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-{{$item->id}}" @change="filterProducts()" v-model="selected2"
                        name="Check{{$item->id}}">
                        <label class="form-check-label small" for="filter-{{$item->id}}">
                            {{$item->title}}
                        </label>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endforeach
