<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Basket extends Model
{

    use SoftDeletes;

    protected $table = 'baskets';
    protected $fillable = [
        'user_id', 'total_prices', 'total_calculated', 'payment', 'discount', 'tax1', 'tax2', 'fee',
        'quantity', 'storage_id', 'basket_status_id', 'bank_id', 'transaction_id', 'ref_id', 'cookie_id', 'city_id', 'state_id',
        'tracking_code', 'delivery_time', 'delivery_type_id', 'address_id', 'paid_date', 'delivery_date', 'send_date', 'post_price',
        'post_type', 'discount_id', 'pay_type', 'deleted_at', 'shipment_id',
    ];

    public function scopeCookieUser($query)
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
        return $query->whereNotNull('cookie_id')->where('cookie_id', session()->get('custom_data'));
    }

    public function scopeAuthUser($query)
    {
        if (Auth::check()) {
            return $query->where('user_id', Auth::id());
        } else {
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
            return $query->whereNotNull('cookie_id')->where('cookie_id', session()->get('custom_data'));
        }
    }

    public function scopeCookieUser2($query)
    {
        return $query->where('cookie_id', @$_COOKIE['cookie_id']);

    }

    public function scopeAuthUser2($query)
    {
        if (Auth::check()) {
            return $query->where('user_id', Auth::id());
        } else {
            return $query->where('cookie_id', @$_COOKIE['cookie_id']);
        }
    }

    public function scopeCurrentBasket($query)
    {
        return $query->where('basket_status_id', 1);
    }

    public function basketItems()
    {
        return $this->hasMany('App\Models\BasketItem')->with('product');
    }
}
