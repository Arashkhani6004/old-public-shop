<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductSpecification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id', 'product_specification_type_id',
        'product_specification_value_id',
        'image', 'price', 'description','color',
        'barcode','max'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function productSpecificationType()
    {
        return $this->belongsTo('App\Models\ProductSpecificationType', 'product_specification_type_id');
    }

    public function productSpecificationValue()
    {
        return $this->belongsTo('App\Models\ProductSpecificationType', 'product_specification_value_id');
    }
    public function prices()
    {
        return $this->morphMany('App\Models\Price', 'Priceable')->orderBy('id','DESC');
    }
    public function sp_images()
    {
        return $this->hasMany('App\Models\Image', 'product_specification_id')->orderby('id','DESC');
    }
    public function sp_image()
    {
        return $this->hasMany('App\Models\Image', 'product_specification_id')->Show()->take(1)->orderby('id','ASC');
    }
    public function getProImageAttribute(){
        $thumbnail = Image::where('product_specification_id',$this->attributes['id'])->show()->first();
        $product_image = Image::where('product_specification_id',$this->attributes['id'])->first();

        if($thumbnail){
            return file_exists('assets/uploads/content/sp/big/'.@$thumbnail->file) ? asset('assets/uploads/content/sp/big/'.@$thumbnail->file) :asset('assets/site/images/notfound.png');
        }elseif($product_image){
            return file_exists('assets/uploads/content/sp/big/'.@$product_image->file) ? asset('assets/uploads/content/sp/big/'.@$product_image->file) :asset('assets/site/images/notfound.png');
        }else{
            return asset('assets/site/images/notfound.png');
        }
    }


}
