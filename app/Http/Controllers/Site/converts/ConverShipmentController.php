<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\ShipMent;
use App\Models\ShipmentCity;
use App\Models\Order;
use App\Models\City;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;
class ConverShipmentController extends Controller
{
    public function convert()
    {
        $setting = Setting::first();
        //dd($setting->post_city, $setting->post_name1, $setting->post_price1, $setting->post_name2, $setting->post_price2);

        $shipment = ShipMent::create([
            'title' => $setting->post_name1,
            'price' => $setting->post_price1,
            'status' => 1,

        ]);

        $shipment2 = ShipMent::create([
            'title' => $setting->post_name2,
            'price' => $setting->post_price2,
            'status' => 1,

        ]);

        $shipmentCity = ShipmentCity::create([
            'ship_ment_id' => $shipment->id,
            'city_id' => $setting->post_city,
        ]);

        $cities = City::where('id', '<>', $setting->post_city)->get();
        foreach($cities as $city)
        {
            $shipmentCity2 = ShipmentCity::create([
                'ship_ment_id' => $shipment2->id,
                'city_id' => $city->id,
            ]);
        }

        $orders =  Order::all();
        foreach($orders as $order)
        {
            if($order->post_type == 1)
            {
                $order->update([
                    'shipment_id' => $shipment->id,
                ]);
            }else
            {
                $order->update([
                    'shipment_id' => $shipment2->id,
                ]);

            }
        }



    }

    public function insert(Request $request){
        $inserted_doms = $request->get('domains', []);
        $domains = Domain::all();
        $missingDomains = collect($inserted_doms)->diff($domains->pluck('domain'));
        $arr = [];
        foreach ($missingDomains as $key=>$item){

                $arr[] = [

                    'domain'=>$item,

                ];
            }
        Domain::insert($arr);
        $domain_s = Domain::all();
        dd($domain_s);
    }

    public function checkDomainsAndPing(Request $request)
    {
        set_time_limit(200000000);
        \Log::info($request->page);

        $domains = Domain::where('check',0)->paginate(5);
        $ipToPing = '185.208.79.200';
        foreach ($domains as $domain) {
            if ($domain->domain) {
                $url = 'https://' . $domain->domain;

                // تعداد تلاش‌ها برای درخواست
                $maxAttempts = 3;
                $attempts = 0;


                do {
                    try {
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // ignore SSL certificate validation
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // فعال کردن دنبال کردن هدایت
                        $result = curl_exec($ch);

                        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        if ($httpCode != 200) {
                            $domain->update([
                                'out_of_service' => $httpCode
                            ]);
                        }

                        break; // خروج از حلقه در صورت موفقیت

                    } catch (Exception $e) {
                        \Log::info($e->getMessage());
                    } finally {
                        curl_close($ch);
                    }

                    $attempts++;

                } while ($attempts < $maxAttempts);
                // تست پینگ ه
                try {
                    $ip = gethostbyname($domain->domain);
                    if ($ip != $ipToPing){
                        $domain->update([
                            'not_similar_host' => $ip
                        ]);
                    }

                } catch (Exception $e) {
                    \Log::info($e->getMessage());
                }

            }
            $domain->update([
                'check'=>1
            ]);
        }
        if (count($domains->items()) > 0) {
            $next_page = $domains->currentPage() + 1;
            return redirect(url()->current() . '?page=' . $next_page);
        }

    }

