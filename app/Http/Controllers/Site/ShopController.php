<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Jobs\OrderInquiryJob;
use App\Models\Address;
use App\Models\City;
use App\Library\Helper;

use App\Models\Discount;
use App\Models\InventoryReceipt;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Product;
use App\Models\ProductSpecification;
use App\Models\ProductSpecificationType;
use App\Models\Setting;
use App\Models\State;
use App\Models\ProductVariable;
use App\Models\ShipMent;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Kavenegar\KavenegarApi;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{

    public function checkout()
    {

        $states = State::get();
        $cities = City::get();
        $user = Auth::user();
       
        if ($user) {
            $addresses = Address::authUser()->orderby('default_address', 'DESC')->orderby('id', 'DESC')->get();
            $default_address = Address::authUser()->where('default_address', '1')->orderby('default_address', 'DESC')->orderby('id', 'DESC')->first();
            // \Log::info($addresses);
            \Log::info($user);
        } else {
            $addresses = null;
            $default_address = null;

        }
        $order_items_count = 0;
        $currentOrder = null;


        $currentOrder = Order::authUser()->currentOrder()->first();
        if ($currentOrder !== null) {
            if ($default_address !== null) {
                $currentOrder->update([
                    'address_id' => @$default_address->id,
                    'state_id' => @$default_address->state_id,
                    'city_id' => @$default_address->city_id,
                ]);
            }
            $order_items_count = $currentOrder->orderItems;
        }
        $basket_items_count = 0;
        $currentBasket = null;


        $currentBasket = Basket::orderby('id','DESC')->authUser()->currentBasket()->first();
        if ($currentBasket !== null) {
            if ($default_address !== null) {
                $currentBasket->update([
                    'address_id' => @$default_address->id,
                    'state_id' => @$default_address->state_id,
                    'city_id' => @$default_address->city_id,
                ]);
            }
            $basket_items_count = $currentBasket->basketItems;
        }
        return view(
            'site.cart.checkout')
            ->with('user', $user)
            ->with('currentOrder', $currentOrder)
            ->with('order_items_count', $order_items_count)
            ->with('currentBasket', $currentBasket)
            ->with('basket_items_count', $basket_items_count)
            ->with('states', $states)
            ->with('cities', $cities)
            ->with('default_address', $default_address)
            ->with('addresses', $addresses);
    }

    public function postAddAddress(Request $request)
    {
        $input = $request->all();
        $order = Basket::find($request->get('order_id'));
        $addresses = Address::authUser()->where('default_address', '1')->get();
        foreach ($addresses as $row) {
            $row->update([
                'default_address' => 0
            ]);
        }
        if ($input['postal_code'] == null) {
            return redirect()->back()->with('error', 'لطفا کد پستی خود را انتخاب کنید');
        }
        $address = Address::create([
            'user_id' => Auth::id(),
            'state_id' => @$input['state_id'],
            'city_id' => @$input['city_id'],
            'location' => @$input['location'],
            'postal_code' => @$input['postal_code'],
            'transferee_name' => @$input['transferee_name'],
            'transferee_family' => @$input['transferee_family'],
            'transferee_mobile' => @$input['transferee_mobile'],
            'recipient_name' => @$input['recipient_name'],
            'recipient_phone' => Helper::persian2LatinDigit(@$input['recipient_phone']),

            'default_address' => 1
        ]);
        $order->update([
            'address_id' => $address->id,
            'state_id' => @$input['state_id'],
            'city_id' => @$input['city_id'],
        ]);
        return redirect()->back()->with('success', 'آدرس با موفقیت اضافه شد');
    }

    public function defaultAddress($id)
    {

        $user = Auth::user();
        $order = Basket::authUser()->currentBasket()->first();
        $default_addresses = Address::authUser()->where('default_address',1)->get();
        foreach ($default_addresses as $default_address){
            $default_address->update([
                'default_address'=> 0,
            ]);
        }
        $address = Address::find($id);
        $address->update([
            'default_address'=> 1,
        ]);
        $order->update([
            'address_id' => $address->id,
            'state_id' => @$address['state_id'],
            'city_id' => @$address['city_id'],
        ]);

        return redirect()->back()->with('success', 'آدرس پیشفرض با موفقیت ثبت شد');

    }

    public static function setOrderTotalPrice($currentOrder,$shipment)
    {

        $setting = Setting::first();
        $total_price = 0;
        foreach ($currentOrder->orderItems as $row) {
            $total_price += $row->price * $row->quantity;
        }
        $shipment_price = @$shipment->price;
        if ($shipment->pay_at_home == 1 || ($currentOrder['payment'] >= $shipment->max_price)){
            $shipment_price = 0 ;
        }
        $total_calculated = $total_price + ($total_price * ($setting->tax / 100)) + intval($shipment_price);
        $currentOrder->update([
            'total_prices' => $total_price,
            'total_calculated' => $total_calculated,
            'payment' => $total_calculated
        ]);


    }

    public static function getInventoryCount($product)
    {
        $mines = 0;
        \Log::info($product->id);


        $in = InventoryReceipt::where('product_id', $product->id)->In()->sum('count');
        $out = InventoryReceipt::where('product_id', $product->id)->Out()->sum('count');


        \Log::info(intval($out));



        $mines = intval($in) - intval($out);
        return $mines;
    }

    public static function getCustomOrder($currentOrder)
    {
        $items = [];
        foreach ($currentOrder->orderItems as $item) {
            $title = @$item->product->title;
            $price1=str_replace(',', '',@$item->product->price_second['price']);
            $items[] = [
                'id' => @$item->id,
                'productTitle' => @$title,
                'productTitleEn' => @$item->product->title_en,
                'productTitleSp' => @$item->variable->title,
                'productId' => @$item->product_id,
                'productImage' =>  @$item->product->pro_image,
                'productPrice' => @$item->product->price_first['price'],
                'itemPrice' =>number_format(intval(@$item->price)),
                'productUrl' => route('site.product.detail', ['id' => @$item->product->url]),
                'productQuantity' => $item->quantity,
                'specificationId' => @$item->product_variable_id,
                'totalPrice' => number_format((intval(@$item->quantity) * intval($price1)) + intval($currentOrder['post_price'])),
            ];
        }
        $sumPrice = $currentOrder->total_prices;
        $totalCounts = $currentOrder->orderItems()->sum('quantity');

        return [
            'items' => $items,
            'sumPrice' => number_format($sumPrice),
            'totalCount' => $totalCounts,
            'sumPriceNumber' => $sumPrice,
            'payment' => $currentOrder->total_calculated,
            'order' => $currentOrder,
        ];
    }

    public static function setOrderTotalPrice2($currentBasket)
    {

        $setting = Setting::first();
        $total_price = 0;
        foreach ($currentBasket->basketItems as $row) {
            $total_price += $row->price * $row->quantity;
        }
        $total_calculated = $total_price + ($total_price * ($setting->tax / 100)) + intval($currentBasket['post_price']);
        $currentBasket['total_calculated'] = $total_calculated;


    }

    public static function getCustomOrder2($currentBasket)
    {

        $items = [];
        $sumPrice =  0;
        foreach ($currentBasket->basketItems as $item) {
            if($item->product_variable_id != null){
                $product = ProductVariable::find($item->product_variable_id);
                if(@$product->discounted_price != null){
                    $x = @$product->discounted_price ;
                }else{
                    $x = @$product->price ;
                }
            }
            else{
                $product = Product::findorfail($item->product_id);
                if($product->price != null && $product->price != 0){
                    $x = $product->price ;
                }else{
                    $x = $product->old_price ;
                }
            }

            if($item->product_variable_id != null){

                $title = @$item->product->title;

                if(file_exists('assets/uploads/content/pro/big/'.@$item->variable->image)){
                    $y = asset('assets/uploads/content/pro/big/'.@$item->variable->image);
                }else{
                    $y =  @$item->product->pro_image ;
                }
                $items[] = [
                    'id' => @$item->id,
                    'productTitle' => @$title,
                    'productTitleEn' => @$item->product->title_en,
                    'productTitleSp' => @$item->variable->title,
                    'productId' => @$item->product_id,
                    'productImage' =>  $y,
                    'productPrice' => @$x,
                    'itemPrice' =>number_format(intval(@$x)),
                    'productUrl' => route('site.product.detail', ['id' => @$item->product->url]),
                    'productQuantity' => $item->quantity,
                    'specificationId' => @$item->product_variable_id,
                    'totalPrice' => number_format((intval(@$item->quantity) * intval(@$x)) + intval($currentBasket['post_price'])),
                ];
            }
            else{
                $title = @$item->product->title;
                $items[] = [
                    'id' => @$item->id,
                    'productTitle' => @$title,
                    'productTitleEn' => @$item->product->title_en,
                    'productTitleSp' => @$item->variable->title,
                    'productId' => @$item->product_id,
                    'productImage' =>  @$item->product->pro_image,
                    'productPrice' => @$x,
                    'itemPrice' =>number_format(intval(@$x)),
                    'productUrl' => route('site.product.detail', ['id' => @$item->product->url]),
                    'productQuantity' => $item->quantity,
                    'specificationId' => @$item->product_variable_id,
                    'totalPrice' => number_format((intval(@$item->quantity) * intval(@$x)) + intval($currentBasket['post_price'])),
                ];
            }
            $sumPrice += $x * $item->quantity;

        }
        $totalCounts = $currentBasket->basketItems()->sum('quantity');
        return [
            'items' => $items,
            'sumPrice' => number_format($sumPrice),
            'totalCount' => $totalCounts,
            'sumPriceNumber' => $sumPrice,
            'payment' => $currentBasket->total_calculated,
            'order' => $currentBasket,
        ];
    }


    public function cartContent(Request $request)
    {
   
            //    if (Auth::check()) {
            //        return response()->json([
            //            'success' => false,
            //            'button' => false,
        
            //            'message' => ' برای خرید کالا ابتدا وارد پنل کاربری خود شوید'
            //        ], 200);
            //    }
        $currentBasket = Basket::orderby('id','DESC')->authUser()->currentBasket()->first();
        

        if ($currentBasket == null) {
            return response()->json([
                'success' => false,
                'button' => false,
                'message' => ' سبد خرید شما خالی است.',
                'cart' => '',
                'cartSumPrice' => 0,
                'cartPayment' => 0,
                'countShopping' => 0,
                'address' => '',
                'order' => ''
            ], 200);
        }
        $address = Address::authUser()->Default()->first();
        $orderItems = self::getCustomOrder2($currentBasket);
        $sumPrice =  0;
        foreach ($currentBasket->basketItems as $item) {
            if($item->product_variable_id != null){
                $product = ProductVariable::find($item->product_variable_id);
                if(@$product->discounted_price != null){
                    $x = @$product->discounted_price ;          
                }else{
                    $x = @$product->price ;
                }
            }
            else{
                $product = Product::find($item->product_id);
                if($product->price != null && $product->price != 0){
                    $x = $product->price ;
                }else{
                    $x = $product->old_price ;
                }
            }
            $sumPrice += $x * $item->quantity;

        }
        if ($currentBasket->discount_id != null){
            $setting = Setting::first();

            $discount = Discount::where('id', $currentBasket->discount_id )->where('used', '0')->where("from_date", "<=", Carbon::now()->timezone('Asia/Tehran')->format("Y-m-d H:i"))->where("to_date", ">=", Carbon::now()->timezone('Asia/Tehran')->format("Y-m-d H:i"))->first();
            $discount_price = null;
            if($discount !== null){
                if ($discount->type == 1) {
                    $percent = intval($sumPrice) * intval($discount->amount) / 100;
                    $discount_price = $sumPrice - $percent;
                } elseif ($discount->type == 2) {
                    $discount_price = intval($sumPrice) - intval($discount->amount);
                    // dd($discount_price);
                }
            }
            $total_calculated = $discount_price + ($discount_price * ($setting->tax / 100)) ;
            // dd($total_calculated);
            $sumPrice = $total_calculated;
        }


        return response()->json([
            'success' => true,
            'cart' => $orderItems['items'],
            'cartSumPrice' => $orderItems['sumPrice'],
            'cartPayment' => $sumPrice,
            'countShopping' => BasketItem::where('basket_id', $currentBasket->id)->sum('quantity'),
            'address' => $address,
            'order' => $currentBasket,
            'totalCount'=>$orderItems['totalCount']
        ], 200);
    }

    public function addToCart2(Request $request)
    {

        $currentBasket = Basket::orderby('id','DESC')->authUser()->currentBasket()->first();
        if ($currentBasket == null) {
            if(Auth::check()){
                $currentBasket = Basket::create([
                    'user_id' => Auth::id(),
                    'basket_status_id' => 1
                ]);
            }else{

                $currentBasket = Basket::create([
                    'cookie_id' => session()->get('custom_data'),
                    'basket_status_id' => 1
                ]);
            }
        }
        $product = Product::find($request->productId);
        // if ($product->stock_count == 0) {
        //     return response()->json([
        //         'success' => false,
        //         'button' => false,
        //         'message' => 'محصول مورد نظر نا موجود می باشد.'
        //     ], 200);
        // }
        if (count($product->variable) > 0) {
            if (@$request->variableId == null)
            {
                return response()->json([
                    'success' => false,
                    'button' => false,
                    'message' => 'انتخاب مشخصه محصول الزامیست.'
                ], 200);
            }
            $sp = ProductVariable::find($request->variableId);
            if($sp->stock - $request->quantity < 0){
                return response()->json([
                    'success' => false,
                    'button' => false,
                    'message' => 'تعداد محصولات بیشتر از موجودی انبار میباشد .'
                ], 200);
            }
            if($sp->stock == 0){
                return response()->json([
                    'success' => false,
                    'button' => false,
                    'message' => 'محصول مورد نظر نا موجود می باش .'
                ], 200);
            }
            $cartItem = BasketItem::whereBasketId($currentBasket->id)->whereProductId($product->id)->where('product_variable_id', $sp->id)->first();
        } else {
            if($product->count - $request->quantity < 0){
                return response()->json([
                    'success' => false,
                    'button' => false,
                    'message' => 'تعداد محصولات بیشتر از موجودی انبار میباشد .'
                ], 200);
            }
            if($product->count == 0){
                return response()->json([
                    'success' => false,
                    'button' => false,
                    'message' => 'محصول مورد نظر نا موجود می باش .'
                ], 200);
            }
            $cartItem = BasketItem::whereBasketId($currentBasket->id)->whereProductId($product->id)->first();
        }
        $max = $product->max;
        $count = $product->count;
        if ($cartItem == null) {
            if (count($product->variable) > 0 && @$request->variableId == null) {
                return response()->json([
                    'success' => false,
                    'button' => false,
                    'message' => 'انتخاب مشخصه محصول الزامیست.'
                ], 200);
            }
            if (count($product->variable) > 0 && @$request->variableId != null) {
                if ($sp->discounted_price != null) {
                    BasketItem::create([
                        'product_id' => $product->id,
                        'basket_id' => $currentBasket->id,
                        'product_variable_id' => @$sp->id,
                        'quantity' => $request->quantity,
                        'basket_item_status_id' => 1,
                        'price' => $sp->discounted_price,
                    ]);
                }
                else{

                    BasketItem::create([
                        'product_id' => $product->id,
                        'basket_id' => $currentBasket->id,
                        'product_variable_id' => @$sp->id,
                        'quantity' => $request->quantity,
                        'basket_item_status_id' => 1,
                        'price' => $sp->price,
                    ]);
                }
            }
            else{
                if ($request->quantity) {
                    if ($product->price!= null && $product->price !== 'ندارد' && $product->price !== 0 ) {

                        if (($count - $request->quantity) >= $max) {
                            BasketItem::create([
                                'product_id' => $product->id,
                                'basket_id' => $currentBasket->id,
                                'quantity' => $request->quantity,
                                'basket_item_status_id' => 1,
                                'price' => (int)filter_var($product->price, FILTER_SANITIZE_NUMBER_INT)
                            ]);
                        } else {
                            return response()->json([
                                'success' => false,
                                'button' => false,
                                'message' => 'موجودی انبار کافی نیست '
                            ], 200);
                        }
                    }elseif($product->old_price!= null){
                        if (($count - $request->quantity) >= $max) {
                            BasketItem::create([
                                'product_id' => $product->id,
                                'basket_id' => $currentBasket->id,
                                'quantity' => $request->quantity,
                                'basket_item_status_id' => 1,
                                'price' => (int)filter_var($product->old_price, FILTER_SANITIZE_NUMBER_INT)
                            ]);
                        } else {
                            return response()->json([
                                'success' => false,
                                'button' => false,
                                'message' => 'موجودی انبار کافی نیست'
                            ], 200);
                        }
                    }
                    else {
                        return response()->json([
                            'success' => false,
                            'button' => false,
                            'message' => 'محصول فاقد قیمت میباشد'
                        ], 200);
                    }
                }
            }
        } else {
            $newQuantity = $request->relativeMode  ? $cartItem->quantity + $request->quantity : $request->quantity;
            if (($count - $request->quantity) >= $max) {
                $cartItem->update([
                    'quantity' => $newQuantity
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'button' => false,
                    'message' => 'موجودی انبار کافی نیست'
                ], 200);
            }
        }
        self::setOrderTotalPrice2($currentBasket);
        $basketItems = self::getCustomOrder2($currentBasket);
        if ($request->relativeMode == false) {

            return response()->json([
                'success' => true,
                'message' => 'تعداد محصولات اصلاح شد',
                'cart' => $basketItems['items'],
                'cartSumPrice' => $basketItems['sumPrice'],
                'cartPayment' => $currentBasket['total_calculated'],
                'countShopping' => BasketItem::where('basket_id', $currentBasket->id)->sum('quantity'),
                'totalCount'=>$basketItems['totalCount']
            ], 200);
        }
        return response()->json([
            'success' => true,
            'message' => 'محصول با موفقیت به سبد خرید اضافه شد.',
            'cart' => $basketItems['items'],
            'cartSumPrice' => $basketItems['sumPrice'],
            'cartPayment' => $currentBasket['total_calculated'],
            'countShopping' => BasketItem::where('basket_id', $currentBasket->id)->sum('quantity'),
            'totalCount'=>$basketItems['totalCount']
        ], 200);
    }

    public function removeFromCart(Request $request)
    {
        $currentBasket = Basket::orderby('id','DESC')->authUser()->currentBasket()->first();
        if($request->variableId != NULL){
            BasketItem::whereBasketId($currentBasket->id)->whereProductId($request->productId)->whereProductVariableId($request->variableId)->delete();
        }
        else{
            BasketItem::whereBasketId($currentBasket->id)->whereProductId($request->productId)->delete();
        }
        self::setOrderTotalPrice2($currentBasket);

        $orderItems = self::getCustomOrder2($currentBasket);
        return response()->json([
            'success' => true,
            'cart' => $orderItems['items'],
            'cartSumPrice' => $orderItems['sumPrice'],
            'cartPayment' => $currentBasket['total_calculated'],
            'countShopping' => OrderItem::where('order_id', $currentBasket->id)->sum('quantity'),
            'totalCount'=>$orderItems['totalCount']
        ], 200);
    }

    public function addDiscount(Request $request)
    {
        $setting = Setting::first();
        $currentBasket = Basket::orderby('id','DESC')->authUser()->currentBasket()->first();
        if ($currentBasket->discount_id != null ){
            return response()->json([
                'success' => false,
                'button' => false,
                'message' => 'کاربر گرامی ، شما نمیتوانید برای هر خرید چندبار از کد تخفیف استفاده کنید.'
            ], 200);
        }
        $discount = Discount::where('code', $request->code)->where('used', '0')->where("from_date", "<=", Carbon::now()->timezone('Asia/Tehran')->format("Y-m-d H:i"))->where("to_date", ">=", Carbon::now()->timezone('Asia/Tehran')->format("Y-m-d H:i"))->first();
        if(!$discount){
            return response()->json([
                'success' => false,
                'button' => false,
                'message' => 'کد تخفیف معتبر نیست'
            ], 200);
        }
        $sumPrice =  0;
        foreach ($currentBasket->basketItems as $item) {
            if($item->product_variable_id != null){
                $product = ProductVariable::find($item->product_variable_id);
                if(@$product->discounted_price != null){
                    $x = @$product->discounted_price ;
                }else{
                    $x = @$product->price ;
                }
            }
            else{
                $product = Product::find($item->product_id);
                if($product->price != null && $product->price != 0){
                    $x = $product->price ;
                }else{
                    $x = $product->old_price ;
                }
            }
            $sumPrice += $x * $item->quantity;
        }
        if ($discount->user_id == null || $discount->user_id == Auth::id()) {
            if ($discount) {
                $discount_price = null;
                if ($discount->type == 1) {
                    $percent = intval($sumPrice) * intval($discount->amount) / 100;
                    $discount_price = $sumPrice - $percent;
                } elseif ($discount->type == 2) {
                    $discount_price = intval($sumPrice) - intval($discount->amount);
                }
                $total_calculated = $discount_price + ($discount_price * ($setting->tax / 100)) + intval($currentBasket['post_price']);
                $currentBasket->update([

                    'discount_id' => $discount->id,
                ]);
                $orderItems = self::getCustomOrder2($currentBasket);
                return response()->json([
                    'success' => true,
                    'cart' => $orderItems['items'],
                    'cartSumPrice' => $discount_price,
                    'cartPayment' => $total_calculated,
                    'countShopping' => OrderItem::where('order_id', $currentBasket->id)->sum('quantity')
                ], 200);
            }
            else {
                return response()->json([
                    'success' => false,
                    'button' => false,
                    'message' => 'کد تخفیف معتبر نمی باشد '
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'button' => false,
                'message' => 'کد تخفیف معتبر نمی باشد '
            ], 200);
        }
    }

    public function postCheckout(Request $request)
    {

        $shipment = ShipMent::find($request->get('shipment_id'));

        if (!Auth::check()) {
            return redirect('panel/login?order=order');
        }
        $user = Auth::user();
        $default_address = Address::authUser()->where('default_address',1)->first();
        $setting = Setting::first();
        $currentBasket = Basket::orderby('id','DESC')->authUser()->currentBasket()->first();
        $currentBasket->update([
            'shipping_method_id' => $request->get('shipment_id'),
        ]);
        if ($request->get('post_type') == null) {
            return redirect()->back()->with('error', 'روش ارسال را انتخاب کنید');
        }
        foreach($currentBasket->BasketItems as $item){
            if($item->product_variable_id != null){
                $product = ProductVariable::find($item->product_variable_id);
                if($item->quantity > $product->stock){
                    return redirect()->back()->with('error', 'موجودی انبار محصول ' . @$item->product->title . ' به پایان رسیده است');
                }
            }
            else{
                $product = Product::find($item->product_id);
                if($item->quantity > $product->count){
                    return redirect()->back()->with('error', 'موجودی انبار محصول ' . @$item->product->title . ' به پایان رسیده است');
                }
            }
        }
        $sumPrice =  0;
        foreach ($currentBasket->basketItems as $item) {
            if($item->product_variable_id != null){
                $product = ProductVariable::find($item->product_variable_id);
                if(@$product->discounted_price != null){
                    $x = @$product->discounted_price ;
                }else{
                    $x = @$product->price ;
                }
            }
            else{
                $product = Product::find($item->product_id);
                if($product->price != null && $product->price != 0){
                    $x = $product->price ;
                }else{
                    $x = $product->old_price ;
                }
            }
            $sumPrice += $x * $item->quantity;
        }

        $currentOrder = Order::create([
            "user_id" => $currentBasket->user_id,
            "total_prices" => $sumPrice,
            "total_calculated" => $sumPrice,
            "payment" => $sumPrice ,
            "description" => $request->description,
            "quantity" => $currentBasket->quantity ,
            "order_status_id" => $currentBasket->basket_status_id ,
            "cookie_id" => $currentBasket->cookie_id ,
            "discount_id" => $currentBasket->discount_id ,
            'address_id' => $default_address->id,
            'shipment_id' => $request->get('shipment_id'),
        ]);
        $payment = 0 ;
        foreach($currentBasket->basketItems as $item){
            if($item->product_variable_id != null){
                $product = ProductVariable::find($item->product_variable_id);
                if($product->discounted_price != null){
                    $x = $product->discounted_price ;
                }else{
                    $x = $product->price ;
                }
            }
            else{
                $product = Product::find($item->product_id);
                if($product->price != null && $product->price != 0){
                    $x = $product->price ;
                }else{
                    $x = $product->old_price ;
                }
            }
            $order = OrderItem::create([
                "order_id" => $currentOrder->id,
                "order_item_status_id" => $item->basket_item_status_id,
                "product_id" => $item->product_id,
                "product_variable_id" => $item->product_variable_id,
                "price" => $x,
                "quantity" => $item->quantity,
            ]);
            $payment += $x * $item->quantity;
        }
        $merchent = @$setting->merchent;
        if ($currentOrder->address_id == null) {
            return redirect()->back()->with('error', 'لطفا آدرس خود را انتخاب کنید');
        }
        $shipment_price = @$shipment->price;
        if ($shipment->pay_at_home == 1 || ($payment <= $shipment->max_price)){
            $shipment_price = 0 ;
        }
        $currentOrder->update([
            'post_price' => @$payment >= $shipment->max_price ? 0 : @$shipment->price,
            'post_type' => @$request->get('post_type'),
            'pay_type' => @$request->get('pay_type') ? 1 : 0,
            'description' => @$request->get('description'),
            'address_id' => @$default_address->id,
            'state_id' => @$default_address->state_id,
            'city_id' => @$default_address->city_id,
        ]);
        if ($currentOrder->discount_id == null){
            self::setOrderTotalPrice($currentOrder,$shipment);}
        else{
            $currentOrder->update([
                'payment' => $payment,
                'total_calculated' => $payment,
                'total_prices' => $payment,
            ]);

            $discount = Discount::where('id', $currentOrder->discount_id )->where('used', '0')->where("from_date", "<=", Carbon::now()->timezone('Asia/Tehran')->format("Y-m-d H:i"))->where("to_date", ">=", Carbon::now()->timezone('Asia/Tehran')->format("Y-m-d H:i"))->first();
            if(!$discount){
            return redirect()->back()->with('error', 'کد تخفیف معتبر نیست');
            }
            $discount_price = null;
            if ($discount->type == 1) {
                $percent = intval($currentOrder->total_prices) * intval($discount->amount) / 100;
                $discount_price = $currentOrder->total_prices - $percent;
            } elseif ($discount->type == 2) {
                $discount_price = intval($currentOrder->total_prices) - intval($discount->amount);
            }
            $total_calculated = $discount_price + ($discount_price * ($setting->tax / 100)) ;
            $currentOrder->update([
                'payment' => $shipment_price + $total_calculated,
                'total_calculated' => $shipment_price + $total_calculated,
            ]);
        }
        $orderItems = self::getCustomOrder($currentOrder);
        $currentOrder->update([
            'order_status_id' => 2,
        ]);
        // if($currentOrder->user_id == 1){
        //     $currentOrder->update(['payment'=>1100]);
        // }
        if($request->get('pay_type') == 1){
            $order_items = OrderItem::where('order_id',$currentOrder->id)->get();

            foreach ($order_items as $orderItem){
                if($orderItem->product_variable_id != null){
                    $allcount = 0 ;
                    $v = ProductVariable::find($orderItem->product_variable_id);
                    $x = $v->stock - $orderItem->quantity ;
                    $v->update([
                        'stock' => $x ,
                    ]);
                    $z = Product::find($orderItem->product_id);
                    $z->update([
                        'count' => $z->count - $orderItem->quantity ,
                    ]);
                    $ineventory = InventoryReceipt::create([
                        'product_id'=>$orderItem->product_id,
                        'inventory_id'=>1,
                        'product_variable_id '=>$v->id,
                        'inventory_type_id'=>2,
                        'count'=>$orderItem->quantity
                    ]);
                }
                else{
                    $v = Product::find($orderItem->product_id);
                    $x = $v->count - $orderItem->quantity ;
                    $v->update([
                        'count' => $x ,
                    ]);
                    $ineventory = InventoryReceipt::create([
                        'product_id'=>$orderItem->product_id,
                        'inventory_id'=>1,
                        'inventory_type_id'=>2,
                        'count'=>$orderItem->quantity
                    ]);
                }

            }
            $currentOrder->update([
                'order_status_id' => 2,
            ]);
            $currentBasket->update([
                'deleted_at' => $currentOrder->created_at ,
            ]);
            try{
                $api = new KavenegarApi($setting->kave_api);
                $receptor = $currentOrder->user->mobile;
                $token = @$currentOrder->id;
                $token2 = "";
                $token3 = "";
                $template = "buy";
                $type = "sms";//sms | call
                $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
            }
            catch(ApiException $e){
                \Log::info($e->errorMessage());
            }
            catch(HttpException $e){
                \Log::info($e->errorMessage());
            }
            try{
                $api = new KavenegarApi($setting->kave_api);
                $receptor = @$setting->kave_phonenumber;
                $token = @$currentOrder->id;
                $token2 = @$currentOrder->payment;
                $token3 = "";
                $template = "factor";
                $type = "sms";//sms | call
                $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
            }
            catch(ApiException $e){
                \Log::info($e->errorMessage());
            }
            catch(HttpException $e){
                \Log::info($e->errorMessage());
            }
            return redirect()->route('panel.orders')->with('success','سفارش با موفقیت ثبت شد');
        }else{
            if ($setting->bank_type == 1){
                $price = intval(str_replace(',', '', $currentOrder->payment . '0'));

                $data = array(
                    'MerchantID' => $merchent,
                    'order_id' => $currentOrder->id,
                    'name' => @$currentOrder->user->name.' '.@$currentOrder->user->family,
                    'amount' => $price,
                    'callback' => route('site.cart.finish3'),
                );
                \Log::info('data:'. json_encode($data));
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'X-API-KEY: '.$merchent,
                    'X-SANDBOX: 0'
                ));
                $result = curl_exec($ch);
                $err = curl_error($ch);
                $result = json_decode($result, true);
                \Log::info('hellow123');
                \Log::info($result);
                if ($err || (isset($result['error_message']) && !empty($result['error_message']))) {
                    $errorMessage = $err ?: $result['error_message'];
                    \Log::error('خطا در پرداخت:', ['error' => $errorMessage]);

                \Log::info($result);
                    $currentOrder->update([
                        'deleted_at' => $currentOrder->created_at,
                    ]);
                    

                    return redirect('/checkout/')->with('error', $errorMessage );
                }
                \Log::info('hellow');
                curl_close($ch);
                if ($err) {

                    $currentOrder->update([
                        'deleted_at' => $currentOrder->created_at,
                    ]);
                    return redirect('/checkout/')->with('error', 'خطا در پرداخت، مجدد تلاش نمایید.');
                } else {
                    $currentOrder->update([
                        'order_status_id' => 2,
                        'ref_id' => @$result["id"],
                    ]);
                    header('Location: ' . $result["link"], true, 301);
                    exit;
                }
            }elseif($setting->bank_type == 2){
                $des = @$setting->title;
                $price = intval(str_replace(',', '', $currentOrder->payment));
                $data = array(
                    'MerchantID' => $merchent,
                    'Amount' => $price,
                    'CallbackURL' => route('site.cart.finish4'),
                    'Description' => $des
                );
                $jsonData = json_encode($data);
                $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
                curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($jsonData)
                ));
                $result = curl_exec($ch);
                $err = curl_error($ch);
                $result = json_decode($result, true);
                curl_close($ch);
                if($result["Status"] == -9){
                    return redirect('/checkout/')->with('error', 'خطا در پرداخت، مجدد تلاش نمایید.');
                }
                \Log::info('hellow2');
                \Log::info($result);
                \Log::info('hellow2');
                if ($err) {
                    $currentOrder2 = Order::where('user_id',Auth::id())->orderBy('id','DESC')->where('order_status_id',2)->first();
                    $currentOrder2->update([
                        'order_status_id'=>1,
                        'deleted_at' => $currentOrder->created_at,
                    ]);
                    return redirect('/checkout/')->with('error', 'خطا در پرداخت، مجدد تلاش نمایید.');
                } else {
                    if ($result["Status"] == 100 || $result["Status"] == 101) {
                          $currentOrder->update([
                            'order_status_id' => 2,
                            'ref_id' => @$result["Authority"],
                        ]);
                        
                             $host = request()->getHost();
                        if (!$host) {
                            abort(400, "Invalid host detected.");
                        }

                        $host_name = count(explode('.', $host)) > 2
                            ? explode('.', $host)[1]
                            : explode('.', $host)[0];

                        // ساخت نام دیتابیس
                        $currentDatabase = 'mainsite_' . $host_name;

                        if (empty($currentDatabase)) {
                            abort(400, "Invalid database name.");
                        }

                      \Illuminate\Support\Facades\Config::set("database.connections.mysql", [
                            'driver' => 'mysql',
                            'url' => env('DATABASE_URL'),
                            'host' => env('DB_HOST', '127.0.0.1'),
                            'port' => env('DB_PORT', '3306'),
                            "database" => $currentDatabase,
                            "username" => $currentDatabase,
                            "password" => "r@hw!b_mon",
                            'unix_socket' => env('DB_SOCKET', ''),
                            'charset' => 'utf8mb4',
                            'collation' => 'utf8mb4_unicode_ci',
                            'prefix' => '',
                            'prefix_indexes' => true,
                            'strict' => true,
                            'engine' => null,
                            'options' => extension_loaded('pdo_mysql') ? array_filter([
                                \PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                            ]) : [],
                        ]);
                        \App\Jobs\TestInquiryJob::dispatch($currentOrder->id,$currentDatabase)->onConnection('default_mysql')
                            ->delay(now()->addMinutes(15));
                        // $this->dispatch((new OrderInquiryJob($currentOrder))->delay(15));
                          
                        header('Location: https://www.zarinpal.com/pg/StartPay/' . $result["Authority"]);
                        exit;
                        
                    } else {
                        \Log::info('result'.$result);
                        $currentOrder2 = Order::where('user_id',Auth::id())->orderBy('id','DESC')->where('order_status_id',2)->first();
                        $currentOrder2->update([
                            'order_status_id'=>1,
                            'deleted_at' => $currentOrder->created_at,
                        ]);
                        return redirect('/checkout/')->with('error', 'خطا در پرداخت، مجدد تلاش نمایید.');
                    }
                }
            }elseif($setting->bank_type == 3){
                $des = @$setting->title;
                $price = intval(str_replace(',', '', $currentOrder->payment)).'0';
                //send
                //دیتای درگاه واقعی

                $key = @$setting->meli_bank_terminal_key; //کلید
                $MerchantId = $merchent; //مرچند
                $TerminalId = @$setting->meli_bank_terminal_id; //ترمینال

                //دیتای درگاه تستی
                // $key = "8v8AEee8YfZX+wwc1TzfShRgH3O9WOho"; //کلید
                // $MerchantId = "000000140336964"; //مرچند
                // $TerminalId = 24095674; //ترمینال

                
                $Amount = $price; //YourAmount (Rials)
                $OrderId = $currentOrder->id;
                $LocalDateTime = date("m/d/Y g:i:s a");
                $ReturnUrl = url('callback-sedad');
                $SignData = self::encrypt_pkcs7("$TerminalId;$OrderId;$Amount","$key");
                $data = array(
                    'TerminalId' => $TerminalId,
                    'MerchantId' => $MerchantId,
                    'Amount' => $Amount,
                    'SignData' => $SignData,
                    'ReturnUrl' => $ReturnUrl,
                    'LocalDateTime' => $LocalDateTime,
                    'OrderId' => $OrderId
                );
                $result = self::CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Request/PaymentRequest', $data);
                if ($result->ResCode == 0) {
                    $Token = $result->Token;
                    $url = "https://sadad.shaparak.ir/VPG/Purchase";
                    echo "
                <form name='myform' action='{$url}' method='GET'>
                    <input type='hidden' id='Token' name='Token' value='{$Token}'>
                </form>
                <script type='text/javascript'>window.onload = formSubmit; function formSubmit() { document.forms[0].submit(); }</script>
            ";
                }else {
                    var_dump($result->Description);
                }
            }
        }
    }

    public function finish(Request $request)
    {

        $input = $request->all();
        $setting = Setting::first();
        $orderUser = Order::find($input['order_id']);
        $user3 = User::find($orderUser->user_id);
        Auth::login($user3);
        $merchent = $setting->merchent;
        $currentOrder = Order::authUser()->where('id',$input['order_id'])->orderBy('id','DESC')->first();
        $currentBasket = Basket::orderby('id','DESC')->authUser()->currentBasket()->first();
        if ($currentOrder == null){
            return redirect('/checkout/')->with('error','فاکتور معتبر نمی باشد');
        }
        $order_items = OrderItem::where('order_id',$currentOrder->id)->get();
        $params = array(
            'id' => $request->get('id'),
            'order_id' => $request->get('order_id'),
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/verify');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY:'.$merchent,
            'X-SANDBOX: 0',
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        if ($request['status'] !== "100" && $request['status'] !== "101" && $request['status'] !== "200" && $request['status'] !== "8" && $request['status'] !== "10" ) {
            $currentOrder->update([
                'order_status_id'=>2,
                'post_price' => null,
                'post_type' => null,
                'deleted_at' => $currentOrder->created_at,
            ]);
            if (@$currentOrder->user->mobile){
                try{
                    $api = new KavenegarApi($setting->kave_api);
                    $receptor = $currentOrder->user->mobile;
                    $token = @$currentOrder->id;
                    $token2 = "";
                    $token3 = "";
                    $template = "cancel";
                    $type = "sms";//sms | call
                    $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
                }
                catch(ApiException $e){
                    \Log::info($e->errorMessage());
                }
                catch(HttpException $e){
                    \Log::info($e->errorMessage());
                }

            }
            return redirect('/checkout/')->with('error', 'خطا در پرداخت، مجدد تلاش نمایید.');
        } else {
            if ($currentOrder->order_status_id != 3){
                $allCount = 0 ;
                foreach ($order_items as $orderItem){
                    if($orderItem->product_variable_id != null){
                        $v = ProductVariable::find($orderItem->product_variable_id);
                        $x = $v->stock - $orderItem->quantity ;
                        $v->update([
                            'quantity' => $x ,
                        ]);
                        $allCount += $orderItem->quantity ;
                        $z = Product::find($orderItem->product_id);
                        $z->update([
                            'count' => $allCount ,
                        ]);
                        $currentBasket->update([
                            'deleted_at' => $currentOrder->created_at ,
                        ]);
                        $ineventory = InventoryReceipt::create([
                            'product_id'=>$orderItem->product_id,
                            'inventory_id'=>1,
                            'product_variable_id '=>$v->id,
                            'inventory_type_id'=>2,
                            'count'=>$orderItem->quantity
                        ]);
                    }
                    else{
                        $v = Product::find($orderItem->product_id);
                        $x = $v->count - $orderItem->quantity ;
                        $v->update([
                            'count' => $x ,
                        ]);
                        $ineventory = InventoryReceipt::create([
                            'product_id'=>$orderItem->product_id,
                            'inventory_id'=>1,
                            'inventory_type_id'=>2,
                            'count'=>$orderItem->quantity
                        ]);
                    }
                }
            }
            $currentOrder->update([
                'tracking_code'=>$request['track_id'],
                'order_status_id'=>3
            ]);
            if ($currentOrder->discount_id != null){
                $discount = Discount::find($currentOrder->discount_id);
                $discount->update([
                    'used' => 1,
                ]);
            }
            try{
                $api = new KavenegarApi($setting->kave_api);
                $receptor = $currentOrder->user->mobile;
                $token = @$currentOrder->id;
                $token2 = "";
                $token3 = "";
                $template = "buy";
                $type = "sms";//sms | call
                $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
            }
            catch(ApiException $e){
                \Log::info($e->errorMessage());
            }
            catch(HttpException $e){
                \Log::info($e->errorMessage());
            }
            try{
                $api = new KavenegarApi($setting->kave_api);
                $receptor = @$setting->kave_phonenumber;
                $token = @$currentOrder->id;
                $token2 = @$currentOrder->payment;
                $token3 = "";
                $template = "factor";
                $type = "sms";//sms | call
                $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
            }
            catch(ApiException $e){
                \Log::info($e->errorMessage());
            }
            catch(HttpException $e){
                \Log::info($e->errorMessage());
            }
            return redirect()->route('panel.orders')->with('success','پرداخت با موفقیت انجام شد');
        }
    }

    public function finishZarin(Request $request)
    {
        $input = $request->all();
        \Log::info($input);
        $currentOrder = Order::authUser()->where('order_status_id',2)->orderBy('id','DESC')->first();
        $currentBasket = Basket::orderby('id','DESC')->authUser()->currentBasket()->first();

        \Log::info($currentOrder);
        if ($currentOrder == null){
            return redirect('/checkout/')->with('error','فاکتور معتبر نمی باشد');
        }
        $order_items = OrderItem::where('order_id',$currentOrder->id)->get();
        $setting = Setting::first();
        $des = @$setting->title;
        $merchent = @$setting->merchent;
        $price = intval(str_replace(',', '', $currentOrder->payment));
        $Authority = $request->Authority;
        $data = array('MerchantID' => $merchent,
            'Authority' => $Authority,
            'Amount' => $price);
        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        \Log::info($result);
        $currentOrder->update([
            'tracking_code'=>$result['RefID'],
            'order_status_id'=>3
        ]);
        if ($err) {
            \Log::info($err);
            $currentOrder2 = Order::where('user_id',Auth::id())->orderBy('id','DESC')->where('order_status_id',3)->first();
            $currentOrder2->update([
                'order_status_id'=>2,
                'post_price' => null,
                'post_type' => null,
                'deleted_at' => $currentOrder->created_at,
            ]);
            if (@$currentOrder2->user->mobile){
                try{
                    $api = new KavenegarApi($setting->kave_api);
                    $receptor = $currentOrder->user->mobile;
                    $token = @$currentOrder->id;
                    $token2 = "";
                    $token3 = "";
                    $template = "cancel";
                    $type = "sms";//sms | call
                    $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
                }
                catch(ApiException $e){
                    \Log::info($e->errorMessage());
                }
                catch(HttpException $e){
                    \Log::info($e->errorMessage());
                }
            }
            return redirect('/checkout/')->with('error', 'خطا در پرداخت، مجدد تلاش نمایید.');
        } else {
            if ($result['Status'] == 100) {
                $allCount = 0 ;
                foreach ($order_items as $orderItem){
                    if($orderItem->product_variable_id != null){
                        $v = ProductVariable::find($orderItem->product_variable_id);
                        $x = $v->stock - $orderItem->quantity ;
                        $v->update([
                            'stock' => $x ,
                        ]);
                        $allCount += $orderItem->quantity ;
                        $z = Product::find($orderItem->product_id);
                        $z->update([
                            'count' => $allCount ,
                        ]);
                        $ineventory = InventoryReceipt::create([
                            'product_id'=>$orderItem->product_id,
                            'inventory_id'=>1,
                            'product_variable_id '=>$v->id,
                            'inventory_type_id'=>2,
                            'count'=>$orderItem->quantity
                        ]);
                    }
                    else{
                        $v = Product::find($orderItem->product_id);
                        $x = $v->count - $orderItem->quantity ;
                        $v->update([
                            'count' => $x ,
                        ]);
                        $ineventory = InventoryReceipt::create([
                            'product_id'=>$orderItem->product_id,
                            'inventory_id'=>1,
                            'inventory_type_id'=>2,
                            'count'=>$orderItem->quantity
                        ]);
                    }
                }
                $currentBasket->update([
                    'deleted_at' => $currentOrder->created_at ,
                ]);

                $currentOrder->update([
                    'tracking_code'=>$request['track_id'],
                    'order_status_id'=>3
                ]);
                if ($currentOrder->discount_id != null){
                    $discount = Discount::find($currentOrder->discount_id);
                    $discount->update([
                        'used' => 1,
                    ]);
                }
                try{
                    $api = new KavenegarApi($setting->kave_api);
                    $receptor = $currentOrder->user->mobile;
                    $token = @$currentOrder->id;
                    $token2 = "";
                    $token3 = "";
                    $template = "buy";
                    $type = "sms";//sms | call
                    $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
                }
                catch(ApiException $e){
                    \Log::info($e->errorMessage());
                }
                catch(HttpException $e){
                    \Log::info($e->errorMessage());
                }
                try{
                    $api = new KavenegarApi($setting->kave_api);
                    $receptor = @$setting->kave_phonenumber;
                    $token = @$currentOrder->id;
                    $token2 = @$currentOrder->payment;
                    $token3 = "";
                    $template = "factor";
                    $type = "sms";//sms | call
                    $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
                }
                catch(ApiException $e){
                    \Log::info($e->errorMessage());
                }
                catch(HttpException $e){
                    \Log::info($e->errorMessage());
                }
                $discount= Discount::find($currentOrder->discount_id);
                if(@$discount){
                    $discount->update([
                        'used'=>1
                    ]);
                }
                return redirect()->route('panel.orders')->with('success','پرداخت با موفقیت انجام شد');
            } else {
                $currentOrder->update([
                    'order_status_id'=>2,
                    'deleted_at' => $currentOrder->created_at,

                ]);
                return redirect('/checkout/')->with('error', 'خطا در پرداخت، مجدد تلاش نمایید.');
            }
        }
    }

    public function finishSedad(Request $request){
        $input = $request->all();
        $setting = Setting::first();
        $currentOrder = Order::where('id',$_POST["OrderId"])->orderBy('id','DESC')->first();
        Auth::loginUsingId($currentOrder->user_id);
        $currentBasket = Basket::orderby('id','DESC')->authUser()->currentBasket()->first();
        if ($currentOrder == null){
            return redirect('/checkout/')->with('error','فاکتور معتبر نمی باشد');
        }
        $order_items = OrderItem::where('order_id',$currentOrder->id)->get();
        //verify
        $key = @$setting->meli_bank_terminal_key; //کلید
        $OrderId = @$_POST["OrderId"];
        $Token = @$_POST["token"];
        $ResCode = @$_POST["ResCode"];
        $verifyData = array(
            'Token' => $Token,
            'SignData' => self::encrypt_pkcs7($Token, $key)
        );
        $result = self::CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Advice/Verify', $verifyData);
        if ($result->ResCode != -1 && $result->ResCode == 0 || $result->ResCode == 100) {
            /*
            * Save this Data To DataBase
            * --------------------------
            * $result->RetrivalRefNo
            * $result->SystemTraceNo
            * $result->OrderId
            */
            if ($currentOrder->order_status_id != 3){
                $allCount = 0;
                foreach ($order_items as $orderItem){
                    if($orderItem->product_variable_id != null){
                        $v = ProductVariable::find($orderItem->product_variable_id);
                        $x = $v->stock - $orderItem->quantity ;
                        $v->update([
                            'stock' => $x ,
                        ]);
                        $allCount += $orderItem->quantity ;
                        $z = Product::find($orderItem->product_id);
                        $z->update([
                            'count' => $allCount ,
                        ]);
                        $ineventory = InventoryReceipt::create([
                            'product_id'=>$orderItem->product_id,
                            'inventory_id'=>1,
                            'product_variable_id '=>$v->id,
                            'inventory_type_id'=>2,
                            'count'=>$orderItem->quantity
                        ]);
                    }
                    else{
                        $v = Product::find($orderItem->product_id);
                        $x = $v->count - $orderItem->quantity ;
                        $v->update([
                            'count' => $x ,
                        ]);
                        $ineventory = InventoryReceipt::create([
                            'product_id'=>$orderItem->product_id,
                            'inventory_id'=>1,
                            'inventory_type_id'=>2,
                            'count'=>$orderItem->quantity
                        ]);
                    }
                }
                $currentBasket->update([
                    'deleted_at' => $currentOrder->created_at ,
                ]);
            }
            $currentOrder->update([
                'tracking_code'=>$result->SystemTraceNo,
                'ref_id'=>$result->RetrivalRefNo,
                'order_status_id'=>3
            ]);
            if ($currentOrder->discount_id != null){
                $discount = Discount::find($currentOrder->discount_id);
                $discount->update([
                    'used' => 1,
                ]);
            }
            try{
                $api = new KavenegarApi($setting->kave_api);
                $receptor = $currentOrder->user->mobile;
                $token = @$currentOrder->id;
                $token2 = "";
                $token3 = "";
                $template = "buy";
                $type = "sms";//sms | call
                $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
            }
            catch(ApiException $e){
                \Log::info($e->errorMessage());
            }
            catch(HttpException $e){
                \Log::info($e->errorMessage());
            }
            try{
                $api = new KavenegarApi($setting->kave_api);
                $receptor = @$setting->kave_phonenumber;
                $token = @$currentOrder->id;
                $token2 = @$currentOrder->payment;
                $token3 = "";
                $template = "factor";
                $type = "sms";//sms | call
                $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
            }
            catch(ApiException $e){
                \Log::info($e->errorMessage());
            }
            catch(HttpException $e){
                \Log::info($e->errorMessage());
            }
            $discount= Discount::find($currentOrder->discount_id);
            if(@$discount){
                $discount->update([
                    'used'=>1
                ]);
            }
            return redirect()->route('panel.orders')->with('success','پرداخت با موفقیت انجام شد');
        }
        else{
            return redirect('/checkout/')->with('error', 'خطا در پرداخت، مجدد تلاش نمایید.');
        }
    }




    //Sedad BANK
    public static function encrypt_pkcs7($str, $key)
    {
        $key = base64_decode($key);
        $ciphertext = OpenSSL_encrypt($str, "DES-EDE3", $key, OPENSSL_RAW_DATA);
        return base64_encode($ciphertext);
    }

    public static function CallAPI($url, $data = false)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8'));
            curl_setopt($ch, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $result = curl_exec($ch);
            curl_close($ch);
            return !empty($result) ? json_decode($result) : false;
        }
        catch (Exception $ex) {
            return false;
        }
    }

