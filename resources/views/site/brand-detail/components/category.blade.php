<div class="search position-relative mb-2">
    <input type="search" v-on:keyup="searchInCats" v-model="searchValue" class="form-control form-control-sm"
        placeholder="جستجو در دسته بندی ها">
    <button type="submit"
        class="btn btn-search bg-transparent p-2 shadow-none border-0 position-absolute top-0 bottom-0 end-0">
        <i class="bi bi-search d-flex"></i>
    </button>
</div>
<ul class="p-0 m-0">
    <li class="list-unstyled m-0" v-for="item2 in catSearch">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" :id="item2.id" :value="item2.id"
                @change="filterBrands()" v-model="selected4">
            <label class="form-check-label small" :for="item2.id">
                @{{ item2.title }}
            </label>
        </div>
    </li>
</ul>
