<?php
// helloo

Route::get('import', 'Admin\ExcelController@getImport');
Route::get('convert', 'Admin\ExcelController@getExcel');
Route::post('import-post', 'Admin\ExcelController@postExcel');
Route::get('var/export', 'Admin\VariableController@getExportVar');
Route::get('var/import', 'Admin\VariableController@getImportVar');
Route::post('var/convert', 'Admin\VariableController@postExcel');
Route::get('/adminstratorlogin', 'Admin\LoginController@getLogin');
Route::post('/adminstratorlogin', 'Admin\LoginController@postLogin');
Route::get('/emailrepassword', function(){
    dd('salam');
    Mail::raw('From:send', function($message){
    $message->from('resetpassword@atroff.com', 'ریسپت پسورد ادمین');
    $message->to('dynamiteofhope@gmail.com')->subject('salaaam');
    });
});

//ckeditor
Route::post('adminstratorlogin/repassword', 'Admin\LoginController@postResetPassword')->name('admin.postResetPassword');
Route::get('admin/ckeditor', 'Admin\CkeditorController@index');
Route::post('admin/ckeditor/upload', 'Admin\CkeditorController@upload')->name('ckeditor.upload');

Route::get('/admin', function () {
    return redirect('/adminstrator');
});
Route::namespace('Admin')->prefix('adminstrator')->group(function () {
    //Auth
    Route::get('/adminstratorlogin', 'Admin\LoginController@getLogin');
    Route::post('/adminstratorlogin', 'Admin\LoginController@postLogin');
    Route::get('/logout',  function () {
        \Illuminate\Support\Facades\Auth::logout();
        return redirect()->to('/adminstratorlogin');
    });
    //user addresses
    Route::get('user/address/{id}', 'UserController@getAddress');
    Route::get('user/edit-address/{id}', 'UserController@getEditAddress');
    Route::post('user/edit-address/{id}', 'UserController@postEditAddress');
    //Questions
    Route::get('question/{id?}', 'QuestionController@get');
    Route::get('questions', 'QuestionController@getFaq');
    Route::get('questions/add/', 'QuestionController@getAddFaq');
    Route::get('question/add/{id?}', 'QuestionController@getAdd');
    Route::post('question/add', 'QuestionController@postAdd');
    Route::get('question/delete/{id}', 'QuestionController@getDelete');
    Route::post('question/delete', 'QuestionController@postDelete');
    Route::get('question/edit/{id}', 'QuestionController@getEdit');
    Route::post('question/edit/{id}', 'QuestionController@postEdit');
    Route::get('/order/factor/{id}', 'OrderController@getfactor');
    Route::get('/products/thumbnail/edit/{id?}', 'ProductController@editThumbnail');
    //Users Questions
    Route::get('/users-questions', 'UsersQuestionController@getList');
    Route::get('/users-questions/add-answer/{id}', 'UsersQuestionController@getAdd');
    Route::post('/users-questions/add-answer/{id}', 'UsersQuestionController@postAdd');
    //Sloagens
    Route::get('sloagen/', 'SloagenController@get');
    Route::get('sloagen/add/', 'SloagenController@getAdd');
    Route::post('sloagen/add', 'SloagenController@postAdd');
    Route::get('sloagen/delete/{id}', 'SloagenController@getDelete');
    Route::post('sloagen/delete', 'SloagenController@postDelete');
    Route::get('sloagen/edit/{id}', 'SloagenController@getEdit');
    Route::post('sloagen/edit/{id}', 'SloagenController@postEdit');
    //Properties
    Route::get('properties/{id?}', 'PropertiesController@get');
    Route::get('properties/add/{id?}', 'PropertiesController@getAdd');
    Route::post('properties/add', 'PropertiesController@postAdd');
    Route::get('properties/delete/{id}', 'PropertiesController@getDelete');
    Route::post('properties/delete', 'PropertiesController@postDelete');
    Route::get('properties/edit/{id}', 'PropertiesController@getEdit');
    Route::post('properties/edit/{id}', 'PropertiesController@postEdit');
    //Timers
    Route::get('/products/timer/{id}', 'ProductController@getTimer');
    Route::post('/products/timer', 'ProductController@postTimer');
    Route::post('/products/timer/edit/{id}', 'ProductController@postEditTimer');
    // ProductVariable
    Route::get('/products/variables/{id}', 'VariableController@getAddVariable');
    Route::post('/products/variables/add-variable', 'VariableController@postAddVariable');
    Route::post('/products/variables/edit-variable/{id}', 'VariableController@postEditVariable');
    Route::get('/products/variables/delete-variable/{id}', 'VariableController@getDeleteVariable');
    Route::get('/product/variables/delete-image/{id}', 'VariableController@getDeleteImageVar')->name('admin.variable.deleteiamge');
    Route::post('/products/cheng-price', 'ProductController@changePrice');
    Route::post('/products/cheng-stock', 'ProductController@changeStock');
    //ticketaye biroone permission
    Route::get('/ticket-status/{id}', 'TicketController@ticketStatus');
    Route::get('/ticket-return/{id}', 'TicketController@ticketReturn');
    Route::middleware('AdminPermission')->group(function () {
        Route::get('/', 'ContentController@getAdmin');
        //Users
        Route::get('user', 'UserController@getIndex');
        Route::get('users', 'UserController@getIndex2');
        Route::get('user/add', 'UserController@getAdd');
        Route::post('user/add', 'UserController@postAdd');
        Route::get('user/edit/{id}', 'UserController@getEdit');
        Route::post('user/edit/{id}', 'UserController@postEdit');
        Route::post('user/pass-edit/{id}', 'UserController@postPassEdit');
        Route::post('user/delete', 'UserController@postDelete');
        Route::get('/users/export', 'UserController@export');
        Route::get('user/status/{id?}', 'UserController@Status')->name('admin.user.status');
        Route::get('user/special/{id?}', 'UserController@Special')->name('admin.user.special');
        //UserGroups
        Route::get('user/group', 'UserController@getGroup');
        Route::get('user/group-add', 'UserController@getGroupAdd');
        Route::post('user/group-add', 'UserController@postGroupAdd');
        Route::get('user/group-edit/{id}', 'UserController@getGroupEdit');
        Route::post('user/group-edit/{id}', 'UserController@postGroupEdit');
        Route::post('user/group-delete', 'UserController@postGroupDelete');
        Route::get('user/delete/{id}', 'UserController@getGroupDelete');
        //Tickets
        Route::get('/tickets', 'TicketController@ticketsList');
        Route::get('/tickets/detail/{id}', 'TicketController@ticketDetail');
        //ina alan biroone permission hastan
        //Route::get('/ticket-status/{id}' , 'TicketController@ticketStatus');
        //Route::get('/ticket-return/{id}' , 'TicketController@ticketReturn');
        Route::post('/tickets/reply', 'TicketController@addReply')->name('admin.ticket.reply');
        //Cropper
        Route::get('/cropper', 'ContentController@getCropper');
        Route::get('/cropper', 'ContentController@getCropper');
        //Products
        Route::get('products', 'ProductController@getProduct');
        Route::get('products/add', 'ProductController@getAddProduct');
        Route::post('products/add', 'ProductController@postAddProduct');
        Route::get('products/delete/{id}', 'ProductController@getDeleteProduct');
        Route::post('products/delete', 'ProductController@postDeleteProduct');
        Route::get('products/edit/{id}', 'ProductController@getEditProduct');
        Route::post('products/edit/{id}', 'ProductController@postEditProduct');
        Route::post('products/sort', 'ProductController@postSort');
        Route::get('/products/export', 'ProductController@export');
        //Questions
        //Route::get('question/{id?}', 'QuestionController@get');
        //Route::get('questions', 'QuestionController@getFaq');
        //Route::get('questions/add/', 'QuestionController@getAddFaq');
        //Route::get('question/add/{id?}', 'QuestionController@getAdd');
        //Route::post('question/add', 'QuestionController@postAdd');
        //Route::get('question/delete/{id}', 'QuestionController@getDelete');
        //Route::post('question/delete', 'QuestionController@postDelete');
        //Route::get('question/edit/{id}', 'QuestionController@getEdit');
        //Route::post('question/edit/{id}', 'QuestionController@postEdit');
        //Sloagens
        //Route::get('sloagen/{id?}', 'SloagenController@get');
        //Route::get('sloagen/add/{id?}', 'SloagenController@getAdd');
        //Route::post('sloagen/add', 'SloagenController@postAdd');
        //Route::get('sloagen/delete/{id}', 'SloagenController@getDelete');
        //Route::post('sloagen/delete', 'SloagenController@postDelete');
        //Route::get('sloagen/edit/{id}', 'SloagenController@getEdit');
        //Route::post('sloagen/edit/{id}', 'SloagenController@postEdit');
        //Properties
        //Route::get('properties/{id?}', 'PropertiesController@get');
        //Route::get('properties/add/{id?}', 'PropertiesController@getAdd');
        //Route::post('properties/add', 'PropertiesController@postAdd');
        //Route::get('properties/delete/{id}', 'PropertiesController@getDelete');
        //Route::post('properties/delete', 'PropertiesController@postDelete');
        //Route::get('properties/edit/{id}', 'PropertiesController@getEdit');
        //Route::post('properties/edit/{id}', 'PropertiesController@postEdit');
        //Specifications
        Route::get('/specification-type', 'SpecificationTypeController@getIndex')->name('admin.specification-type.list');
        Route::get('/specification-type/add', 'SpecificationTypeController@getAdd')->name('admin.specification-type.add');
        Route::post('/specification-type/add', 'SpecificationTypeController@postAdd')->name('admin.specification-type.post-add');
        Route::get('/specification-type/edit/{id}', 'SpecificationTypeController@getEdit')->name('admin.specification-type.edit');
        Route::post('/specification-type/edit', 'SpecificationTypeController@postEdit')->name('admin.specification-type.post-edit');
        Route::get('/specification-type/delete/{id}', 'SpecificationTypeController@postDelete')->name('admin.specification-type.delete');
        Route::get('/specification-type/category-add', 'SpecificationTypeController@getAddCategory')->name('admin.specification-type.add-category');
        Route::post('/specification-type/category-add', 'SpecificationTypeController@postAddCategory')->name('admin.specification-type.post-add-category');
        Route::get('/specification-type/category/{id}', 'SpecificationTypeController@getListCategory')->name('admin.specification-type.post-add-category');
        //ProductSpecifications
        Route::get('product-specification/list/{product_id}', 'ProductSpecificationController@getIndex');
        Route::get('product-specification/order/{product_id}', 'ProductSpecificationController@getOrder');
        Route::get('product-specification/add/{product_id}', 'ProductSpecificationController@getAdd');
        Route::post('product-specification/add/{product_id}', 'ProductSpecificationController@postAdd');
        Route::get('product-specification/add-order/{product_id}', 'ProductSpecificationController@getAddOrder');
        Route::post('product-specification/add-order/{product_id}', 'ProductSpecificationController@postAddOrder');
        Route::post('product-specification/delete', 'ProductSpecificationController@postDelete');
        Route::post('product-specification/edit-price/{id}', 'ProductSpecificationController@postEditPrice');
        //ProductSpecificationImages
        Route::get('/sp/image/{id}', 'ProductSpecificationController@getImage');
        Route::get('/sp/image/add/{id}', 'ProductSpecificationController@getAddImage');
        Route::post('/sp/image/add', 'ProductSpecificationController@postAddImage');
        Route::get('/sp/image/edit/{id}', 'ProductSpecificationController@getEditImage');
        Route::post('/sp/image/edit/{id}', 'ProductSpecificationController@postEditImage');
        Route::post('/sp/image/delete', 'ProductSpecificationController@postDeleteImage');
        //ProductSpecificationTypes
        Route::get('product-specification-type/list/{id?}', 'ProductSpecificationTypeController@getList');
        Route::get('product-specification-type/add/{id?}', 'ProductSpecificationTypeController@getAdd');
        Route::post('product-specification-type/add/{id?}', 'ProductSpecificationTypeController@postAdd');
        Route::post('product-specification-type/add-main/{id?}', 'ProductSpecificationTypeController@postAddMain');
        Route::get('product-specification-type/edit/{id}', 'ProductSpecificationTypeController@getEdit');
        Route::post('product-specification-type/edit/{id}', 'ProductSpecificationTypeController@postEdit');
        Route::post('product-specification-type/delete', 'ProductSpecificationTypeController@postDelete');
        Route::post('product-specification-type/cat-add', 'ProductSpecificationTypeController@postCatAdd');
        Route::get('product-specification-type/cat-delete/{id}/{c_id}', 'ProductSpecificationTypeController@getCatDelete');
        Route::get('product-specification-type/delete/{id}/', 'ProductSpecificationTypeController@getDelete');
        Route::get('product-specification-type/view/{id?}', 'ProductSpecificationTypeController@View')->name('admin.pst.view');
        Route::get('product-specification-type/status/{id?}', 'ProductSpecificationTypeController@Status')->name('admin.pst.status');
        Route::get('product-specification-type/update-view', 'ProductSpecificationTypeController@updateview')->withoutMiddleware('AdminPermission');
        //VueAIP
        Route::post('/view', 'Site\HomeController@view')->name('site.api.view');
        Route::post('/getCats', 'Site\HomeController@getCats')->name('site.api.getCats');
        Route::post('/getfields', 'Site\HomeController@getFields')->name('site.api.getFields');
        Route::post('/getfieldspack', 'Site\HomeController@getFieldsPack')->name('site.api.getFieldsPack');
        Route::post('/getfieldsorder', 'Site\HomeController@getFieldsOrder')->name('site.api.getFieldsOrder');
        //VuejsRoutesActions :
        Route::post('/list-shops-api', 'Site\SiteController@shopListApi')->name('api.list-shops-api');
        Route::post('/list-products-api', 'Site\SiteController@productListApi')->name('api.list-products-api');
        Route::post('/filter-products-api', 'Site\SiteController@filterProductsApi')->name('api.filter-products');
        //Shopping :
        Route::post('/shopping-list-shops-api', 'Site\SiteController@shoppingShopListApi')->name('api.shopping.list-shops-api');
        Route::post('/shopping-list-products-api', 'Site\SiteController@shoppingProductsApi')->name('api.shopping.list-products-api');
        Route::post('/shopping-filter-products-api', 'Site\SiteController@shoppingProductFilterApi')->name('api.shopping.filter-products');
        //Brands
        Route::get('brands', 'BrandController@getBrand');
        Route::get('brands/add', 'BrandController@getAddBrand');
        Route::post('brands/add', 'BrandController@postAddBrand');
        Route::get('brands/delete/{id}', 'BrandController@getDeleteBrand');
        Route::post('brands/delete', 'BrandController@postDeleteBrand');
        Route::get('brands/edit/{id}', 'BrandController@getEditBrand');
        Route::post('brands/edit/{id}', 'BrandController@postEditBrand');
        //ProductImages
        Route::get('/products/image/{id}', 'ProductController@getImage');
        Route::get('/products/image/add/{id}', 'ProductController@getAddImage');
        Route::post('/products/image/add', 'ProductController@postAddImage');
        Route::get('/products/image/edit/{id}', 'ProductController@getEditImage');
        Route::post('/products/image/edit/{id}', 'ProductController@postEditImage');
        Route::post('/products/image/delete', 'ProductController@postDeleteImage');
        //Timers
        //Route::get('/products/timer/{id}' , 'ProductController@getTimer');
        //Route::post('/products/timer' , 'ProductController@postTimer');
        //Route::post('/products/timer/edit/{id}' , 'ProductController@postEditTimer');
        //Categories
        Route::get('category', 'CategoryController@getCategory');
        Route::get('category/add', 'CategoryController@getAddCategory');
        Route::post('category/add', 'CategoryController@postAddCategory');
        Route::get('category/delete/{id}', 'CategoryController@getDeleteCategory');
        Route::post('category/delete', 'CategoryController@postDeleteCategory');
        Route::get('category/edit/{id}', 'CategoryController@getEditCategory');
        Route::post('category/edit/{id}', 'CategoryController@postEditCategory');
        Route::post('category/sort', 'CategoryController@postSort');
        Route::get('/category/search', 'CategoryController@getSearch');
        //Sliders
        Route::get('slider', 'SliderController@getSlider');
        Route::get('slider/add', 'SliderController@getAddSlider');
        Route::post('slider/add', 'SliderController@postAddSlider');
        Route::get('slider/delete/{id}', 'SliderController@getDeleteSlider');
        Route::post('slider/delete', 'SliderController@postDeleteSlider');
        Route::get('slider/edit/{id}', 'SliderController@getEditSlider');
        Route::post('slider/edit/{id}', 'SliderController@postEditSlider');
        Route::post('slider/sort', 'SliderController@postSort');
        //MobileSliders
        Route::get('mobile-slider', 'SliderController@getMobile');
        Route::get('mobile-slider/add', 'SliderController@getAddMobile');
        Route::post('mobile-slider/add', 'SliderController@postAddMobile');
        Route::get('mobile-slider/delete/{id}', 'SliderController@getDeleteMobile');
        Route::post('mobile-slider/delete', 'SliderController@postDeleteMobile');
        Route::get('mobile-slider/edit/{id}', 'SliderController@getEditMobile');
        Route::post('mobile-slider/edit/{id}', 'SliderController@postEditMobile');
        //Tags
        Route::get('tags', 'TagController@get');
        Route::get('tags/add', 'TagController@getCrate');
        Route::post('tags/add/tag', 'TagController@postCreate');
        Route::get('tags/edit/{id}', 'TagController@getEdit');
        Route::post('tags/edit/{id}', 'TagController@postEdit');
        Route::get('tags/delete/{id}', 'TagController@delete');
        //Setting
             Route::get('setting/', 'SettingController@getEditSetting');
        Route::get('setting/delete-modal-img', 'SettingController@deleteModal');
        Route::get('setting/delete-modal-mobile-img', 'SettingController@deleteModalMobile');
        Route::post('setting/edit/{id}', 'SettingController@postEditSetting');
        //Articles
        Route::get('articles', 'ArticleController@getArticle');
        Route::get('articles/add', 'ArticleController@getAddArticle');
        Route::post('articles/add', 'ArticleController@postAddArticle');
        Route::get('articles/delete/{id}', 'ArticleController@getDeleteArticle');
        Route::post('articles/delete', 'ArticleController@postDeleteArticle');
        Route::get('articles/edit/{id}', 'ArticleController@getEditArticle');
        Route::post('articles/edit/{id}', 'ArticleController@postEditArticle');
        Route::post('articles/sort', 'ArticleController@postSort');
        //pages
        Route::get('pages', 'IstaController@get');
        Route::get('pages/add', 'IstaController@getAdd');
        Route::post('pages/add', 'IstaController@postAdd');
        Route::get('pages/delete/{id}', 'IstaController@getDelete');
        Route::post('pages/delete', 'IstaController@postDelete');
        Route::get('pages/edit/{id}', 'IstaController@getEdit');
        Route::post('pages/edit/{id}', 'IstaController@postEdit');
        Route::post('pages/sort', 'IstaController@postSort');
        //ArticleCategories
        Route::get('article-cat', 'ArticleController@getArticleCat');
        Route::get('article-cat/add', 'ArticleController@getAddArticleCat');
        Route::post('article-cat/add', 'ArticleController@postAddArticleCat');
        Route::get('article-cat/delete/{id}', 'ArticleController@getDeleteArticleCat');
        Route::post('article-cat/delete', 'ArticleController@postDeleteArticleCat');
        Route::get('article-cat/edit/{id}', 'ArticleController@getEditArticleCat');
        Route::post('article-cat/edit/{id}', 'ArticleController@postEditArticleCat');
        //Uploaders
        Route::get('uploader', 'ContentController@getUploader');
        Route::get('uploader/add', 'ContentController@getAddUploader');
        Route::post('uploader/add', 'ContentController@postAddUploader');
        Route::get('uploader/delete/{id}', 'ContentController@getDeleteUploader');
        Route::get('uploader/edit/{id}', 'ContentController@getEditUploader');
        Route::post('uploader/edit/{id}', 'ContentController@postEditUploader');
        //socials
        Route::get('social', 'SocialController@get');
        Route::get('social/add', 'SocialController@getAdd');
        Route::post('social/add', 'SocialController@postAdd');
        Route::get('social/delete/{id}', 'SocialController@getDelete');
        Route::get('social/edit/{id}', 'SocialController@getEdit');
        Route::post('social/edit/{id}', 'SocialController@postEdit');
        //Redirects
        Route::get('redirect', 'RedirectController@getRedirect');
        Route::get('redirect/add', 'RedirectController@getRedirectAdd');
        Route::post('redirect/add', 'RedirectController@postRedirectAdd');
        Route::get('redirect/delete/{id}', 'RedirectController@getRedirectDelete');
        //Comments
        Route::get('comment', 'CommentController@getIndex');
        Route::get('comment/edit/{id}', 'CommentController@getEdit');
        Route::post('comment/edit/{id}', 'CommentController@postEdit');
        Route::post('comment/delete', 'CommentController@postDelete');
        Route::get('comment/delete/{id}', 'CommentController@getDelete');
        //Contacts
        Route::get('contact', 'ContactController@getIndex');
        Route::get('contact/edit/{id}', 'ContactController@getEdit');
        Route::post('contact/edit/{id}', 'ContactController@postEdit');
        Route::get('contact/delete/{id}', 'ContactController@getDelete');
        //Orders
        Route::get('/order', 'OrderController@getIndex');
        Route::get('/order/det/{id}', 'OrderController@getDetail');
        Route::post('/order/delete', 'OrderController@postDelete');
        Route::post('/order/status/{id}', 'OrderController@orderStatus');
        Route::get('/order/export', 'OrderController@export');
        //Discounts
        Route::get('/discounts', 'DiscountController@getIndex');
        Route::get('/discounts/add', 'DiscountController@getAdd');
        Route::post('/discounts/add', 'DiscountController@postAdd');
        Route::get('/discounts/edit/{id}', 'DiscountController@getEdit');
        Route::post('/discounts/edit/{id}', 'DiscountController@postEdit');
        Route::post('/discounts/delete', 'DiscountController@postDelete');
        //Inventories
        Route::get('inventory', 'InventoryController@get');
        Route::get('inventory/add', 'InventoryController@getAdd');
        Route::post('inventory/add', 'InventoryController@postAdd');
        Route::get('inventory/delete/{id}', 'InventoryController@getDelete');
        Route::post('inventory/delete', 'InventoryController@postDelete');
        Route::get('inventory/edit/{id}', 'InventoryController@getEdit');
        Route::post('inventory/edit/{id}', 'InventoryController@postEdit');
        //InventoryReceipts
        Route::get('inventory-receipt', 'InventoryController@getReceipt');
        Route::get('inventory-receipt/add', 'InventoryController@getAddReceipt');
        Route::post('inventory-receipt/add', 'InventoryController@postAddReceipt');
        Route::get('inventory-receipt/delete/{id}', 'InventoryController@getDeleteReceipt');
        Route::post('inventory-receipt/delete', 'InventoryController@postDeleteReceipt');
        Route::get('inventory-receipt/edit/{id}', 'InventoryController@getEditReceipt');
        Route::post('inventory-receipt/edit/{id}', 'InventoryController@postEditReceiptStatus');
        Route::get('/inventory-receipt/export', 'InventoryController@export');
        //OrderStatuses
        Route::get('order-status', 'StatusController@get');
        Route::get('order-status/add', 'StatusController@getAdd');
        Route::post('order-status/add', 'StatusController@postAdd');
        Route::get('order-status/delete/{id}', 'StatusController@getDelete');
        Route::post('order-status/delete', 'StatusController@postDelete');
        Route::get('order-status/edit/{id}', 'StatusController@getEdit');
        Route::post('order-status/edit/{id}', 'StatusController@postEdit');
        //Departments
        Route::get('departments', 'DepartmentController@get');
        Route::get('departments/add', 'DepartmentController@getAdd');
        Route::post('departments/add', 'DepartmentController@postAdd');
        Route::get('departments/delete/{id}', 'DepartmentController@getDelete');
        Route::post('departments/delete', 'DepartmentController@postDelete');
        Route::get('departments/edit/{id}', 'DepartmentController@getEdit');
        Route::post('departments/edit/{id}', 'DepartmentController@postEdit');
        //Departments
        Route::get('sitemap', 'SitemapController@getIndex');
        Route::post('sitemap/add', 'SitemapController@postAdd');
        Route::post('sitemap/edit', 'SitemapController@postEdit');
        // Shipment
        Route::get('shipment', 'ShipMentController@getIndex');
        Route::get('shipment/add', 'ShipMentController@getCreate');
        Route::post('shipment/add', 'ShipMentController@postCreate');
        Route::get('shipment/edit/{id}', 'ShipMentController@getEdit');
        Route::post('shipment/edit/{id}', 'ShipMentController@postEdit');
        Route::get('shipment/delete/{id}', 'ShipMentController@getDeleteShip');
    });
    //Convert
    Route::get('convert-price', 'ConvertController@converPrice');
    Route::get('convert-st', 'ConvertController@convertStoke');
    Route::post('propertie-sort', 'PropertiesController@postSort');
    Route::post('spe-sort', 'ProductSpecificationTypeController@sortSpe');
});
