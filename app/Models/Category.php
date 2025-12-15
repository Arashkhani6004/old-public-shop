<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = 'categories';
    use SoftDeletes;
    protected $fillable = [
        'title', 'description', 'description_seo','cover','title2','mega', 'mega_url','sort','show_menu', 'show_footer',
        'url', 'title_seo', 'keyword' ,'parent_id','status','old_id','old_link','old_image','parent_title',

    ];

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Category::class, 'parent_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany('App\Models\Category','parent_id')->with('childs')->orderby('sort','ASC')->where('show_menu', 1);
    }

    public function childCat()
    {
        return $this->hasMany('App\Models\Category','parent_id')->with('childs')->orderby('sort','ASC');
    }
    public function products()
    {
        return $this->belongsToMany('App\Models\Product','product_category','category_id');
    }
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'parent_id', 'id');
    }
    public function getCatImageAttribute(){

        $cat_cover = Category::find($this->attributes['id']);

        return file_exists('assets/uploads/content/cat/'.$cat_cover->cover) ? asset('assets/uploads/content/cat/'.$cat_cover->cover) :asset('assets/site/images/notfound.png');

    }
    public function getCatMegaAttribute(){

        $cat_cover = Category::find($this->attributes['id']);

        return file_exists('assets/uploads/content/cat/'.$cat_cover->mega) ? asset('assets/uploads/content/cat/'.$cat_cover->mega) :asset('assets/site/images/notfound.png');

    }


}
