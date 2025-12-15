<?php

namespace App\Jobs;

use App\Models\Basket;
use App\Models\Discount;
use App\Models\InventoryReceipt;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariable;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Kavenegar\KavenegarApi;

class TestInquiryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    protected $databaseName;

    /**
     * Create a new job instance.
     *
     * @param $order
     * @param string $databaseName
     */
    public function __construct($order, string $databaseName)
    {
        // \Log::info('hi job');
        if (!$order || !$databaseName) {
            \Log::error("Invalid Job Parameters: order or databaseName is missing.");
            throw new \InvalidArgumentException("Order or database name cannot be null.");
        }


        // \Log::info($order);
        // \Log::info($databaseName);

        // Config::set("database.connections.mysql", config('database.connections.mainsite_omumi'));
        $this->order = $order;
        $this->databaseName = $databaseName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        DB::disconnect('mysql');

        Config::set("database.connections.mysql", [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            "database" => $this->databaseName,
            "username" => $this->databaseName,
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


        // دریافت اطلاعات سفارش از دیتابیس جدید
        $my_order = \App\Models\Order::find($this->order);

        if ($my_order) {
            if ($my_order->order_status_id !== 2) {
                \Log::info("Skipping CheckTransactionStatus for order ID {$this->order} as it is not 2.");
                return;
            }
            $setting = Setting::first();
            try {
                $merchant_id = @$setting->merchent;
                $authority = $my_order->ref_id;
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.zarinpal.com/pg/v4/payment/inquiry.json?merchant_id=$merchant_id&authority=$authority",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Accept: application/json'
                    ),
                ));
                $result = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    \Log::error('Error in Bank (CURL): ' . $err);
                    $my_order->update([
                        'order_status_id' => 9,
                    ]);
                }
                if ($result === false || is_null($result)) {
                    \Log::error('Error in Bank: Response is null');
                    return;
                }
                $result = json_decode($result, true);
                if (!$result) {
                    \Log::error('Error in Bank: JSON decode failed');
                    return;
                }
                \Log::info('Result from Bank1: ', $result);
                if (isset($result['data']['code']) && !$result['data']['code'] == 100) {
                    \Log::info('Result from Bank2: ', $result);
                    $my_order->update([
                        'order_status_id' => 9,
                    ]);
                }
                if ($my_order->order_status_id == 2) {
                    if (isset($result['data']) && ($result['data']['status'] == 'VERIFIED' || $result['data']['status'] == 'PAID')) {
                        if ($my_order->ref_id == null) {
                            $my_order->update([
                                'order_status_id' => 3,
                                'ref_id' => @$result["data"]["authority"] ? $result["data"]["authority"] : null,
                            ]);
                        } else {
                            $my_order->update([
                                'order_status_id' => 3,
                            ]);
                        }
                        $order_items = OrderItem::where('order_id', $my_order->id)->get();
                        //موجودی و پیامک و تخفیف
                        $allCount = 0;
                        foreach ($order_items as $orderItem) {
                            if ($orderItem->product_variable_id != null) {
                                $v = ProductVariable::find($orderItem->product_variable_id);
                                $x = $v->stock - $orderItem->quantity;
                                $v->update([
                                    'stock' => $x,
                                ]);
                                $allCount += $orderItem->quantity;
                                $z = Product::find($orderItem->product_id);
                                $z->update([
                                    'count' => $allCount,
                                ]);
                                $ineventory = InventoryReceipt::create([
                                    'product_id' => $orderItem->product_id,
                                    'inventory_id' => 1,
                                    'product_variable_id ' => $v->id,
                                    'inventory_type_id' => 2,
                                    'count' => $orderItem->quantity
                                ]);
                            } else {
                                $v = Product::find($orderItem->product_id);
                                $x = $v->count - $orderItem->quantity;
                                $v->update([
                                    'count' => $x,
                                ]);
                                $ineventory = InventoryReceipt::create([
                                    'product_id' => $orderItem->product_id,
                                    'inventory_id' => 1,
                                    'inventory_type_id' => 2,
                                    'count' => $orderItem->quantity
                                ]);
                            }
                        }
                 
                        try {
                            $api = new KavenegarApi($setting->kave_api);
                            $receptor = $my_order->user->mobile;
                            $token = @$my_order->id;
                            $token2 = "";
                            $token3 = "";
                            $template = "buy";
                            $type = "sms";//sms | call
                            $result = $api->VerifyLookup($receptor, $token, $token2, $token3, $template, $type);
                        } catch (ApiException $e) {
                            \Log::info($e->errorMessage());
                        } catch (HttpException $e) {
                            \Log::info($e->errorMessage());
                        }
                        try {
                            $api = new KavenegarApi($setting->kave_api);
                            $receptor = @$setting->kave_phonenumber;
                            $token = @$my_order->id;
                            $token2 = @$my_order->payment;
                            $token3 = "";
                            $template = "factor";
                            $type = "sms";//sms | call
                            $result = $api->VerifyLookup($receptor, $token, $token2, $token3, $template, $type);
                        } catch (ApiException $e) {
                            \Log::info($e->errorMessage());
                        } catch (HttpException $e) {
                            \Log::info($e->errorMessage());
                        }
                       



                      //
                    } elseif (isset($result['data']) && ($result['data']['status'] == 'FAILED' || $result['data']['status'] == 'REVERSED' || $result['data']['status'] == 'IN_BANK')) {
                        $my_order->update([
                            'order_status_id' => 9,
                        ]);
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Error in Bank: ' . $e->getMessage());
                $my_order->update([
                    'order_status_id' => 9,
                ]);
            }
        } else {
            \Log::error("Order not found in database: $this->databaseName");
        }
    }
}
