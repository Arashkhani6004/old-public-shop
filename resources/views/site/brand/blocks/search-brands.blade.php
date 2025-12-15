<div class="border overflow-hidden rounded-custom position-relative mb-4">
	<input type="search" name="" v-on:keyup="searchInCats" id="" class="form-control border-0" placeholder="نام دسته را بنویسید..." v-model="searchValue">
	<button type="submit" class="btn position-absolute end-0 top-0 bottom-0">
		<i class="bi bi-search"></i>
	</button>
</div>

<div class="form-check cat-search" v-for="item2 in catSearch">
    <label class="check-box">
        @{{ item2.title }}
    <input class="form-check-input" type="checkbox" :value="item2.id"  @change="filterBrands()" v-model="selected4">
    </label>
</div>


