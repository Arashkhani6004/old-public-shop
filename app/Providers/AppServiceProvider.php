<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!app()->runningInConsole()) {

            if(env('APP_ENV') === "production"){
                $host_name = count(explode('.', request()->getHost())) > 2 ? explode('.', request()->getHost())[1] : explode('.', request()->getHost())[0];

//                $jsonData = Storage::disk('local')->get('private/black-list.json');
                $sites = config('deactive_domains');
                if (in_array(request()->getHost(), $sites)) {
                    echo "سایت درحال بروزرسانی میباشد";
                    die();
                }

                DB::disconnect('mysql');
                Config::set("database.connections.mysql", [
                    'driver' => 'mysql',
                    'url' => env('DATABASE_URL'),
                    'host' => env('DB_HOST', '127.0.0.1'),
                    'port' => env('DB_PORT', '3306'),
                    "database" => "mainsite_" . $host_name,
                    "username" => "mainsite_" . $host_name,
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
            }

            require_once app_path('Library/composer.php');
        }
        require_once app_path('Library/jdate.php');
        require_once app_path('Library/UploadImg.php');
        require_once app_path('Library/UploadImgArticle.php');
        require_once app_path('Library/UploadImgBrand.php');
        require_once app_path('Library/Resizer.php');
//        require_once app_path('Library/Watermark.php');
        require_once app_path('Library/MakeTree.php');

        Schema::defaultStringLength(191);

    }
}