    public function databases(){
        
        $tableNameShipments = 'shipments';

        if (!Schema::connection('mysql')->hasTable($tableNameShipments)) {
            Schema::connection('mysql')->create($tableNameShipments, function ($tableShipments) {
                $tableShipments->bigIncrements('id')->unsigned();
                $tableShipments->string('title', 191)->nullable()->default(null);
                $tableShipments->integer('price')->nullable()->default(null);
                $tableShipments->integer('max_price')->nullable()->default(null);
                $tableShipments->boolean('pay_at_home')->default(0);
                $tableShipments->integer('sort')->nullable()->default(null);
                $tableShipments->text('description');
                $tableShipments->boolean('status')->default(0);
                $tableShipments->timestamp('created_at')->nullable()->default(null);
                $tableShipments->timestamp('updated_at')->nullable()->default(null);
                $tableShipments->timestamp('deleted_at')->nullable()->default(null);
            });
        } else {
            $columnTypesShipments = [
                'title' => 'string',
                'price' => 'integer',
                'max_price' => 'integer',
                'pay_at_home' => 'boolean',
                'sort' => 'integer',
                'description' => 'text',
                'status' => 'boolean',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypesShipments as $columnShipments => $typeShipments) {
                if (!Schema::connection('mysql')->hasColumn($tableNameShipments, $columnShipments)) {
                    Schema::connection('mysql')->table($tableNameShipments, function ($tableShipments) use ($columnShipments, $typeShipments) {
                        if ($typeShipments === 'string') {
                            $tableShipments->{$typeShipments}($columnShipments)->nullable()->default(null);
                        } elseif ($typeShipments === 'text') {
                            $tableShipments->{$typeShipments}($columnShipments)->nullable()->default(null);
                        } elseif ($typeShipments === 'timestamp') {
                            $tableShipments->{$typeShipments}($columnShipments)->nullable()->default(null);
                        } else {
                            $tableShipments->{$typeShipments}($columnShipments)->default(0);
                        }
                    });
                }
            }
        }
    }
    public function addDb()
    {
        $tableName = 'baskets';

        if (!Schema::connection('mysql')->hasTable($tableName)) {
            Schema::connection('mysql')->create($tableName, function ($table) {
                // افزودن فیلدها
                $table->id();
                $table->integer('user_id')->nullable()->default(null);
                $table->string('cookie_id')->nullable()->default(null);
                $table->integer('address_id')->nullable()->default(null);
                $table->integer('shipping_method_id')->nullable()->default(null);
                $table->integer('has_gift')->nullable()->default(0);
                $table->text('description')->nullable()->default(null);
                $table->integer('discount_id')->nullable()->default(null);
                $table->integer('delivery_time_id')->nullable()->default(null);
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent();
                $table->timestamp('deleted_at')->nullable();
            });
        } else {
            // افزودن فیلدها فقط اگر وجود نداشته باشند
            $columnTypes = [
                'user_id' => 'integer',
                'cookie_id' => 'string',
                'address_id' => 'integer',
                'shipping_method_id' => 'integer',
                'has_gift' => 'integer',
                'description' => 'text',
                'discount_id' => 'integer',
                'delivery_time_id' => 'integer',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypes as $column => $type) {
                if (!Schema::connection('mysql')->hasColumn($tableName, $column)) {
                    Schema::connection('mysql')->table($tableName, function ($table) use ($column, $type) {
                        $table->{$type}($column)->nullable()->default(null);
                    });
                }
            }
        }
            //
        $tableName2 = 'basket_items';

        if (!Schema::connection('mysql')->hasTable($tableName2)) {
            Schema::connection('mysql')->create($tableName2, function ($table2) {
                $table2->id();
                $table2->integer('basket_id')->nullable()->default(null);
                $table2->integer('basket_item_status_id')->nullable()->default(null);
                $table2->integer('product_id')->nullable()->default(null);
                $table2->integer('product_variable_id')->nullable()->default(null);
                $table2->double('price', 15, 2)->default(0.00);
                $table2->integer('quantity')->nullable()->default(null);
                $table2->timestamp('created_at')->useCurrent();
                $table2->timestamp('updated_at')->useCurrent();
                $table2->timestamp('deleted_at')->nullable()->default(null);
            });
        } else {
            $columnTypes2 = [
                'basket_id' => 'integer',
                'basket_item_status_id' => 'integer',
                'product_id' => 'integer',
                'product_variable_id' => 'integer',
                'price' => 'double',
                'quantity' => 'integer',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypes2 as $column2 => $type2) {
                if (!Schema::connection('mysql')->hasColumn($tableName2, $column2)) {
                    Schema::connection('mysql')->table($tableName2, function ($table2) use ($column2, $type2) {
                        if ($type2 === 'double') {
                            $table2->{$type2}($column2, 15, 2)->default(0.00);
                        }
                        elseif ($type2 === 'timestamp') {
                            $table2->{$type2}($column2)->nullable()->default(null);
                        }
                        else {
                            $table2->{$type2}($column2)->nullable()->default(null);
                        }
                    });
                }
            }
        }
        //
        $tableName3 = 'brands';

        if (!Schema::connection('mysql')->hasTable($tableName3)) {
            Schema::connection('mysql')->create($tableName3, function ($table3) {
                $table3->id();
                $table3->bigInteger('old_id', 20)->nullable()->default(null);
                $table3->string('title');
                $table3->string('title_seo')->nullable()->default(null);
                $table3->text('description_seo');
                $table3->text('description');
                $table3->text('keyword');
                $table3->string('url')->nullable()->default(null);
                $table3->string('image')->nullable()->default(null);
                $table3->integer('status')->default(0);
                $table3->integer('footer')->default(0);
                $table3->string('old_link')->nullable()->default(null);
                $table3->string('old_image')->nullable()->default(null);
                $table3->string('title2')->nullable()->default(null);
                $table3->timestamp('created_at')->useCurrent();
                $table3->timestamp('updated_at')->useCurrent();
                $table3->timestamp('deleted_at')->nullable()->default(null);
            });
        } else {
            $columnTypes3 = [
                'old_id' => 'bigInteger',
                'title' => 'string',
                'title_seo' => 'string',
                'description_seo' => 'text',
                'description' => 'text',
                'keyword' => 'text',
                'url' => 'string',
                'image' => 'string',
                'status' => 'integer',
                'footer' => 'integer',
                'old_link' => 'string',
                'old_image' => 'string',
                'title2' => 'string',
            ];

            foreach ($columnTypes3 as $column3 => $type3) {
                if (!Schema::connection('mysql')->hasColumn($tableName3, $column3)) {
                    Schema::connection('mysql')->table($tableName3, function ($table3) use ($column3, $type3) {
                        if ($type3 === 'string') {
                            $table3->{$type3}($column3)->nullable()->default(null);
                        } elseif ($type3 === 'text') {
                            $table3->{$type3}($column3)->nullable()->default(null);
                        } elseif ($type3 === 'bigInteger') {
                            $table3->{$type3}($column3, 20)->nullable()->default(null);
                        }
                        elseif ($type3 === 'timestamp') {
                            $table3->{$type3}($column3)->nullable()->default(null);
                        }
                        else {
                            $table3->{$type3}($column3)->default(0);
                        }
                    });
                }
            }
        }
        //
        $tableName4 = 'tags';

        if (!Schema::connection('mysql')->hasTable($tableName4)) {
            Schema::connection('mysql')->create($tableName3, function ($table4) {
                $table4->id();
                $table4->string('title')->nullable()->default(null);
                $table4->string('title_seo')->nullable()->default(null);
                $table4->text('description_seo');
                $table4->text('description');
                $table4->string('url')->nullable()->default(null);
                $table4->timestamp('created_at')->useCurrent();
                $table4->timestamp('updated_at')->useCurrent();
                $table4->timestamp('deleted_at')->nullable()->default(null);
            });
        } else {
            $columnTypes4 = [
                'title' => 'string',
                'title_seo' => 'string',
                'description_seo' => 'text',
                'description' => 'text',
                'url' => 'string',
            ];

            foreach ($columnTypes4 as $column4 => $type4) {
                if (!Schema::connection('mysql')->hasColumn($tableName4, $column4)) {
                    Schema::connection('mysql')->table($tableName4, function ($table4) use ($column4, $type4) {
                        if ($type4 === 'string') {
                            $table4->{$type4}($column4)->nullable()->default(null);
                        } elseif ($type4 === 'text') {
                            $table4->{$type4}($column4)->nullable()->default(null);
                        } elseif ($type4 === 'bigInteger') {
                            $table4->{$type4}($column4, 20)->nullable()->default(null);
                        }
                        elseif ($type4 === 'timestamp') {
                            $table4->{$type4}($column4)->nullable()->default(null);
                        }
                        else {
                            $table4->{$type4}($column4)->default(0);
                        }
                    });
                }
            }
        }
        //
        $tableName5 = 'shipment_city';

        if (!Schema::connection('mysql')->hasTable($tableName5)) {
            Schema::connection('mysql')->create($tableName5, function ($table5) {
                $table5->id();
                $table5->integer('ship_ment_id')->nullable()->default(null);
                $table5->integer('city_id')->nullable()->default(null);
            });
        } else {
            $columnTypes5 = [
                'ship_ment_id' => 'bigInteger',
                'city_id' => 'bigInteger',
            ];

            foreach ($columnTypes5 as $column5 => $type5) {
                if (!Schema::connection('mysql')->hasColumn($tableName5, $column5)) {
                    Schema::connection('mysql')->table($tableName5, function ($table5) use ($column5, $type5) {
                        if ($type5 === 'string') {
                            $table5->{$type5}($column5)->nullable()->default(null);
                        } elseif ($type5 === 'text') {
                            $table5->{$type5}($column5)->nullable()->default(null);
                        } elseif ($type5 === 'bigInteger') {
                            $table5->{$type5}($column5, 20)->nullable()->default(null);
                        }
                        elseif ($type5 === 'timestamp') {
                            $table5->{$type5}($column5)->nullable()->default(null);
                        }
                        else {
                            $table5->{$type5}($column5)->default(0);
                        }
                    });
                }
            }
        }
        //
        $tableName6 = 'categories';

        if (!Schema::connection('mysql')->hasTable($tableName6)) {
            Schema::connection('mysql')->create($tableName6, function ($table6) {
                $table6->id();
                $table6->bigInteger('old_id', 20)->nullable()->default(null);
                $table6->bigInteger('parent_id', 20)->nullable()->default(null);
                $table6->string('title')->nullable()->default(null);
                $table6->string('title_seo')->nullable()->default(null);
                $table6->text('description_seo');
                $table6->text('description');
                $table6->text('keyword');
                $table6->string('url')->nullable()->default(null);
                $table6->string('image')->nullable()->default(null);
                $table6->integer('status')->default(0);
                $table6->integer('footer')->default(0);
                $table6->string('old_image')->nullable()->default(null);
                $table6->string('cover')->nullable()->default(null);
                $table6->string('mega')->nullable()->default(null);
                $table6->string('title2')->nullable()->default(null);
                $table6->string('old_link')->nullable()->default(null);
                $table6->string('parent_title')->nullable()->default(null);
                $table6->bigInteger('sort', 20)->default('0');
                $table6->bigInteger('show_menu', 20)->default('0');
                $table6->bigInteger('show_footer', 20)->default('0');
                $table6->timestamp('created_at')->useCurrent();
                $table6->timestamp('updated_at')->useCurrent();
                $table6->timestamp('deleted_at')->nullable()->default(null);
            });
        } else {
            $columnTypes6 = [
                'old_id' => 'bigInteger',
                'parent_id' => 'bigInteger',
                'title' => 'string',
                'title_seo' => 'string',
                'description_seo' => 'text',
                'description' => 'text',
                'keyword' => 'text',
                'url' => 'string',
                'image' => 'string',
                'status' => 'integer',
                'footer' => 'integer',
                'old_link' => 'string',
                'old_image' => 'string',
                'cover' => 'string',
                'mega' => 'string',
                'title2' => 'string',
                'parent_title' => 'string',
                'sort' => 'bigInteger',
                'show_menu' => 'bigInteger',
                'show_footer' => 'bigInteger',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypes6 as $column6 => $type6) {
                if (!Schema::connection('mysql')->hasColumn($tableName6, $column6)) {
                    Schema::connection('mysql')->table($tableName6, function ($table6) use ($column6, $type6) {
                        if ($type6 === 'string') {
                            $table6->{$type6}($column6)->nullable()->default(null);
                        } elseif ($type6 === 'text') {
                            $table6->{$type6}($column6)->nullable()->default(null);
                        } elseif ($type6 === 'bigInteger') {
                            $table6->{$type6}($column6, 20)->nullable()->default(null);
                        }
                        elseif ($type6 === 'timestamp') {
                            $table6->{$type6}($column6)->nullable()->default(null);
                        }
                        else {
                            $table6->{$type6}($column6)->default(0);
                        }
                    });
                }
            }
        }
        //
        $tableName7 = 'contents';

        if (!Schema::connection('mysql')->hasTable($tableName7)) {
            Schema::connection('mysql')->create($tableName7, function ($table7) {
                $table7->id();
                $table7->bigInteger('parent_id', 20)->nullable()->default(null);
                $table7->string('title')->nullable()->default(null);
                $table7->string('title_seo')->nullable()->default(null);
                $table7->text('description_seo');
                $table7->text('description');
                $table7->text('keyword');
                $table7->string('url')->nullable()->default(null);
                $table7->string('image')->nullable()->default(null);
                $table7->integer('status')->default(0);
                $table7->integer('footer')->default(0);
                $table7->string('link')->nullable()->default(null);
                $table7->bigInteger('sort', 20)->default('0');
                $table7->bigInteger('view', 20)->default('0');
                $table7->bigInteger('content_type', 20)->default('0');
                $table7->bigInteger('baner_type', 20)->default('0');
                $table7->timestamp('created_at')->useCurrent();
                $table7->timestamp('updated_at')->useCurrent();
                $table7->timestamp('deleted_at')->nullable()->default(null);
            });
        } else {
            $columnTypes7 = [
                'parent_id' => 'bigInteger',
                'title' => 'string',
                'title_seo' => 'string',
                'description_seo' => 'text',
                'description' => 'text',
                'keyword' => 'text',
                'url' => 'string',
                'image' => 'string',
                'status' => 'integer',
                'footer' => 'integer',
                'link' => 'string',
                'sort' => 'bigInteger',
                'view' => 'bigInteger',
                'content_type' => 'bigInteger',
                'baner_type' => 'bigInteger',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypes7 as $column7 => $type7) {
                if (!Schema::connection('mysql')->hasColumn($tableName7, $column7)) {
                    Schema::connection('mysql')->table($tableName7, function ($table7) use ($column7, $type7) {
                        if ($type7 === 'string') {
                            $table7->{$type7}($column7)->nullable()->default(null);
                        } elseif ($type7 === 'text') {
                            $table7->{$type7}($column7)->nullable()->default(null);
                        } elseif ($type7 === 'bigInteger') {
                            $table7->{$type7}($column7, 20)->nullable()->default(null);
                        }
                        elseif ($type7 === 'timestamp') {
                            $table7->{$type7}($column7)->nullable()->default(null);
                        }
                        else {
                            $table7->{$type7}($column7)->default(0);
                        }
                    });
                }
            }
        }
        //
        $tableName8 = 'orders';

        if (!Schema::connection('mysql')->hasTable($tableName8)) {
            Schema::connection('mysql')->create($tableName8, function ($table8) {
                $table8->id();
                $table8->integer('user_id')->nullable()->default(null);
                $table8->double('total_prices', 15, 2)->default(0.00);
                $table8->double('total_calculated', 15, 2)->default(0.00);
                $table8->double('payment', 15, 2)->default(0.00);
                $table8->double('discount', 15, 2)->default(0.00);
                $table8->double('tax1', 15, 2)->default(0.00);
                $table8->double('tax2', 15, 2)->default(0.00);
                $table8->double('fee', 15, 2)->default(0.00);
                $table8->integer('quantity')->default(0);
                $table8->integer('storage_id')->nullable()->default(null);
                $table8->integer('order_status_id');
                $table8->integer('bank_id')->nullable()->default(null);
                $table8->integer('transaction_id')->nullable()->default(null);
                $table8->string('ref_id')->nullable()->default(null);
                $table8->string('tracking_code')->nullable()->default(null);
                $table8->timestamp('delivery_time')->nullable()->default(null);
                $table8->integer('delivery_type_id')->nullable()->default(null);
                $table8->timestamp('paid_date')->nullable()->default(null);
                $table8->timestamp('delivery_date')->nullable()->default(null);
                $table8->timestamp('send_date')->nullable()->default(null);
                $table8->integer('address_id')->nullable()->default(null);
                $table8->integer('city_id')->nullable()->default(null);
                $table8->integer('state_id')->nullable()->default(null);
                $table8->integer('post_type')->nullable()->default(null);
                $table8->integer('pay_type')->default(0);
                $table8->string('post_price')->nullable()->default(null);
                $table8->string('cookie_id')->nullable()->default(null);
                $table8->integer('discount_id')->nullable()->default(null);
                $table8->timestamp('created_at')->useCurrent();
                $table8->timestamp('updated_at')->useCurrent();
                $table8->timestamp('deleted_at')->nullable()->default(null);
                $table8->text('description');
                $table8->boolean('seen')->default(0);
                $table8->integer('shipment_id')->nullable()->default(null);
                $table8->timestamp('created_at')->useCurrent();
                $table8->timestamp('updated_at')->useCurrent();
                $table8->timestamp('deleted_at')->nullable()->default(null);
            });
        } else {
            $columnTypes8 = [
                'user_id' => 'integer',
                'total_prices' => 'double',
                'total_calculated' => 'double',
                'payment' => 'double',
                'discount' => 'double',
                'tax1' => 'double',
                'tax2' => 'double',
                'fee' => 'double',
                'quantity' => 'integer',
                'storage_id' => 'integer',
                'order_status_id' => 'integer',
                'bank_id' => 'integer',
                'transaction_id' => 'integer',
                'ref_id' => 'string',
                'tracking_code' => 'string',
                'delivery_time' => 'timestamp',
                'delivery_type_id' => 'integer',
                'paid_date' => 'timestamp',
                'delivery_date' => 'timestamp',
                'send_date' => 'timestamp',
                'address_id' => 'integer',
                'city_id' => 'integer',
                'state_id' => 'integer',
                'post_type' => 'integer',
                'pay_type' => 'integer',
                'post_price' => 'string',
                'cookie_id' => 'string',
                'discount_id' => 'integer',
                'description' => 'text',
                'seen' => 'boolean',
                'shipment_id' => 'integer',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypes8 as $column8 => $type8) {
                if (!Schema::connection('mysql')->hasColumn($tableName8, $column8)) {
                    Schema::connection('mysql')->table($tableName8, function ($table8) use ($column8, $type8) {
                        if ($type8 === 'string') {
                            $table8->{$type8}($column8)->nullable()->default(null);
                        } elseif ($type8 === 'text') {
                            $table8->{$type8}($column8)->nullable()->default(null);
                        } elseif ($type8 === 'double') {
                            $table8->{$type8}($column8, 15, 2)->default(0.00);
                        }
                        elseif ($type8 === 'timestamp') {
                            $table8->{$type8}($column8)->nullable()->default(null);
                        }
                        else {
                            $table8->{$type8}($column8)->default(0);
                        }
                    });
                }
            }
        }
        //
        $tableName9 = 'order_items';

        if (!Schema::connection('mysql')->hasTable($tableName9)) {
            Schema::connection('mysql')->create($tableName9, function ($table9) {
                $table9->id();
                $table9->integer('order_id');
                $table9->integer('order_item_status_id');
                $table9->integer('product_id');
                $table9->integer('product_specification_type_id')->nullable()->default(null);
                $table9->integer('product_specification_value_id')->nullable()->default(null);
                $table9->integer('product_specification_id')->nullable()->default(null);
                $table9->double('price', 15, 2)->default(0.00);
                $table9->double('discount', 15, 2)->default(0.00);
                $table9->integer('quantity')->default(0);
                $table9->double('tax1', 15, 2)->default(0.00);
                $table9->double('tax2', 15, 2)->default(0.00);
                $table9->timestamp('created_at')->useCurrent();
                $table9->timestamp('updated_at')->useCurrent();
                $table9->timestamp('deleted_at')->nullable()->default(null);
                $table9->integer('product_variable_id')->nullable()->default(null);
            });
        } else {
            $columnTypes9 = [
                'order_id' => 'integer',
                'order_item_status_id' => 'integer',
                'product_id' => 'integer',
                'product_specification_type_id' => 'integer',
                'product_specification_value_id' => 'integer',
                'product_specification_id' => 'integer',
                'price' => 'double',
                'discount' => 'double',
                'quantity' => 'integer',
                'tax1' => 'double',
                'tax2' => 'double',
                'product_variable_id' => 'integer',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypes9 as $column9 => $type9) {
                if (!Schema::connection('mysql')->hasColumn($tableName9, $column9)) {
                    Schema::connection('mysql')->table($tableName9, function ($table9) use ($column9, $type9) {
                        if ($type9 === 'double') {
                            $table9->{$type9}($column9, 15, 2)->default(0.00);
                        }
                        elseif ($type9 === 'timestamp') {
                            $table9->{$type9}($column9)->nullable()->default(null);
                        }
                        else {
                            $table9->{$type9}($column9)->default(0);
                        }
                    });
                }
            }
        }

        $tableName10 = 'products';

        if (!Schema::connection('mysql')->hasTable($tableName10)) {
            Schema::connection('mysql')->create($tableName10, function ($table10) {
                $table10->id();
                $table10->bigInteger('old_id', 20)->nullable()->default(null);
                $table10->string('title')->nullable()->default(null);
                $table10->string('title2')->nullable()->default(null);
                $table10->string('title_en')->nullable()->default(null);
                $table10->string('title_seo')->nullable()->default(null);
                $table10->text('description_seo');
                $table10->text('keyword');
                $table10->string('warning')->nullable()->default(null);
                $table10->string('url')->nullable()->default(null);
                $table10->integer('brand_id')->nullable()->default(null);
                $table10->text('description');
                $table10->text('lead');
                $table10->integer('status')->default(0);
                $table10->integer('sort')->default(0);
                $table10->integer('special')->default(0);
                $table10->string('max')->nullable()->default(null);
                $table10->text('weight');
                $table10->integer('available')->default(1);
                $table10->integer('popular')->default(0);
                $table10->integer('newest')->default(0);
                $table10->integer('sell')->default(0);
                $table10->integer('timer')->default(0);
                $table10->string('hour')->nullable()->default(null);
                $table10->timestamp('date')->nullable()->default(null);
                $table10->string('count')->nullable()->default(null);
                $table10->string('shenase')->nullable()->default(null);
                $table10->string('category_name')->nullable()->default(null);
                $table10->string('brand_name')->nullable()->default(null);
                $table10->string('old_link')->nullable()->default(null);
                $table10->string('old_image')->nullable()->default(null);
                $table10->text('old_images');
                $table10->text('video_link');
                $table10->integer('price')->nullable()->default(null);
                $table10->integer('old_price')->nullable()->default(null);
                $table10->timestamp('created_at')->useCurrent();
                $table10->timestamp('updated_at')->useCurrent();
                $table10->timestamp('deleted_at')->nullable()->default(null);
                $table10->boolean('soon')->default(0);
            });
        } else {
            $columnTypes10 = [
                'old_id' => 'bigInteger',
                'title' => 'string',
                'title2' => 'string',
                'title_en' => 'string',
                'title_seo' => 'string',
                'description_seo' => 'text',
                'keyword' => 'text',
                'warning' => 'string',
                'url' => 'string',
                'brand_id' => 'integer',
                'description' => 'text',
                'lead' => 'text',
                'status' => 'integer',
                'sort' => 'integer',
                'special' => 'integer',
                'max' => 'string',
                'weight' => 'text',
                'available' => 'integer',
                'popular' => 'integer',
                'newest' => 'integer',
                'sell' => 'integer',
                'timer' => 'integer',
                'hour' => 'string',
                'date' => 'timestamp',
                'count' => 'string',
                'shenase' => 'string',
                'category_name' => 'string',
                'brand_name' => 'string',
                'old_link' => 'string',
                'old_image' => 'string',
                'old_images' => 'text',
                'video_link' => 'text',
                'price' => 'integer',
                'old_price' => 'integer',
                'soon' => 'boolean',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypes10 as $column10 => $type10) {
                if (!Schema::connection('mysql')->hasColumn($tableName10, $column10)) {
                    Schema::connection('mysql')->table($tableName10, function ($table10) use ($column10, $type10) {
                        if ($type10 === 'string') {
                            $table10->{$type10}($column10)->nullable()->default(null);
                        } elseif ($type10 === 'text') {
                            $table10->{$type10}($column10)->nullable()->default(null);
                        } elseif ($type10 === 'bigInteger') {
                            $table10->{$type10}($column10, 20)->nullable()->default(null);
                        } elseif ($type10 === 'timestamp') {
                            $table10->{$type10}($column10)->nullable()->default(null);
                        } else {
                            $table10->{$type10}($column10)->default(0);
                        }
                    });
                }
            }
        }
        $tableName11 = 'product_specifications';

        if (!Schema::connection('mysql')->hasTable($tableName11)) {
            Schema::connection('mysql')->create($tableName11, function ($table11) {
                $table11->id();
                $table11->integer('product_id');
                $table11->integer('product_specification_type_id');
                $table11->integer('product_specification_value_id');
                $table11->text('description');
                $table11->string('view_type', 30)->nullable()->default(null);
                $table11->double('price', 15, 2)->default(0.00);
                $table11->string('image')->nullable()->default(null);
                $table11->text('color');
                $table11->text('barcode');
                $table11->string('max')->nullable()->default(null);
                $table11->timestamp('created_at')->useCurrent();
                $table11->timestamp('updated_at')->useCurrent();
                $table11->timestamp('deleted_at')->nullable()->default(null);
            });
        } else {
            $columnTypes11 = [
                'product_id' => 'integer',
                'product_specification_type_id' => 'integer',
                'product_specification_value_id' => 'integer',
                'description' => 'text',
                'view_type' => 'string',
                'price' => 'double',
                'image' => 'string',
                'color' => 'text',
                'barcode' => 'text',
                'max' => 'string',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypes11 as $column11 => $type11) {
                if (!Schema::connection('mysql')->hasColumn($tableName11, $column11)) {
                    Schema::connection('mysql')->table($tableName11, function ($table11) use ($column11, $type11) {
                        if ($type11 === 'string') {
                            $table11->{$type11}($column11)->nullable()->default(null);
                        } elseif ($type11 === 'text') {
                            $table11->{$type11}($column11)->nullable()->default(null);
                        } elseif ($type11 === 'double') {
                            $table11->{$type11}($column11, 15, 2)->default(0.00);
                        }
                        elseif ($type11 === 'timestamp') {
                            $table11->{$type11}($column11)->nullable()->default(null);
                        }
                        else {
                            $table11->{$type11}($column11)->default(0);
                        }
                    });
                }
            }
        }

        $tableName12 = 'product_specification_types';

        if (!Schema::connection('mysql')->hasTable($tableName12)) {
            Schema::connection('mysql')->create($tableName12, function ($table12) {
                $table12->id();
                $table12->text('title');
                $table12->string('showed_title', 300)->nullable()->default(null);
                $table12->integer('parent_id')->nullable()->default(null);
                $table12->bigInteger('old_id1', 20)->nullable()->default(null);
                $table12->bigInteger('old_id2', 20)->nullable()->default(null);
                $table12->integer('status')->default(0);
                $table12->integer('view')->default(0);
                $table12->string('view_type', 10)->nullable()->default(null);
                $table12->timestamp('created_at')->useCurrent();
                $table12->timestamp('updated_at')->useCurrent();
                $table12->timestamp('deleted_at')->nullable()->default(null);
                $table12->integer('sort')->default(0);
            });
        } else {
            $columnTypes12 = [
                'title' => 'text',
                'showed_title' => 'string',
                'parent_id' => 'integer',
                'old_id1' => 'bigInteger',
                'old_id2' => 'bigInteger',
                'status' => 'integer',
                'view' => 'integer',
                'view_type' => 'string',
                'sort' => 'integer',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypes12 as $column12 => $type12) {
                if (!Schema::connection('mysql')->hasColumn($tableName12, $column12)) {
                    Schema::connection('mysql')->table($tableName12, function ($table12) use ($column12, $type12) {
                        if ($type12 === 'string') {
                            $table12->{$type12}($column12)->nullable()->default(null);
                        }
                        elseif ($type12 === 'timestamp') {
                            $table12->{$type12}($column12)->nullable()->default(null);
                        }
                        else {
                            $table12->{$type12}($column12)->default(0);
                        }
                    });
                }
            }
        }
        $tableName13 = 'properties';

        if (!Schema::connection('mysql')->hasTable($tableName13)) {
            Schema::connection('mysql')->create($tableName13, function ($table13) {
                $table13->id();
                $table13->integer('product_id')->nullable()->default(null);
                $table13->text('description');
                $table13->integer('status')->default(0);
                $table13->timestamp('created_at')->useCurrent();
                $table13->timestamp('updated_at')->useCurrent();
                $table13->timestamp('deleted_at')->nullable()->default(null);
                $table13->integer('sort')->nullable()->default(null);
            });
        } else {
            $columnTypes13 = [
                'product_id' => 'integer',
                'description' => 'text',
                'status' => 'integer',
                'sort' => 'integer',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypes13 as $column13 => $type13) {
                if (!Schema::connection('mysql')->hasColumn($tableName13, $column13)) {
                    Schema::connection('mysql')->table($tableName13, function ($table13) use ($column13, $type13) {
                        $table13->{$type13}($column13)->nullable()->default(null);
                    });
                }
            }
        }
        $tableName14 = 'product_variables';

        if (!Schema::connection('mysql')->hasTable($tableName14)) {
            Schema::connection('mysql')->create($tableName14, function ($table14) {
                $table14->id();
                $table14->string('title')->nullable()->default(null);
                $table14->integer('product_id')->nullable()->default(null);
                $table14->double('price', 15, 2)->default(0.00);
                $table14->text('description')->nullable()->default(null);
                $table14->integer('stock')->nullable()->default(null);
                $table14->string('image')->nullable()->default(null);
                $table14->timestamp('created_at')->useCurrent();
                $table14->timestamp('updated_at')->useCurrent();
                $table14->timestamp('deleted_at')->nullable()->default(null);
            });
        } else {
            $columnTypes14 = [
                'title' => 'string',
                'product_id' => 'integer',
                'price' => 'double',
                'description' => 'text',
                'stock' => 'integer',
                'image' => 'string',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypes14 as $column14 => $type14) {
                if (!Schema::connection('mysql')->hasColumn($tableName14, $column14)) {
                    Schema::connection('mysql')->table($tableName14, function ($table14) use ($column14, $type14) {
                        if ($type14 === 'string') {
                            $table14->{$type14}($column14)->nullable()->default(null);
                        } elseif ($type14 === 'text') {
                            $table14->{$type14}($column14)->nullable()->default(null);
                        } elseif ($type14 === 'double') {
                            $table14->{$type14}($column14, 15, 2)->default(0.00);
                        }
                        elseif ($type14 === 'timestamp') {
                            $table14->{$type14}($column14)->nullable()->default(null);
                        }

                        else {
                            $table14->{$type14}($column14)->nullable()->default(null);
                        }
                    });
                }
            }
        }
        $tableNameShipments = 'shipments';

        if (!Schema::connection('mysql')->hasTable($tableNameShipments)) {
            Schema::connection('mysql')->create($tableNameShipments, function ($tableShipments) {
                $tableShipments->bigIncrements('id')->unsigned();
                $tableShipments->string('title', 191)->nullable()->default(null);
                $tableShipments->integer('price')->nullable()->default(null);
                $tableShipments->integer('max_price')->nullable()->default(null);
                $tableShipments->boolean('pay_at_home')->default(0);
                $tableShipments->integer('sort')->nullable()->default(null);
                $tableShipments->text('description');
                $tableShipments->boolean('status')->default(0);
                $tableShipments->timestamp('created_at')->nullable()->default(null);
                $tableShipments->timestamp('updated_at')->nullable()->default(null);
                $tableShipments->timestamp('deleted_at')->nullable()->default(null);
            });
        } else {
            $columnTypesShipments = [
                'title' => 'string',
                'price' => 'integer',
                'max_price' => 'integer',
                'pay_at_home' => 'boolean',
                'sort' => 'integer',
                'description' => 'text',
                'status' => 'boolean',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypesShipments as $columnShipments => $typeShipments) {
                if (!Schema::connection('mysql')->hasColumn($tableNameShipments, $columnShipments)) {
                    Schema::connection('mysql')->table($tableNameShipments, function ($tableShipments) use ($columnShipments, $typeShipments) {
                        if ($typeShipments === 'string') {
                            $tableShipments->{$typeShipments}($columnShipments)->nullable()->default(null);
                        } elseif ($typeShipments === 'text') {
                            $tableShipments->{$typeShipments}($columnShipments)->nullable()->default(null);
                        } elseif ($typeShipments === 'timestamp') {
                            $tableShipments->{$typeShipments}($columnShipments)->nullable()->default(null);
                        } else {
                            $tableShipments->{$typeShipments}($columnShipments)->default(0);
                        }
                    });
                }
            }
        }
        $tableNameSettings = 'setting';

        if (!Schema::connection('mysql')->hasTable($tableNameSettings)) {
            Schema::connection('mysql')->create($tableNameSettings, function ($tableSettings) {
                $tableSettings->id();
                $tableSettings->bigInteger('id')->unsigned();
                $tableSettings->string('title')->nullable();
                $tableSettings->string('logo')->nullable();
                $tableSettings->string('favicon')->nullable();
                $tableSettings->string('abouttitle')->nullable();
                $tableSettings->longText('about');
                $tableSettings->longText('about2');
                $tableSettings->string('aboutimg')->nullable();
                $tableSettings->longText('contact');
                $tableSettings->longText('maps');
                $tableSettings->longText('email');
                $tableSettings->longText('address');
                $tableSettings->longText('description_seo');
                $tableSettings->longText('phone');
                $tableSettings->timestamps();
                $tableSettings->softDeletes();
                $tableSettings->longText('rules')->nullable();
                $tableSettings->string('tax')->nullable();
                $tableSettings->text('alert');
                $tableSettings->integer('disable')->default(0);
                $tableSettings->string('color1')->nullable();
                $tableSettings->string('color2')->nullable();
                $tableSettings->string('color3')->nullable();
                $tableSettings->string('color4')->nullable();
                $tableSettings->integer('noindex')->default(0);
                $tableSettings->string('h1')->nullable();
                $tableSettings->text('logo2');
                $tableSettings->text('title_artcat');
                $tableSettings->text('des_artcat');
                $tableSettings->text('title_brand');
                $tableSettings->text('des_brand');
                $tableSettings->text('title_offers');
                $tableSettings->text('des_offers');
                $tableSettings->text('title_contact');
                $tableSettings->text('des_contact');
                $tableSettings->text('title_rules');
                $tableSettings->text('des_rules');
                $tableSettings->text('title_products');
                $tableSettings->text('des_products');
                $tableSettings->integer('post_city')->nullable();
                $tableSettings->string('post_name1')->nullable();
                $tableSettings->integer('post_price1')->nullable();
                $tableSettings->string('post_name2')->nullable();
                $tableSettings->integer('post_price2')->nullable();
                $tableSettings->text('kave_phonenumber');
                $tableSettings->string('special_img')->nullable();
                $tableSettings->text('kave_api');
                $tableSettings->string('head_enamd')->nullable();
                $tableSettings->text('footer_enamd');
                $tableSettings->string('whatsapp')->nullable();
                $tableSettings->text('analytics');
                $tableSettings->text('tagmanager');
                $tableSettings->integer('bank_type')->default(1);
                $tableSettings->text('merchent');
                $tableSettings->string('title_1');
                $tableSettings->string('title_2');
                $tableSettings->string('title_3');
                $tableSettings->boolean('description_type')->default(1);
                $tableSettings->text('code1');
                $tableSettings->text('code2');
                $tableSettings->integer('status_send')->nullable();
                $tableSettings->integer('box_discount')->nullable();
                $tableSettings->string('icon_fix')->nullable();
                $tableSettings->string('icon_filter')->nullable();
                $tableSettings->text('call_description');
                $tableSettings->string('meli_bank_terminal_id')->nullable();
                $tableSettings->string('meli_bank_terminal_key')->nullable();
                $tableSettings->boolean('status_police')->default(0);
                $tableSettings->string('color5')->nullable();
            });
        } else {
            $columnTypesSettings = [
                'title' => 'string',
                'logo' => 'string',
                'favicon' => 'string',
                'abouttitle' => 'string',
                'about' => 'text',
                'about2' => 'text',
                'aboutimg' => 'string',
                'contact' => 'text',
                'maps' => 'text',
                'email' => 'text',
                'address' => 'text',
                'description_seo' => 'text',
                'phone' => 'text',
                'rules' => 'text',
                'tax' => 'string',
                'alert' => 'text',
                'disable' => 'integer',
                'color1' => 'string',
                'color2' => 'string',
                'color3' => 'string',
                'color4' => 'string',
                'noindex' => 'integer',
                'h1' => 'string',
                'logo2' => 'text',
                'title_artcat' => 'text',
                'des_artcat' => 'text',
                'title_brand' => 'text',
                'des_brand' => 'text',
                'title_offers' => 'text',
                'des_offers' => 'text',
                'title_contact' => 'text',
                'des_contact' => 'text',
                'title_rules' => 'text',
                'des_rules' => 'text',
                'title_products' => 'text',
                'des_products' => 'text',
                'post_city' => 'integer',
                'post_name1' => 'string',
                'post_price1' => 'integer',
                'post_name2' => 'string',
                'post_price2' => 'integer',
                'kave_phonenumber' => 'text',
                'special_img' => 'string',
                'kave_api' => 'text',
                'head_enamd' => 'string',
                'footer_enamd' => 'text',
                'whatsapp' => 'string',
                'analytics' => 'text',
                'tagmanager' => 'text',
                'bank_type' => 'integer',
                'merchent' => 'text',
                'title_1' => 'string',
                'title_2' => 'string',
                'title_3' => 'string',
                'description_type' => 'boolean',
                'code1' => 'text',
                'code2' => 'text',
                'status_send' => 'integer',
                'box_discount' => 'integer',
                'icon_fix' => 'string',
                'icon_filter' => 'string',
                'call_description' => 'text',
                'meli_bank_terminal_id' => 'string',
                'meli_bank_terminal_key' => 'string',
                'status_police' => 'boolean',
                'color5' => 'string',
            ];

            foreach ($columnTypesSettings as $columnSettings => $typeSettings) {
                if (!Schema::connection('mysql')->hasColumn($tableNameSettings, $columnSettings)) {
                    Schema::connection('mysql')->table($tableNameSettings, function ($tableSettings) use ($columnSettings, $typeSettings) {
                        if ($typeSettings === 'string') {
                            $tableSettings->{$typeSettings}($columnSettings)->nullable()->default(null);
                        } elseif ($typeSettings === 'text') {
                            $tableSettings->{$typeSettings}($columnSettings)->nullable()->default(null);
                        } elseif ($typeSettings === 'timestamp') {
                            $tableSettings->{$typeSettings}($columnSettings)->nullable()->default(null);
                        } else {
                            $tableSettings->{$typeSettings}($columnSettings)->default(0);
                        }
                    });
                }
            }
        }
        $tableNameLikes = 'likes';

        if (!Schema::connection('mysql')->hasTable($tableNameLikes)) {
            Schema::connection('mysql')->create($tableNameLikes, function ($tableLikes) {
                $tableLikes->id();
                $tableLikes->string('ip')->nullable()->default(null);
                $tableLikes->integer('user_id')->nullable()->default(null);
                $tableLikes->integer('likeable_id')->nullable()->default(null);
                $tableLikes->string('likeable_type')->nullable()->default(null);
                $tableLikes->timestamps();
                $tableLikes->softDeletes();
            });
        } else {
            $columnTypesLikes = [
                'ip' => 'string',
                'user_id' => 'integer',
                'likeable_id' => 'integer',
                'likeable_type' => 'string',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
                'deleted_at' => 'timestamp',
            ];

            foreach ($columnTypesLikes as $columnLikes => $typeLikes) {
                if (!Schema::connection('mysql')->hasColumn($tableNameLikes, $columnLikes)) {
                    Schema::connection('mysql')->table($tableNameLikes, function ($tableLikes) use ($columnLikes, $typeLikes) {
                        if ($typeLikes === 'string') {
                            $tableLikes->{$typeLikes}($columnLikes)->nullable()->default(null);
                        } elseif ($typeLikes === 'timestamp') {
                            $tableLikes->{$typeLikes}($columnLikes)->nullable()->default(null);
                        } else {
                            $tableLikes->{$typeLikes}($columnLikes)->default(0);
                        }
                    });
                }
            }
        }


    }
}
