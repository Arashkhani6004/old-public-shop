<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    protected $table = 'brands';
    use SoftDeletes;
    protected $fillable = [
        'title', 'description', 'image',
         'description_seo','footer','title2',
        'url', 'title_seo', 'keyword','status','old_link','old_image'
    ];
    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }
    public function getBrandImageAttribute(){

        $brand_image = Brand::find($this->attributes['id']);

        return file_exists('assets/uploads/content/brand/big/'.$brand_image->image) ? asset('assets/uploads/content/brand/big/'.@$brand_image->image) :asset('assets/site/images/notfound.png');

    }
     public function getSmallImageAttribute(){

        $brand_image = Brand::find($this->attributes['id']);

        return file_exists('assets/uploads/content/brand/small/'.$brand_image->image) ? asset('assets/uploads/content/brand/small/'.@$brand_image->image) :asset('assets/site/images/notfound.png');

    }
}
