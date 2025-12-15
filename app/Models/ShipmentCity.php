<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ShipmentCity extends Model
{
    public $timestamps = false;
    protected $table = 'shipment_city';
    protected $fillable = [
        'ship_ment_id',
        'city_id',
    ];
}
