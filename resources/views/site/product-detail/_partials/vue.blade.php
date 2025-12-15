<script type="application/javascript">
    new Vue({
        el: '#app',
        data: {
            selectedVariant: null,
            productId: "{{$product->id}}",
            variantCount: "{{count(@$product->variants)}}",
            finalPrice: "{{ intval(@$product->final_price) != 0 ? number_format(intval(@$product->final_price)).' تومان ' : 0}}",
            price: "{{ intval(@$product->final_price) != intval(@$product->price) ? number_format(intval(@$product->price)).' تومان ' : 0 }}",
            percent: "{{intval(@$product->percent)}}",
            stock: "{{intval(@$product->stock)}}",
            quantity: 1,
            selectedOption: ''
        },
        methods: {
            decreaseQuantity() {
                var value = parseInt(document.getElementById('number').value, 10);
                value = isNaN(value) ? 0 : value;
                value < 1 ? value = 1 : '';
                if(value > 1){
                    value--;
                }

                document.getElementById('number').value = value;
                this.quantity = value;
            },
            increaseQuantity() {
                var value = parseInt(document.getElementById('number').value, 10);
                value = isNaN(value) ? 0 : value;
                value++;
                document.getElementById('number').value = value;
                this.quantity = value;
            },
            selectVariant(variant) {
                this.selectedVariant = variant;
                

                this.percent = variant.percent != null ? parseInt(variant.percent) : 0;
                this.finalPrice = parseInt(variant.final_price) !== 0
                    ? parseInt(variant.final_price).toLocaleString() + ' تومان '
                    : 0;

                this.price = parseInt(variant.price) !== parseInt(variant.final_price)
                    ? parseInt(variant.price).toLocaleString() + ' تومان '
                    : 0;
                this.stock = parseInt(variant.stock);
            },


            async addToBasket() {
                if(!this.selectedVariant && this.variantCount > 0){
                    Swal.fire({
                        icon: 'info',
                        text: " {{ ' لطفا '.@$product->mainVariant->title .' را انتخاب کنید '}} ",
                        showConfirmButton: true,
                        confirmButtonText: 'باشه',
                        timer: 5000
                    });
                    return;
                }

                let formData = new FormData();
                formData.append("product_id", this.productId);
                formData.append("product_variant_id", this.selectedVariant ? this.selectedVariant.id : '');
                formData.append("quantity", this.quantity);
                const response = await axios.post('{{route('basket.add')}}', formData);
                if (response.data.success === false && response.data.button === false) {
                    if(response.data.swal) {
                        Swal.fire({
                            icon: 'info',
                            text: response.data.message,
                            showConfirmButton: true,
                            confirmButtonText: 'باشه',
                            timer: 5000
                        });
                    }else {
                        Swal.fire({
                            icon: 'info',
                            text: response.data.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000
                        });
                        return false;
                    }

                }
                else{
                    Swal.fire({
                        icon: 'success',
                        text: response.data.message,
                        title: 'اضافه شد!',
                        showCancelButton: true,
                        confirmButtonText: 'تکمیل سفارش و پرداخت',
                        cancelButtonText: 'ادامه خرید',
                        customClass: {
                            confirmButton: 'btn btn-danger',
                            cancelButton: 'btn btn-secondary'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{route('basket.cart')}}';
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            // Continue shopping
                        } else {
                            console.log('hi');
                        }
                    });
                }




            },
        },
        mounted() {

        },
        watch: {
            selectedOption(variant) {
                this.selectedVariant = variant ? JSON.parse(variant) : null;
                if(this.selectedVariant != null){
                    const btnChange = document.getElementById("pills-" + this.selectedVariant.id);
                    const tabLinks = document.querySelectorAll(".nav-link");
                    const tabs = document.querySelectorAll('[id^="pills-"]');
                    tabs.forEach(tab => {
                        tab.classList.remove("active");
                        tab.classList.remove("show");
                    });
                    if (btnChange) {
                        btnChange.classList.add("active");
                        btnChange.classList.add("show");
                        btnChange.setAttribute("aria-selected", "true");
                    }
                    tabLinks.forEach(tabLink => {
                        tabLink.setAttribute("aria-selected", "false");
                    });

                    this.percent = this.selectedVariant.percent != null ? parseInt(this.selectedVariant.percent) : 0;
                    this.finalPrice = parseInt(this.selectedVariant.final_price) !== 0
                        ? parseInt(this.selectedVariant.final_price).toLocaleString() + ' تومان '
                        : 0;

                    this.price = parseInt(this.selectedVariant.price) !== parseInt(this.selectedVariant.final_price)
                        ? parseInt(this.selectedVariant.price).toLocaleString() + ' تومان '
                        : 0;
                    this.stock = parseInt(this.selectedVariant.stock);
                }
                else{
                    this.finalPrice= "{{ intval(@$product->final_price) != 0 ? number_format(intval(@$product->final_price)).' تومان ' : 0}}";
                    this.price= "{{ intval(@$product->final_price) != intval(@$product->price) ? number_format(intval(@$product->price)).' تومان ' : 0 }}";
                    this.percent= "{{intval(@$product->percent)}}";
                }

            },
        },
        computed: {},

    });
</script>

