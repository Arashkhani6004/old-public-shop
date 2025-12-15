<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariable extends Model
{

    use SoftDeletes;
    protected $table = 'product_variables';
    protected $fillable = ['title', 'product_id', 'price', 'discounted_price', 'stock', 'image'];

    public function images()
    {
        return $this->hasMany('App\Models\Image', 'product_variable_id')->orderby('id', 'DESC');
    }
    
    public function getBigImageAttribute(){
        $thumbnail = $this->images()->whereNotNull('file')->first();
        $product_image = $this->images()->whereNotNull('file')->first();

        if ($thumbnail) {
            return file_exists('assets/uploads/content/pro/big/' . $thumbnail->file) ?
                asset('assets/uploads/content/pro/big/' . $thumbnail->file) :
                asset('assets/site/images/notfound.png');
        } elseif ($product_image) {
            return file_exists('assets/uploads/content/pro/big/' . $product_image->file) ?
                asset('assets/uploads/content/pro/big/' . $product_image->file) :
                asset('assets/site/images/notfound.png');
        } else {
            return asset('assets/site/images/notfound.png');
        }
    }
        public function getMediumImageAttribute(){
        $thumbnail = $this->images()->whereNotNull('file')->first();
        $product_image = $this->images()->whereNotNull('file')->first();

        if ($thumbnail) {
            return file_exists('assets/uploads/content/pro/medium/' . $thumbnail->file) ?
                asset('assets/uploads/content/pro/medium/' . $thumbnail->file) :
                asset('assets/site/images/notfound.png');
        } elseif ($product_image) {
            return file_exists('assets/uploads/content/pro/medium/' . $product_image->file) ?
                asset('assets/uploads/content/pro/medium/' . $product_image->file) :
                asset('assets/site/images/notfound.png');
        } else {
            return asset('assets/site/images/notfound.png');
        }
    }
}
