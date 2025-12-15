<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Library\Helper;

class ShipMent extends Model
{
    use SoftDeletes;
    protected $table = 'shipments';
    protected $fillable = [
        'title',
        'price',
        'max_price',
        'pay_at_home',
        'sort',
        'description',
        'status',

    ];

    public function city()
    {
        return $this->belongsToMany('App\Models\City','shipment_city');
    }
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = intval(Helper::persian2LatinDigit($value));
    }
      public function setMaxPriceAttribute($value)
    {
        $this->attributes['max_price'] = intval(Helper::persian2LatinDigit($value));
    }
}
