<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Basket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CookieConvertController extends Controller
{
    public function convertBaskets()
    {
        $baskets = Basket::whereNotNull('cookie_id')->get();
        foreach ($baskets as $basket) {
            $nirone = 'nirone';
            $cookie_id_without_prefix = substr($basket->cookie_id , strlen($nirone)); 
            $host_name = request()->getHost();
            $type = explode('.', $host_name);
            if ($type[0] == "www") {
                $host = $type[1] . '.' . $type[2];
            } else {
                $host = $type[0] . '.' . $type[1];
            }
            $type = explode('.', $host_name);
            $domain = array_pop($type); 
            // dd($host_name, $type[0]);


            session()->put('custom_data', $type[0] . $cookie_id_without_prefix );
            session()->save();
            $session_data = session()->get('custom_data');
            // dd($basket->cookie_id, $host_name, $cookie_id_without_prefix, $session_data);
            $basket->update(['cookie_id' => $session_data]);
        }
        return response()->json(['message' => 'done.'], 200);
    }

}
