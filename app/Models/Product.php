<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table = 'products';
    use SoftDeletes;
    protected $fillable = [
        'title', 'description', 'status', 'keyword','description_seo',
        'url', 'title_seo', 'brand_id', 'lead','popular','old_link','title2',
        'sort','special','max','weight','sell','newest','available','timer','date',
        'hour','video_link','title_en','warning','old_id','count','shenase','category_name','brand_name','price','old_price','soon', 'stock'

    ];



    public function getPriceFirstAttribute(){
        $prices = Price::where('priceable_id',$this->attributes['id'])->orderBy('id','DESC')->where('priceable_type','App\Models\Product')->first();

        if($prices){
            return ['old'=> $prices->old_price ? number_format(intval($prices->old_price)) . ' تومان ' : 'ندارد','price'=> $prices->price ? number_format(intval($prices->price)) . ' تومان ': 'ندارد'];
        }else{
            return ['old'=>'','price'=>'ندارد'];
        }

    }
    public function getPriceSecondAttribute(){
        $prices = Price::where('priceable_id',$this->attributes['id'])->orderBy('id','DESC')->where('priceable_type','App\Models\Product')->first();
        if($prices){
            return ['old'=>(intval($prices->old_price)),'price'=>(intval($prices->price)) ];
        }else{
            return ['old'=>0,'price'=>0];
        }
    }



    public function getCalcuteAttribute(){

            $price = intval($this->attributes['price']);

            $old_price = intval($this->attributes['old_price']);

            if ($old_price == 0) {
                $off = 0;
            } else {
                $off = ($old_price - $price) * 100 / $old_price;
            }

            return round($off, 2);
        }




    public function getStockCountAttribute(){
        $stock_in = InventoryReceipt::where('product_id',$this->attributes['id'])->orderBy('id','DESC')->In()->sum('count');
        $stock_out = InventoryReceipt::where('product_id',$this->attributes['id'])->orderBy('id','DESC')->Out()->sum('count');
        $mines = number_format(intval($stock_in-$stock_out));
        return $mines;
    }


    public function getProImageAttribute(){
        $thumbnail = Image::where('product_id',$this->attributes['id'])->whereNotNull('file')->orderBy('thumbnail','DESC')->orderBy('id','ASC')->first();
        if($thumbnail){
            $path = 'assets/uploads/content/pro/big/'.@$thumbnail->file;
            return file_exists($path) ? asset($path) :asset('assets/site/images/notfound.png');
        }else{
            return asset('assets/site/images/notfound.png');
        }
    }

    public function scopeSpecial($query)
    {
        $records = $query->whereSpecial('1');
        return $records;
    }

    public function scopeActive($query)
    {
        $records = $query->whereStatus('1');
        return $records;
    }

     public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }


    public function brands()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }


    public function sp()
    {
        return $this->hasMany('App\Models\ProductSpecification', 'product_id')->with('prices');
    }
    public function pro_sp()
    {
        return $this->hasMany('App\Models\ProductSpecification', 'product_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category','product_category', 'product_id', 'category_id');
    }

    public function cats()
    {
        return $this->belongsToMany('App\Models\Category','product_category')->orderBy('id','desc');
    }
    public function category()
    {
        return $this->belongsToMany('App\Models\Category','product_category')->whereDoesntHave('childs')->orderBy('id','desc');
    }

    public function assignCategory($role)
    {
        return $this->categories()->attach($role);
    }

    public function deleteCategory($role)
    {
        return $this->categories()->detach($role);
    }


    public function specifications()
    {
        return $this->belongsToMany('App\Models\ProductSpecificationType',
            'product_specifications', 'product_id', 'product_specification_value_id')
            ->withPivot('product_specification_type_id', 'description', 'price', 'id')->whereNull('product_specifications.deleted_at')->withTimestamps();
    }


//    public function color()
//    {
//        return $this->belongsToMany('App\Models\ProductSpecificationType',
//            'product_specifications', 'product_id', 'product_specification_value_id')
//            ->withPivot('product_specification_type_id', 'description', 'price', 'id','color')->whereNull('product_specifications.deleted_at')->withTimestamps();
//    }


    public function colors()
    {
        return $this->hasMany('App\Models\ProductSpecification','product_id', 'id')->whereHas('productSpecificationType',function($q){
            $q->where('view',1);
        });
    }

    public function img()
    {
        return $this->belongsToMany('App\Models\ProductSpecificationType',
            'product_specifications', 'product_id', 'product_specification_value_id')
            ->withPivot('product_specification_type_id', 'description', 'price', 'id','color','image')->whereNull('product_specifications.deleted_at')->withTimestamps();
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'Commentable')->whereNull('parent_id');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }
    public function prices()
    {
        return $this->morphMany('App\Models\Price', 'priceable')->orderBy('id','DESC');
    }
    public function images()
    {
        return $this->hasMany('App\Models\Image', 'product_id')->whereNull('product_specification_id');
    }
    public function image()
    {
        return $this->hasMany('App\Models\Image', 'product_id')->Show()->take(1)->orderby('id','DESC');
    }
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'Likeable')->orderBy('id','DESC');
    }

    public function inventoryReceipts()
    {
        return $this->hasMany('App\Models\InventoryReceipt', 'product_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\OrderItem', 'product_id')->where('order_item_status_id',5);
    }

    public function variable()
    {
        return $this->hasMany('App\Models\ProductVariable', 'product_id');
    }
    public function variablePrice()
    {
        return $this->hasMany('App\Models\ProductVariable', 'product_id')->orderBy('price','ASC');
    }
    public function variavle_product()
    {
        return $this->hasOne('App\Models\ProductVariable', 'product_id');
    }
    public function variable_stock()
    {
        return $this->hasMany('App\Models\ProductVariable', 'product_id')->where('stock','<>',0);
    }
        public function getMediumImageAttribute(){
        $thumbnail = Image::where('product_id',$this->attributes['id'])->show()->whereNotNull('file')->first();
        $product_image = Image::where('product_id',$this->attributes['id'])->whereNotNull('file')->first();


        if($thumbnail){
            return file_exists('assets/uploads/content/pro/medium/'.@$thumbnail->file) ? asset('assets/uploads/content/pro/medium/'.@$thumbnail->file) :asset('assets/site/images/notfound.png');
        }elseif($product_image){
            return file_exists('assets/uploads/content/pro/medium/'.@$product_image->file) ? asset('assets/uploads/content/pro/medium/'.@$product_image->file) :asset('assets/site/images/notfound.png');
        }else{
            return asset('assets/site/images/notfound.png');
        }
    }


        public function getVariableImageAttribute(){
        $thumbnail = Image::where('product_id',$this->attributes['id'])->show()->whereNotNull('file')->first();
        $product_image = Image::where('product_id',$this->attributes['id'])->whereNotNull('file')->first();
        if($thumbnail){
            return file_exists('assets/uploads/content/pro/medium/'.@$thumbnail->file) ? asset('assets/uploads/content/pro/medium/'.@$thumbnail->file) :asset('assets/site/images/notfound.png');
        }elseif($product_image){
            return file_exists('assets/uploads/content/pro/medium/'.@$product_image->file) ? asset('assets/uploads/content/pro/medium/'.@$product_image->file) :asset('assets/site/images/notfound.png');
        }else{
            return asset('assets/site/images/notfound.png');
        }
    }
}
