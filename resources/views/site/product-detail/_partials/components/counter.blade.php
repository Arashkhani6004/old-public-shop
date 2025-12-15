@if ($product->count > 0)
<div class="number d-flex align-items-center justify-content-center">
    <div class="value-button d-flex align-items-center justify-content-center" id="decrease" @click="minusMe()"
        value="Decrease Value">
        <i class="bi bi-dash d-flex"></i>
    </div>
    <input type="text" class="font-num-r" name="quantity" readonly id="number" min="1" v-model="quantity" />
    <div class="value-button d-flex align-items-center justify-content-center" id="increase" @click="plusMe()"
        value="Increase Value">
        <i class="bi bi-plus d-flex"></i>
    </div>
</div>
@endif