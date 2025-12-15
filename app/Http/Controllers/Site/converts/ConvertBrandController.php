<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Domain;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ConvertBrandController extends Controller
{
    public function BrandUrlInsert(){
        $brands = Brand::whereRaw("TRIM(url) = '' OR url IS NULL")->get();
        foreach($brands as $brand){
            $brand ->update([
                'url' => Str::slug($brand->title)
            ]);
        }
    }
}
