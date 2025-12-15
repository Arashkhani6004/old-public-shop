<?php

use App\Models\Category;
use Illuminate\Support\Facades\Artisan;
// use Illuminate\Support\Facades\Route;
use Larabookir\Gateway\Gateway;


// Route::get('/test-bank', function () {


//     try {
//         $gateway = Gateway::pasargad();
//         $gateway->setCallback(action('Site\HomeController@getIndex'));
//         $gateway->price('10000')->ready(234544, 4345535);
//         $refId = $gateway->refId();
//         $transID = $gateway->transactionId();


//         return $gateway->redirect();
//     } catch (Exception $e) {
//         dd($e);
//     }
// });

Route::namespace('Site')->middleware('main')->group(function () {
    //First Pages
    
    Route::get('/', 'HomeController@getIndex')->name('site.home');
    Route::get('/convertPrice', 'HomeController@convertPrice');

    Route::get('/captcha', 'HomeController@getCaptcha')->name('captcha');
    Route::post('/check-captcha', 'HomeController@checkCaptcha')->name('checkCaptcha');
    Route::get('robots.txt', 'HomeController@showRobots');

    Route::get('/cccc', 'HomeController@convert');
    Route::get('/api/products', 'HomeController@get');

    Route::post('/post-number', 'HomeController@postNumber')->name('site.number');

    //Static
    
    Route::get('/about-us', 'HomeController@getAbout')->name('site.about');
    
    Route::get('/privacy-policy', 'HomeController@getRules')->name('site.rules');
    Route::get('/rules-and-order', 'HomeController@getOrderRules')->name('site.orderrules');
    Route::get('/pay', 'HomeController@getPay')->name('site.pay');
    Route::get('/faq', 'HomeController@getFaq')->name('site.faq');
    Route::get('/contact-us', 'HomeController@getContact')->name('site.contact');
    Route::post('/post-contact', 'HomeController@postContact')->name('site.contact-post');
       Route::get('/bestselling', 'HomeController@getMost')->name('site.most');
       Route::get('/categories', 'HomeController@getCategory')->name('site.categories');
       Route::get('/discounts', 'HomeController@getDiscounts')->name('site.discounts');
       Route::get('/popular-products', 'HomeController@getPopular')->name('site.popular');
       Route::get('/new-products', 'HomeController@getNew')->name('site.newest');
    Route::get('/incredible-offers', 'HomeController@getTimer')->name('site.timer');

    //Product List
    Route::post('/vue/product-list', 'VueController@productList')->name('vue.product-list');
    Route::post('/vue/filter-product', 'VueController@filterProduct')->name('vue.filter-product');
    Route::post('/vue/setbrands', 'VueController@Brands')->name('site.getbrands');
    Route::get('/cat/{id}', 'HomeController@list')->name('site.product.list');
    Route::get('/pro/{id}', 'HomeController@detail')->name('site.product.detail');
    Route::get('/all-products', 'HomeController@all')->name('site.product.all');

    Route::get('/banner/{id}', 'HomeController@banner')->name('site.banner.detail');
    Route::get('/search', 'HomeController@getSearch')->name('site.search');
    Route::get('/tag/{tag}', 'HomeController@contentListByTag')->name('site.tag');

    //Brand
    Route::post('/vue/brand-list', 'VueController@brandList')->name('vue.brand-list');
    Route::post('/vue/filter-brand', 'VueController@filterBrand')->name('vue.filter-brand');
    Route::post('/vue/setcats', 'VueController@Cats')->name('site.getcats');
    Route::get('/brands', 'HomeController@brandList')->name('site.brand.list');
    Route::get('/brand/{id}', 'HomeController@brandDetail')->name('site.brand.detail');


    Route::post('/vue/setall', 'VueController@All')->name('site.getall');
    Route::post('/vue/all-list', 'VueController@allList')->name('vue.all-list');
    Route::post('/vue/filter-all', 'VueController@filterAll')->name('vue.filter-all');

    //Comments
    Route::post('comment', 'HomeController@postComment');
    Route::post('reply', 'HomeController@postReply');
    Route::post('faq', 'HomeController@postFaq');

    //Blog
    Route::get('/blogs', 'HomeController@blogCat')->name('site.blog.cat');

    Route::get('/blogs/{id}', 'HomeController@blogList')->name('site.blog.list');

    Route::get('/blog-detail/{id}', 'HomeController@blogDetail')->name('site.blog.detail');

    //page


    Route::get('/page-detail/{id}', 'HomeController@pageDetail')->name('site.page.detail');
    Route::post('/product/variable', 'HomeController@FindVariable')->name('product.variable');

    //==Track==
    Route::get('/tracking', 'HomeController@tracking')->name('site.tracking');
    Route::get('/post-track', 'HomeController@track')->name('site.track');

    //Shop Cart & Bank

    Route::get('/post-checkout', 'ShopController@postCheckout')->name('site.cart.post-checkout');
    Route::post('/cart/content', 'ShopController@cartContent')->name('site.cart.content');
    Route::post('/post-address', 'ShopController@postAddAddress')->name('site.cart.address');
    Route::get('/default-address/{id?}', 'ShopController@defaultAddress')->name('site.cart.default');
    Route::post('/cart/add', 'ShopController@addToCart')->name('site.cart.add');
    Route::post('/discount/add', 'ShopController@addDiscount')->name('site.discount.add');
    Route::post('/cart/remove', 'ShopController@removeFromCart')->name('site.cart.remove');
    Route::get('/checkout', 'ShopController@checkout')->name('site.cart.checkout');
    Route::any('/finish', 'ShopController@finish')->name('site.cart.finish3');
    Route::get('/finish-zarin', 'ShopController@finishZarin')->name('site.cart.finish4');
    Route::post('/cart/add2', 'ShopController@addToCart2')->name('site.cart.add2');
    Route::get('convert-shipment', 'ConverShipmentController@convert');

 //    Route::get('/get-token', 'ShopController@getTokenSadad');
    Route::any('/callback-sedad', 'ShopController@finishSedad');

});