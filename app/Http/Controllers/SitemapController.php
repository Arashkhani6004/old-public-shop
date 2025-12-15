<?php

namespace App\Http\Controllers;


use App\Models\Brand;
use App\Models\Category;
use App\Models\Content;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Ista;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function sitemap()
    {
        $host_name = request()->getHost();
        $type = explode('.', $host_name);
        if($type[0] == "www"){
            $host = $type[1].'.'.$type[2];
        }
        else{
            $host = $type[0].'.'.$type[1];
        }
        $setting = Setting::first();
        $category = Category::orderBy('id','DESC')->get();
        $products = Product::orderBy('id','DESC')->where('status','1')->get();
        $articles = Content::orderby('id', 'DESC')->Article()->get();
        $brands = Brand::orderby('id', 'DESC')->whereNotNull('url')->get();
        $tags = Tag::orderby('id', 'DESC')->get();
        $article_cat = Content::orderby('id', 'DESC')->ArticleCat()->get();
        $blogs = Ista::orderby('id', 'DESC')->withStatus(1)->get();
        return response()->view('sitemap', [

            'category'=> $category,
            'article_cat'=> $article_cat,
            'articles'=> $articles,
            'products'=> $products,
            'brands'=> $brands,
            'tags'=> $tags,
            'host'=> $host,
            'setting'=> $setting,
            'blogs'=> $blogs,
            
        ])->header('Content-Type','text/xml');    }
}
