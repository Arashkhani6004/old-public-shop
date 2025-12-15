<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderHistory extends Model
{

    use SoftDeletes;
    protected $table = 'order_history';
    protected $fillable = ['order_id', 'order_status_id', 'description'];
}
