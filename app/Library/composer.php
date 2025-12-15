<?php


use App\Models\Brand;
use App\Models\Category;
use App\Models\Content;
use App\Models\Ista;
use App\Models\Like;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Sloagen;
use App\Models\Social;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

$category_footer=[];
$brands_footer=[];
$pages_footer=[];
$setting_header=[];
$social_header=[];

$head_sli=[];
$seg=[];
$seg = \request()->segments();
$check = Auth::check();
$user_id = Auth::id();
$likes_panel = like::orderby('id','DESC')->where('user_id',$user_id)->where('likeable_type','App\Models\Product')->get();
$setting_header = Setting::first();
$brandsCount = Brand::orderby('id','DESC')->count();
$blogCount = Content::orderby('id','DESC')->Article()->count();
$brands_footer = Brand::orderby('id', 'DESC')->whereFooter('1')->take(5)->whereNotNull('url')->get();
$head_sli = Content::Slider()->where('status','1')->first();
$category_footer = Category::orderBy('sort','ASC')->wherenull('parent_id')->where('show_menu', 1)->whereNotNull('url')->get();
$category_footers = Category::orderBy('sort','ASC')->where('show_footer', 1)->take(6)->whereNotNull('url')->get();
//$category_footer = Category::orderBy('sort','ASC')->whereNull('parent_id')->get();
$social_header = Social::orderBy('id', 'DESC')->get();
$pages_footer = Ista::orderBy('sort','ASC')->where('status','1')->where('footer','1')->whereNotNull('url')->get();
$pages_menu = Ista::orderBy('sort','ASC')->where('status','1')->where('menu','1')->whereNotNull('url')->take(4)->get();





View::share([

    'category_footer' => $category_footer,
    'category_footers' => $category_footers,
    'brands_footer' => $brands_footer,
    'likes_panel' => $likes_panel,
    'setting_header' => $setting_header,
    'social_header' => $social_header,
    'head_sli' => $head_sli,
    'pages_footer' => $pages_footer,
    'pages_menu' => $pages_menu,
    'brandsCount' => $brandsCount,
    'blogCount' => $blogCount,
    'seg' => $seg,


]);

