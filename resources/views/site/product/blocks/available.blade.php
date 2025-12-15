<div class="form-check form-switch">
	<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck" @change="filterProducts()" v-model = "available">
	<label class="form-check-label" for="SwitchCheck">
		فقط کالاهای موجود
	</label>
</div>
<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck" @change="filterProducts()" v-model = "discount">
    <label class="form-check-label" for="SwitchCheck">
        فقط تخفیف دارها
    </label>
</div>
