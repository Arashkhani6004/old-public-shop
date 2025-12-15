<?php

namespace App\Http\Middleware;

use App\Library\Helper;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ConnectionMiddleware
{
    
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        $segments = $request->segments();
        $segmentCounter = count($segments);
        $host_name = count(explode('.',request()->getHost())) > 2 ? explode('.',request()->getHost())[1] : explode('.',request()->getHost())[0];
        try {
            DB::disconnect('mysql');
                Config::set("database.connections.mysql", [
                    'driver' => 'mysql',
                    'url' => env('DATABASE_URL'),
                    'host' => env('DB_HOST', '127.0.0.1'),
                    'port' => env('DB_PORT', '3306'),
                    "database" => "mainsite_".$host_name,
                    "username" => "mainsite_".$host_name,
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
            } catch (ApiException $e) {
                \Log::info($e->errorMessage());
                \Log::info(\request()->fullUrl());
        
            } catch (HttpException $e) {
                \Log::info($e->errorMessage());
                \Log::info(\request()->fullUrl());
            }

        return $next($request);
    }

}
