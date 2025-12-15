<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasketItem extends Model
{
    use SoftDeletes;
    protected $table = 'basket_items';
    protected $fillable = [
        'basket_id', 'basket_item_status_id', 'product_id',
        'price', 'discount', 'quantity', 'tax1', 'tax2', 'product_variable_id',
    ];

    public function basketStatus()
    {
        return $this->belongsTo('App\Models\OrderStatus', 'basket_item_status_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    public function productVariable()
    {
        return $this->belongsTo('App\Models\ProductVariable', 'product_id')->withTrashed();
    }
    public function variable()
    {
        return $this->hasOne('App\Models\ProductVariable', 'id', 'product_variable_id');
    }
}
