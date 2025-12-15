<?php

// Route::get('/login-me-as/{id}', function($id){
//     Auth::loginUsingId($id);
// });


Route::get('/generate-password/{password}', function($password){
    dd(bcrypt($password));
});


Route::get('/image', function () {
    //     $host_name = request()->getHost();
    //     $type = explode('.', $host_name);
    //     if($type[0] == "www"){
    //         $host = $type[1].'.'.$type[2];
    //     }
    //     else{
    //         $host = $type[0].'.'.$type[1];
    //     }
    // $path = base_path('public_html/'.$host.'/assets/site/images/icon-ita.png'); // مسیر فایل عکس در سایت "Site A"

    // $file = file_get_contents($path);
    
    $imageUrl = 'https://bafilter.com/assets/site/images/icon-ita.png'; // آدرس مسیر عکس در سایت "Site A"
    $imageData = file_get_contents($imageUrl);
    $destinationPath = base_path('public_html/hamejin.com/assets/site/images/icon-ita.png');
    file_put_contents($destinationPath, $imageData);
    
    
});