<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Library\Helper;
use App\Library\Logs;
use App\Models\Order;
use App\Models\InventoryReceipt;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Kavenegar\KavenegarApi;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function getIndex(Request $request)
    {
        $query = Order::query();
        if($request->get('name')){
            $query->whereHas('user',function (Builder $query2)use($request) {
                $query2->where('name' , 'LIKE', '%' . $request->get('name') . '%');
            });

        }
        if($request->get('family')){
            $query->whereHas('user',function (Builder $query2)use($request) {
                $query2->where('family' , 'LIKE', '%' . $request->get('family') . '%');
            });

        }
        if ($request->get('id')) {
            $query->where('id', $request->get('id'));
        }
        if($request->get('mobile')){
            $query->whereHas('user',function (Builder $query2)use($request) {
                $query2->where('mobile' , $request->get('mobile'));
            });

        }
        if($request->get('email')){
            $query->whereHas('user',function (Builder $query2)use($request) {
                $query2->where('email' , $request->get('email'));
            });

        }
        if ($request->get('start') and $request->get('end')) {

            $start = explode('/', $request->get('start'));
            $end = explode('/', $request->get('end'));

            $s = jmktime(0, 0, 0, $start[1], $start[0], $start[2]);
            $e = jmktime(0, 0, 0, $end[1], $end[0], $end[2]);

            $query->whereBetween('created_at', array(Carbon::createFromTimestamp($s), Carbon::createFromTimestamp($e)));
        }

        if($request->get('payment')){
            $query->where('payment' ,[intval($request->get('payment'))]);
        }
        if ($request->get('order_status_id')) {
            $query->where('order_status_id', $request->get('order_status_id'));
        }
        $status = OrderStatus::all();
        $data = $query->orderBy('id','DESC')->paginate(100);
        
        return View('admin.order.index')
            ->with('status', $status)
            ->with('data', $data);
    }

    public function getDetail($id)
    {
        $order = Order::find($id);
        $status = OrderStatus::all();
        
         $order->update([
            'seen' => 1,
        ]);
        return View('admin.order.details')
            ->with('status', $status)
            ->with('order', $order);
    }

    public function orderStatus($id, Request $request)
    {
        
        $order = Order::find($id);
        $setting = Setting::first();
        $input = $request->all();
        
        $input['order_status_id'] = $request['order_status_id'];
        
        $mobile = Helper::persian2LatinDigit(@$order->user->mobile);
        $x = @$order->user->name;


        if ($input['order_status_id'] == 6){
            try{

                $api = new KavenegarApi($setting->kave_api);
                $receptor = @$mobile;
                $token = @$id;
                $token2 = "";
                $token3 = "";
                $template = "decline";
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
        elseif ($input['order_status_id'] == 10){
            try{
                $api = new KavenegarApi($setting->kave_api);
                $receptor = @$mobile;
                $token = @$id;
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

            $order_items = OrderItem::where('order_id', $order->id)->get();
            if($order->order_status_id != 1)
            {
                foreach($order_items as $item)
                {
                    $sum =+ $item->quantity;
                    InventoryReceipt::create([
                        'product_id' => $item->product_id,
                        'inventory_type_id' => 1,
                        'count' => $sum,
                    ]);
                    $pro = Product::find($item->product_id);
                    $pro->update([
                        'count' => $pro->count + $sum,
                    ]);

                }
            }





        }
        elseif ($input['order_status_id'] == 5){
            try{
                $api = new KavenegarApi($setting->kave_api);
                $receptor = @$mobile;
                $token = @$id;
                $token2 = "";
                $token3 = "";
                $template = "send";
                $type = "sms";//sms | call
                $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);

            }
            catch(ApiException $e){

                \Log::info($e->errorMessage());
            }
            catch(HttpException $e){

                \Log::info($e->errorMessage());
            }
            if($order->order_status_id == 10)
            {
                $order_items = OrderItem::where('order_id', $order->id)->get();

                foreach($order_items as $item)
                {
                    $sum =+ $item->quantity;
                    $pro = Product::find($item->product_id);
                    if($pro->count - $sum < 0)
                    {
                    return redirect()->back()->with('error', 'محصولات این فاکتور به تعداد کافی در انبار موجود نیست');
                    }

                    InventoryReceipt::create([
                    'product_id' => $item->product_id,
                    'inventory_type_id' => 2,
                    'count' => $sum,
                    ]);
                    $pro->update([
                        'count' => $pro->count - $sum,
                    ]);
                }






            }

        }
        elseif ($input['order_status_id'] == 4){
            try{
                $api = new KavenegarApi($setting->kave_api);
                $receptor = @$mobile;
                $token = @$id;
                $token2 = "";
                $token3 = "";
                $template = "pack";
                $type = "sms";//sms | call
                $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
            }
            catch(ApiException $e){
                \Log::info($e->errorMessage());



            }
            catch(HttpException $e){
                \Log::info($e->errorMessage());


            }
            if($order->order_status_id == 10)
            {
                $order_items = OrderItem::where('order_id', $order->id)->get();

                foreach($order_items as $item)
                {
                    $sum =+ $item->quantity;

                    $pro = Product::find($item->product_id);
                    if($pro->count - $sum < 0)
                    {
                    return redirect()->back()->with('error', 'محصولات این فاکتور به تعداد کافی در انبار موجود نیست');
                    }

                    InventoryReceipt::create([
                        'product_id' => $item->product_id,
                        'inventory_type_id' => 2,
                        'count' => $sum,
                    ]);
                    $pro->update([
                        'count' => $pro->count - $sum,
                    ]);
                }




            }

        }
        elseif ($input['order_status_id'] == 3){
            try{
                $api = new KavenegarApi($setting->kave_api);
                $receptor = @$mobile;
                $token = @$id;
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

            if($order->order_status_id == 10)
            {
                $order_items = OrderItem::where('order_id', $order->id)->get();

                foreach($order_items as $item)
                {
                    $sum =+ $item->quantity;
                    $pro = Product::find($item->product_id);
                    if($pro->count - $sum < 0)
                    {
                    return redirect()->back()->with('error', 'محصولات این فاکتور به تعداد کافی در انبار موجود نیست');
                    }

                    InventoryReceipt::create([
                        'product_id' => $item->product_id,
                        'inventory_type_id' => 2,
                        'count' => $sum,
                    ]);
                    $pro->update([
                        'count' => $pro->count - $sum,
                    ]);

                }




            }

        }
        $array = array($input);
        $serialized_array = serialize($array);
        $order->update($input);
        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$order->id);
        return Redirect::action('Admin\OrderController@getIndex')
            ->with('success', 'آیتم مورد نظر با موفقیت ویرابش شد.');
    }
    public function postDelete(Request $request)
    {

        $input = $request->all();
        $setting = Setting::first();
        $orders = Order::orderby('user_id','desc')->find($request['deleteId']);
        if($input['order_status_id'] !== null){
            foreach($orders as $order)
            {
                $array = array($order);
                $serialized_array = serialize($array);
                $order->update([
                    'order_status_id'=> $input['order_status_id']
                ]);
                $mobile = Helper::persian2LatinDigit(@$order->user->mobile);
                $x = @$order->user->name;
                if ($input['order_status_id'] == 6){
                    try{
                        $api = new KavenegarApi($setting->kave_api);
                        $receptor = @$mobile;
                        $token = @$order->id;
                        $token2 = "";
                        $token3 = "";
                        $template = "decline";
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
                elseif ($input['order_status_id'] == 10){
                    try{
                        $api = new KavenegarApi($setting->kave_api);
                        $receptor = @$mobile;
                        $token = @$order->id;
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
                elseif ($input['order_status_id'] == 5){
                    try{
                        $api = new KavenegarApi($setting->kave_api);
                        $receptor = @$mobile;
                        $token = @$order->id;
                        $token2 = "";
                        $token3 = "";
                        $template = "send";
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
                elseif ($input['order_status_id'] == 4){
                    try{
                        $api = new KavenegarApi($setting->kave_api);
                        $receptor = @$mobile;
                        $token = @$order->id;
                        $token2 = "";
                        $token3 = "";
                        $template = "pack";
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
                elseif ($input['order_status_id'] == 3){
                    try{
                        $api = new KavenegarApi($setting->kave_api);
                        $receptor = @$mobile;
                        $token = @$order->id;
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

                }


                $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$order->id);
            }

        }

        return \redirect()->back()
            ->with('success', 'وضعیت های مورد نظر با موفقیت ویرایش شدند.');
    }
    public function getfactor($id)
    {
        $order = Order::find($id);
        $status = OrderStatus::all();
        return View('admin.order.factor')
            ->with('status', $status)
            ->with('order', $order);
    }
    public function export(Request $request2)
    {
        return Excel::download(new OrderExport($request2), 'order.xlsx');
    }

}
