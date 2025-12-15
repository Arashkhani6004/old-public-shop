<?php
use App\Models\Category;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Larabookir\Gateway\Gateway;




Route::namespace('Help')->group(function () {
    //First Pages
    Route::get('help', 'HomeController@getIndex')->name('site.help.home');
    //Product List
    Route::get('help/cat/det', 'HomeController@list')->name('site.help.product.list');
    Route::get('help/pro/det', 'HomeController@detail')->name('site.help.product.detail');



    //Brand
    Route::get('help/brand', 'HomeController@brandList')->name('site.help.brand.list');
    Route::get('help/brand/det', 'HomeController@brandDetail')->name('site.help.brand.detail');


    //Blog
    Route::get('help/blogs', 'HomeController@blogCat')->name('site.help.blog.cat');

    Route::get('help/blogs/det', 'HomeController@blogList')->name('site.help.blog.list');

    Route::get('help/blog-detail', 'HomeController@blogDetail')->name('site.help.blog.detail');


});
