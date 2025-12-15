<?php

namespace App\Http\Middleware;

use Carbon\Carbon;

use App\Models\Cookie;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class MainMiddleware
{

    public function handle($request, Closure $next)
    {
        if(env('APP_ENV') === "production"){
            if (session()->get('custom_data') == null) {
                $host_name = request()->getHost();
                $type = explode('.', $host_name);
                if ($type[0] == "www") {
                    $host = $type[1] . '.' . $type[2];
                } else {
                    $host = $type[0] . '.' . $type[1];
                }
                $type2 = explode('.', $host);
                session()->put('custom_data', $type2[0] . strtotime(Carbon::now()));
                session()->save();
            }
        }else{
            if (session()->get('custom_data') == null) {
                session()->put('custom_data', "localhost" . strtotime(Carbon::now()));
                session()->save();
            }
        }
        return $next($request);
    }
}
