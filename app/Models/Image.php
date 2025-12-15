<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
   protected $fillable = [
     'file' , 'product_id','thumbnail','product_variable_id','old_id','convert'
   ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public function specification()
    {
        return $this->belongsTo('App\Models\ProductSpecification','product_specification_id');
    }
    public function scopeShow($query)
    {
        $records = $query->whereThumbnail('1');
        return $records;
    }

}
