<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemBasket extends Model
{

    use SoftDeletes;

    protected $table = 'basket_items';
    protected $fillable = [
        'basket_id', 'product_variable_id', 'product_id', 'quantity',
    ];
}
