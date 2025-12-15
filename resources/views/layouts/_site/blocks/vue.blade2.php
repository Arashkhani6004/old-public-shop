<script>
    new Vue({
        el: '#shop68',
        data: function () {
            return {
                //Cart
                cartItems: [],
                cartSumPrice: 0,
                quantity: 1,
                specificationId:'',
                // countShopping: 0,
                discountCode: "",
                order : null,
                buttonShow : false,
                loading3: false ,
                loading4: false ,
                //
                products : [],
                selected2 : [],
                selected3 : [],
                selected4 : [],
                selected5 : [],
                loading2 : false,
                msg:'hhhhh',
                brands : [],
                categories : [],
                brandSearch : [],
                catSearch : [],
                allSearch : [],
                allSearch2 : [],
                searchValue : '',
                available : false,
                discount : false,
                timer : false,
                cartTotal: 0,
                changePost1:'',
                   selectedTax : '{!! intval(@$setting_header->tax)/100 !!}',
                @if(@Request::segments()[0] == 'pro')
                selectedPrice : '{!! $product->price_first["price"] !!}',
                @else
                selectedPrice : '',

                @endif
                selectedColor : '',
                sortBy: '',
                @if(count(Request::segments()) == 0 || Request::segments()[0] == 'bestselling' || Request::segments()[0] == 'popular' || Request::segments()[0] == 'latest')
                    @php
                        $products = new \Illuminate\Database\Eloquent\Collection;
                        if(count(Request::segments()) == 0){
                        $products = $products->merge($new_products);
                          $products = $products->merge($popular_products);
                          $products = $products->merge($timer_products);
                      }
                        $products = $products->merge($most_products);
                    @endphp
                    @foreach($products as $row)
                    @php

                        if(\Illuminate\Support\Facades\Auth::check())
                        {
                            $likes = \App\Models\Like::where('likeable_id',$row->id)->where('user_id',\Illuminate\Support\Facades\Auth::id())->where('likeable_type','App\Models\Product')->first();
                         }
                         else
                         {
                           $ip= \request()->ip();
                           $likes = \App\Models\Like::where('likeable_id',$row->id)->whereNull('user_id')->where('ip',$ip)->where('likeable_type','App\Models\Product')->first();
                         }

                    @endphp
                        @if(isset($likes))
                            like{{$row->id}}: 1,
                        @else
                            like{{$row->id}}: 0,
                        @endif
                    @endforeach
                @else
                    like: 0,
                @endif
@if(App\Library\Helper::isMobile())
                    isMobile: true ,
                @else
                isMobile: false ,
@endif



                cartPayment: 0 ,
                selectedState:'',
                selectedCity: '',

                postPrice:0,
                postType:0,
                @if(isset($addresses))
                    @foreach($addresses as $row)
                    @if($row->state_id) selectedState{{$row->id}}:{{$row->state_id}},
                    selectedCity{{$row->id}}: {{$row->city_id}}, @endif
                    @endforeach
                @endif
                cities: [],

                variable:@if(isset($product))
                        @if(count(@$product->variable) > 0)
                        '1'
                        @else
                        ''
                        @endif
                        @else
                         ''
                        @endif,

                variableId: @if(isset($product))
                        @if(count(@$product->variable) > 0)
                        '{{@$product->variable[0]->id}}'
                        @else
                        ''
                        @endif
                        @else
                         ''
                        @endif,

                variablePrice:@if(isset($product))
                                    @if(count(@$product->variable) > 0)
                                        @if(@$product->variable[0]->discounted_price > 0)
                                            '{{number_format(@$product->variable[0]->discounted_price)}}'
                                        @else
                                            '{{number_format(@$product->variable[0]->price)}}'
                                        @endif
                                    @else
                                    ''
                                    @endif
                                @else
                                ''
                                @endif,
                variablePriceDiscount:@if(isset($product))
                                            @if(count(@$product->variable) > 0)
                                                @if(@$product->variable[0]->discounted_price > 0)
                                                    '{{number_format(@$product->variable[0]->price)}}'
                                                @else
                                                    ''
                                                @endif
                                            @else
                                            ''
                                            @endif
                                        @else
                                        ''
                                        @endif,
                variableImage:@if(isset($product))
                        @if(count(@$product->variable) > 0)
                            @if(file_exists('assets/uploads/content/pro/big/'.@$product->variable[0]->image))
                        '{{asset('assets/uploads/content/pro/big/'.@$product->variable[0]->image)}}'
                        @else
                        '{{asset('assets/site/images/notfound.png')}}'
                        @endif
                        @else
                        ''
                        @endif
                        @else
                        ''
                        @endif,
                variableImages:[],
                percent:'',
                mobile:'',
                check:0,
                err:'',
                name:'',
                email:'',
                type:'',
                product_id:'{{@$currentBasket->id}}',
                loding:true,
            }
        },
        methods: {
            plusMe(){
                this.quantity =  this.quantity+1;
            },
            minusMe(){
                if(this.quantity-1 < 1 ){
                    this.quantity =  1;
                }else{
                    this.quantity =  this.quantity-1;
                }
            },

            button:function(event){



                if(event.target.value.trim() == "")
                {
                    this.buttonShow = false;
                }else
                {
                    this.buttonShow = true;
                }
                console.log(event.target.value)
                console.log(this.buttonShow);

            },

            plusQnty(cartItemId){
                this.cartItems.find( ({ id }) => id === cartItemId ).productQuantity =  this.cartItems.find( ({ id }) => id === cartItemId ).productQuantity+1;
            },
            minusQnty(cartItemId){
                this.cartItems.find( ({ id }) => id === cartItemId ).productQuantity =  this.cartItems.find( ({ id }) => id === cartItemId ).productQuantity-1;

            },
            changeColor:function(colorSelected,price){
                this.selectedColor = colorSelected;
                this.selectedPrice = price + " تومان ";
            },
            changePrice:function(price){
                this.selectedPrice = price + " تومان ";
            },
            changePost:function(postPrice,payment){
                console.log('eeeeee');
                this.selectedPost = postPrice;
                this.selectedPost2 = payment;
                // this.cartPayment = this.cartPayment + this.selectedPost2;
            },
            //Address
            getCities:function ()  {
                var vm = this;


                axios.post(`{{route('panel.set-city')}}`, {
                    body: {}
                })
                    .then(response => {
                        if (response.data.success === true) {
                            vm.cities = response.data.cities;
                        }
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            setCities:function ()  {

                var vm = this;

                axios.post(`{{route('panel.set-city')}}`, {
                    body: {  state_id: this.selectedState }
                })
                    .then(response => {
                        if (response.data.success === true) {
                            vm.cities = [];
                            vm.cities = response.data.cities;
                        }
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            getEditCities:function (selectedState)  {
                var vm = this;


                axios.post(`{{route('panel.set-city-edit')}}`, {
                    body: {
                        state_id: selectedState
                    }
                })
                    .then(response => {
                        if (response.data.success === true) {
                            vm.cities = response.data.cities;
                        }
                    })
                    .catch(e => {
                        console.log(e);
                    });

            },

            //ProductList
            searchInBrands(){

                this.brandSearch =  this.brands.filter((brand) => {
                    return brand.title.toLowerCase().includes(this.searchValue);
                });

            },
            searchInCats(){
                this.catSearch =  this.categories.filter((category) => {
                    return category.title.toLowerCase().includes(this.searchValue);
                });

            },
            searchInAll(){
                this.allSearch =  this.categories.filter((category) => {
                    console.log('wait')
                    return category.title.toLowerCase().includes(this.searchValue);
                });

            },
            searchInAll2(){

                this.allSearch2 =  this.brands.filter((brand) => {
                    console.log('whaaaaat')
                    return brand.title.toLowerCase().includes(this.searchValue);
                });

            },
            getBrands:function ()  {
                var vm = this;
                axios({
                    method: "post",
                    url: '{{route('site.getbrands')}}',
                    data: {
                        category_id: {{@$category->id ? @$category->id : '1'}},
                        title: this.searchValue,
                    }
                }).then(response => {
                    if (response.data.success === true) {
                        vm.brandSearch = response.data.brands;
                        console.log('brands:'+response.data.brands)
                    }
                }).catch(e => {
                    console.log(e);
                });
            },
            getCats:function ()  {

                var vm = this;
                axios({
                    method: "post",
                    url: '{{route('site.getcats')}}',
                    data: {
                       brand_id: {{@$brand->id ? @$brand->id : '1'}},
                    }
                }).then(response => {
                    vm.catSearch = [];
                    vm.categories = response.data.categories;
                    vm.catSearch = response.data.categories;
                    vm.catSearch =  vm.categories;

                }).catch(e => {
                    console.log(e);
                });


                console.log(vm.catSearch);


            },
            getAll:function ()  {

                var vm = this;
                axios({
                    method: "post",
                    url: '{{route('site.getall')}}',
                    data: {

                    }
                }).then(response => {
                    vm.catAll = [];
                    vm.categories = response.data.categories;
                    vm.allSearch = response.data.categories;
                    vm.allSearch =  vm.categories;
                    vm.brandAll = [];
                    vm.brands = response.data.brands;
                    vm.allSearch2 = response.data.brands;
                    vm.allSearch2 =  vm.brands;



                }).catch(e => {
                    console.log(e);
                });


                console.log(vm.catAll);


            },
            productsList:function ()  {
                var vm=this;

                axios({
                    method: "post",
                    url: '{{route('vue.product-list')}}',
                    data: {
                        category_id: {{@$category->id ? @$category->id : '1'}},
                    }
                }).then(function (response) {
                    vm.products = [];
                    vm.products = response.data.products;
                    vm.loading2 = false;
                });
            },
            loadingOff:function ()  {
                this.loading2 = false;
            },
            filterProducts:function ()  {
                var vm=this;
              if(vm.isMobile == true){
                    var pr= document.getElementById('max_price_xs').value + ' - ' +document.getElementById('min_price_xs').value
                }else{
                    var pr= document.getElementById('max_price').value + ' - ' +document.getElementById('min_price').value

                }
                this.loading2 = true;
                axios({
                    method: "post",
                    url: '{{route('vue.filter-product')}}',
                    data: {
                        category_id: {{@$category->id ? @$category->id : '1'}},
                        specification : this.selected2,
                        brand : this.selected3,
                        available : this.available,
                        discount : this.discount,
                        timer : this.timer,
                        sortBy : this.sortBy,
                        priceRange : pr,
                    }
                }).then(function (response) {
                    vm.products = [];
                    vm.products = response.data.products;
                    console.log(response.data.products)
                    vm.loading2 = false;

                });
            },
            brandList:function ()  {

                var vm=this;
                axios({
                    method: "post",
                    url: '{{route('vue.brand-list')}}',
                    data: {
                        brand_id: {{@$brand->id ? @$brand->id : '1'}},
                    }
                }).then(function (response) {
                    vm.products = [];
                    vm.products = response.data.products;
                    vm.loading2 = false;
                });
            },
            filterBrands:function ()  {
                var vm=this;
                if(vm.isMobile == true){
                    var pr2= document.getElementById('max_price_xs').value + ' - ' +document.getElementById('min_price_xs').value
                }else{
                    var pr2= document.getElementById('max_price').value + ' - ' +document.getElementById('min_price').value

                }
                this.loading2 = true;
                axios({
                    method: "post",
                    url: '{{route('vue.filter-brand')}}',
                    data: {
                        brand_id: {{@$brand->id ? @$brand->id : '1'}},
                        category : this.selected4,
                        available : this.available,
                        discount : this.discount,
                        timer : this.timer,
                        sortBy : this.sortBy,
                        priceRange : pr2


                    }
                }).then(function (response) {
                    vm.products = [];

                    vm.products = response.data.products;

                    vm.loading2 = false;

                });
            },

            allList:function ()  {

                var vm=this;
                axios({
                    method: "post",
                    url: '{{route('vue.all-list')}}',
                    data: {
                    }
                }).then(function (response) {
                    vm.products = [];
                    vm.products = response.data.products;
                    vm.loading2 = false;
                });
            },
            filterAll:function ()  {
                var vm=this;
                if(vm.isMobile == true){
                    var pr= document.getElementById('max_price_xs').value + ' - ' +document.getElementById('min_price_xs').value
                }else{
                    var pr= document.getElementById('max_price').value + ' - ' +document.getElementById('min_price').value

                }
                this.loading2 = true;
                axios({
                    method: "post",
                    url: '{{route('vue.filter-all')}}',
                    data: {

                        brand : this.selected5,
                        category : this.selected4,
                        available : this.available,
                        discount : this.discount,
                        timer : this.timer,
                        sortBy : this.sortBy,
                        priceRange : pr
                    }

                }).then(function (response) {
                    vm.products = [];

                    vm.products = response.data.products;

                    vm.loading2 = false;

                });
            },

            //Cart
            getCartItems() {

                var vm = this;
                axios({
                    method: "post",
                    url: '{{route('site.cart.content')}}',
                    data: {}

                }).then(function (response) {
                    console.log(response.data);
                    if (response.data.success) {
                        if (response.data.success === true) {

                            vm.cartItems = [];
                            vm.cartItems = response.data.cart;

                            vm.cartSumPrice = 0;
                            vm.cartSumPrice = response.data.cartSumPrice;
                            vm.order = null;
                            vm.order = response.data.order;
                            vm.countShopping = 0;
                            vm.countShopping = response.data.countShopping;
                            vm.cartPayment = 0;
                            vm.cartPayment = response.data.cartPayment;
                            vm.cartTotal = 0;
                            vm.cartTotal = response.data.totalCount;
                            vm.loding = false;
                        }
                    }
                });
            },
            addToCart(productId, quantity, relativeMode,variableId) {

                var vm = this;
                console.log(vm.variableId);
                axios({
                    method: "post",
                    url: '{{route('site.cart.add')}}',
                    data: {
                        // discount_code: this.discountCode,
                        productId: productId,

                        variableId: vm.variableId,
                        // discountId: discountId,

                        @if(@Request::segments()[0] == "checkout")

                        quantity: quantity ,
                        @else
                        quantity: document.getElementById("quantity").value ,

                        @endif

                        relativeMode: relativeMode
                    }
                }).then(function (response) {
                    if (response.data.success === true ) {
                        vm.cartItems = [];
                        vm.cartItems = response.data.cart;
                        vm.cartSumPrice = 0;
                        vm.cartSumPrice = response.data.cartSumPrice;
                        vm.countShopping = 0;
                        vm.countShopping = response.data.countShopping;
                        vm.cartPayment = 0;
                        vm.cartPayment = response.data.cartPayment;
                        vm.cartTotal = 0;
                        vm.cartTotal = response.data.totalCount;

                        swal("اضافه شد!", response.data.message, "success");
                    }

                    if (response.data.success === false && response.data.button == true) {
                        swal(
                            {title: "خطا!",
                                text: response.data.message,
                                icon: "error",
                                button: "ثبت نام/ورود"})
                            .then(() => {
                                location.href = "{{url('panel/login?product_id='.@$product->id)}}";
                            });
                    }

                    if(response.data.success === false && response.data.button == false) {

                        swal("خطا!", response.data.message, "error");


                    }

                });
            },
                addToCart(productId, quantity, relativeMode,variableId) {

                var vm = this;
                console.log(vm.variableId);
                axios({
                    method: "post",
                    url: '{{route('site.cart.add')}}',
                    data: {
                        // discount_code: this.discountCode,
                        productId: productId,

                        variableId: vm.variableId,
                        // discountId: discountId,

                        @if(@Request::segments()[0] == "checkout")

                        quantity: quantity ,
                        @else
                        quantity: document.getElementById("quantity").value ,

                        @endif

                        relativeMode: relativeMode
                    }
                }).then(function (response) {
                    if (response.data.success === true ) {
                        vm.cartItems = [];
                        vm.cartItems = response.data.cart;
                        vm.cartSumPrice = 0;
                        vm.cartSumPrice = response.data.cartSumPrice;
                        vm.countShopping = 0;
                        vm.countShopping = response.data.countShopping;
                        vm.cartPayment = 0;
                        vm.cartPayment = response.data.cartPayment;
                        vm.cartTotal = 0;
                        vm.cartTotal = response.data.totalCount;

                        swal("اضافه شد!", response.data.message, "success");
                    }

                    if (response.data.success === false && response.data.button == true) {
                        swal(
                            {title: "خطا!",
                                text: response.data.message,
                                icon: "error",
                                button: "ثبت نام/ورود"})
                            .then(() => {
                                location.href = "{{url('panel/login?product_id='.@$product->id)}}";
                            });
                    }

                    if(response.data.success === false && response.data.button == false) {

                        swal("خطا!", response.data.message, "error");


                    }

                });
            },
            addToCart2(productId,quantity,relativeMode,variableId) {
                 this.loading3 = true ;
                var vm = this;
                console.log(variableId);
                console.log(productId);
                console.log(relativeMode);
                console.log(vm.quantity);
                axios({
                    method: "post",
                    url: '{{route('site.cart.add2')}}',
                    data: {
                        productId: productId,
                        variableId: variableId,
                        @if(@Request::segments()[0] == "checkout")
                            quantity: quantity ,
                        @else
                            quantity: document.getElementById("quantity").value ,
                        @endif
                        relativeMode: relativeMode
                    }
                }).then(function (response) {
                    if (response.data.success === true ) {
                        vm.cartItems = [];
                        vm.cartItems = response.data.cart;
                        vm.cartSumPrice = 0;
                        vm.cartSumPrice = response.data.cartSumPrice;
                        vm.countShopping = 0;
                        vm.countShopping = response.data.countShopping;
                        vm.cartPayment = 0;
                        vm.cartPayment = response.data.cartPayment;
                        vm.cartTotal = 0;
                        vm.cartTotal = response.data.totalCount;
                         vm.loading3 = false ;
                        swal("اضافه شد!", response.data.message, "success", {
                            buttons: {
                                continiue:{
                                    text: "تکمیل سفارش و پرداخت",
                                    color: 'red',
                                },
                                nonow: "ادامه خرید",
                            },
                        }).then((value) => {
                            switch (value) {

                                case "continiue":

                                    window.location.href = '{{url('/checkout')}}'; //Will take you to Google.
                                    break;

                                case "nonow":
                                    break;

                                default:
                                    console.log('hi');
                            }
                        });
                    }


                    if (response.data.success === false && response.data.button == true) {
                        swal(
                            {title: "خطا!",
                                text: response.data.message,
                                icon: "error",
                                button: "ثبت نام/ورود"})
                            .then(() => {
                                location.href = "{{url('panel/login?product_id='.@$product->id)}}";
                            });
                    }
                    if(response.data.success === false && response.data.button == false) {
                        swal("خطا!", response.data.message, "error");
                    }
                });
            },
            addDiscount() {
                var vm = this;
                 vm.loading4 = true ;
                axios({
                    method: "post",
                    url: '{{route('site.discount.add')}}',
                    data: {

                        code: this.discountCode,
                    }
                }).then(function (response) {
                    if (response.data.success === true) {
                        vm.cartItems = [];
                        vm.cartItems = response.data.cart;
                        vm.cartSumPrice = 0;
                        vm.cartSumPrice = response.data.cartSumPrice;
                        vm.countShopping = 0;
                        vm.countShopping = response.data.countShopping;
                        vm.cartPayment = 0;
                        vm.cartPayment = response.data.cartPayment;
                        swal("تخفیف!", "تخفیف با موفقیت اعمال شد.", "success");
                    } else {
                        swal(" خطا!",response.data.message, "error");


                    }
     vm.loading4 = false ;
                });
            },
            removeCart(productId,variableId) {
                var vm = this;



                swal({
                        title: "مطمئن هستید؟",

                        icon: "warning",
                        buttons: ["خیر", "بله"],
                        dangerMode: true,
                        })
                        .then((willDelete) => {
                        if (willDelete) {
                            axios({
                                method: "post",
                                url: '{{route('site.cart.remove')}}',
                                data: {
                                    productId: productId,
                                    variableId: variableId,
                                }
                            }).then(function (response) {
                                if (response.data.success === true) {
                                    vm.cartItems = [];
                                    vm.cartItems = response.data.cart;
                                    vm.cartSumPrice = 0;
                                    vm.cartSumPrice = response.data.cartSumPrice;
                                    vm.countShopping = 0;
                                    vm.countShopping = response.data.countShopping;
                                    vm.cartPayment = 0;
                                    vm.cartPayment = response.data.cartPayment;
                                    vm.cartTotal = 0;
                                    vm.cartTotal = response.data.totalCount;

                                    swal("محصول حذف شد!", "محصول از سبد خرید شما حذف شد", "success");
                                }
                            });

                            }
                        });
            },

            //Like
            @if(count(Request::segments()) == 0)

                @foreach($products as $row)
            getLike{{$row->id}}(like,likeable_id) {
                console.log('----------------------------');
                console.log('test');
                var vm = this;
                axios({
                    method: "post",
                    url: '{{route('pro.like')}}',
                    data: {
                        likeable_id: likeable_id,
                        like: like,
                    }
                }).then(response => {
                    vm.like{{$row->id}} = response.data.like;
                    console.log(vm.like{{$row->id}} );
                }).catch(e => {
                    console.log(e);
                });
            },
            @endforeach
                @else
            getLike(like,likeable_id) {

                var vm = this;
                axios({
                    method: "post",
                    url: '{{route('pro.like')}}',
                    data: {
                        likeable_id: likeable_id,
                        like: like,
                    }
                }).then(response => {
                    if (response.data.success === true) {
                        vm.like = response.data.like;

                    }
                }).catch(e => {
                    console.log(e);
                });
            },
            @endif
            async changeVariables(id)  {
                console.log(id)
                var vm = this;
                axios.post(`{{route('product.variable')}}`, {
                    body: {
                        id: id,
                    }
                })
                    .then(response => {

                        if(response.data.variable.discounted_price !=null){
                            vm.variablePrice = response.data.price
                            vm.variablePriceDiscount = response.data.price2
                            vm.percent = response.data.percent
                        }
                        else{
                            vm.variablePrice = response.data.price
                            vm.variablePriceDiscount = ''
                            vm.percent = ''
                        }
                        if(response.data.variable.stock > 0){
                            vm.variable = 1
                        }
                        else{
                            vm.variable = 0
                        }
                        console.log(response.data.image);

                        if(response.data.image !=null){
                        vm.variableImage = response.data.image
                        }
                        else{
                            vm.variableImage = null
                        }
                        vm.variableImages = response.data.allimage
                        console.log(vm.variableImage);
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            async loginCart() {
                try {
                    this.loading3 = true;
                    let formData = new FormData();
                    formData.append("mobile", this.mobile);
                    formData.append("product_id", this.product_id);
                    console.log(formData);
                    const response = await axios.post('{{url('/login-cart/')}}', formData);
                    this.check = response.data.check;
                    this.err = response.data.err;
                    console.log(this.check);
                    if(this.err == 1){
                    swal("خطا!", "کاربری با این شماره وجود ندارد", "error");
                    }
                    this.loading3 = false;
                    } catch (error) {
                        swal("خطا!", "با خطا مواجه شدید", "error");
                    }
                },
            async registerCart() {
                   this.loading3 = true ;
                let formData = new FormData();
                console.table(formData);
                console.table(this.product_id);
                formData.append("name", this.name);
                formData.append("type", this.type);
                formData.append("mobile", this.mobile);
                formData.append("email", this.email);
                formData.append("product_id", this.product_id);
                console.log(formData);
                const response = await axios.post('{{url('/register-cart/')}}', formData);
                this.check = response.data.check;
                this.err = response.data.err;
                this.loading3 = false ;
                if(this.err == 1){
                    swal("خطا!", "با این شماره اکانت وجود دارد لطفا وارد حساب کاربری خود شوید.", "error");
                }
            },

        },
        computed: {

            selectedPost: function () {

                console.log('heeeeykkkkkkiiii');
                if(this.changePost1){
                    return this.changePost1.split("|")[0];
                }else{
                    return 'روش ارسال را انتخاب کنید';
                }
            },
            selectedPost2: function () {

                if(this.changePost1){
                    console.log('hiiiii');
                    console.log(parseInt(this.changePost1.split("|")[1]));
                    return parseInt(this.changePost1.split("|")[1]);

                }else{
                    return 0;
                }
            },
            changePost2: function () {
                if(this.changePost1 !== ''){
                    return parseInt(this.changePost1.split("|")[0]);
                }else{
                    return null;
                }
            },

            cartPaymentTotal: function () {
                return this.cartPayment + this.changePost2;
            },

            countShopping: function () {
                return this.cartItems.length;
            },
        },
        mounted() {
            this.loading2 = true;
                this.getCartItems();
            @if(@Request::segments()[0] == "cat")
                this.productsList();
                this.getBrands();
            @endif
            @if(@Request::segments()[0] == "brand")
                this.brandList();
                this.getCats();
            @endif
                @if(@Request::segments()[0] == "all-products")
                this.allList();
            this.getAll();
            @endif
            this.getEditCities(null);
        },
        watch : {
            variableId:function(val) {
                console.log(val)
                $( "#v-pills-"+val+"-tab").trigger("click");
		    }
	    }
    });
</script>