//    public function getTokenSadad(Request $request)
//    {
//        //دیتای درگاه واقعی
//        $key = "fyx0tuTmwUREvk8Z+Li4T6R90gXW3YYi"; //کلید
//        $MerchantId = "000000140341632"; //مرچند
//        $TerminalId = 24102954; //ترمینال
//
//        //دیتای درگاه تستی
//        // $key = "8v8AEee8YfZX+wwc1TzfShRgH3O9WOho"; //کلید
//        // $MerchantId = "000000140336964"; //مرچند
//        // $TerminalId = 24095674; //ترمینال
//
//        $Amount = 10000; //YourAmount (Rials)
//        $OrderId = random_int(1000, 9999);
//        $LocalDateTime = date("m/d/Y g:i:s a");
//        $ReturnUrl = url('callback-sedad');
//        $SignData = self::encrypt_pkcs7("$TerminalId;$OrderId;$Amount","$key");
//        $data = array(
//            'TerminalId' => $TerminalId,
//            'MerchantId' => $MerchantId,
//            'Amount' => $Amount,
//            'SignData' => $SignData,
//            'ReturnUrl' => $ReturnUrl,
//            'LocalDateTime' => $LocalDateTime,
//            'OrderId' => $OrderId
//        );
//        $result = self::CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Request/PaymentRequest', $data);
//        if ($result->ResCode == 0) {
//            $Token = $result->Token;
//            $url = "https://sadad.shaparak.ir/VPG/Purchase";
//            echo "
//                <form name='myform' action='{$url}' method='GET'>
//                    <input type='hidden' id='Token' name='Token' value='{$Token}'>
//                </form>
//                <script type='text/javascript'>window.onload = formSubmit; function formSubmit() { document.forms[0].submit(); }</script>
//            ";
//        }else {
//            var_dump($result->Description);
//        }
//    }

//    public function callBackSadad(Request $request){
//        $key = "fyx0tuTmwUREvk8Z+Li4T6R90gXW3YYi";
//        $OrderId = @$_POST["OrderId"];
//        $Token = @$_POST["token"];
//        $ResCode = @$_POST["ResCode"];
//        $verifyData = array(
//            'Token' => $Token,
//            'SignData' => self::encrypt_pkcs7($Token, $key)
//        );
//        $result = self::CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Advice/Verify', $verifyData);
//        if ($result->ResCode != -1 && $result->ResCode == 0 || $result->ResCode == 100) {
//            return redirect()->route('site.home')->with('success','پرداخت با موفقیت انجام شد');
//        }else{
//            return redirect()->route('site.home')->with('error','پرداخت با موفقیت انجام شد');
//        }
//    }
}

