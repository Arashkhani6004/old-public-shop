<?php


Route::get('/convert-categories', 'Site\ConvertController@convertCategories');
Route::get('/convert-products', 'Site\ConvertController@convertProducts');
Route::get('/convert-brands', 'Site\ConvertController@convertBrands');
Route::get('/convert-images', 'Site\ConvertController@convertImages');

Route::get('/replace-image-names', 'Site\ConvertController@replaceImageNames');
