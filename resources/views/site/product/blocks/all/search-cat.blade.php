
<div class="border overflow-hidden rounded-custom position-relative mb-4">
    <input type="search" name="" v-on:keyup="searchInAll" id="" class="form-control border-0"
           placeholder="جستجوی دسته، مثلا : سرم" v-model="searchValue">
    <button type="submit" class="btn position-absolute end-0 top-0 bottom-0">
        <i class="bi bi-search"></i>
    </button>
</div>
<div class="form-check" v-for="item2 in allSearch">
    <label class="check-box">
        @{{ item2.title }}
        <input class="form-check-input" type="checkbox" :value="item2.id" @change="filterAll()"
               v-model="selected4">
        <span class="checkmark"></span>
    </label>
</div>
سسس