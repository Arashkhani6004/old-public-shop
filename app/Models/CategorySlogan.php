<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class CategorySlogan extends Model
{
    protected $table='category_sloagen';
    public $timestamps = false;
    protected $fillable = [
        'category_id',
        'sloagen_id',
    ];
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id','id');
    }
    public function slogan()
    {
        return $this->belongsTo('App\Models\Slogan', 'slogan_id');
    }


}
