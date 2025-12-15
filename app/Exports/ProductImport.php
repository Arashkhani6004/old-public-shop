<?php

namespace App\Exports;



use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\InventoryReceipt;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecification;
use App\Models\ProductSpecificationType;
use App\Models\ProductSpecificationTypeCategory;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;



class ProductImport implements ToModel, WithHeadingRow

{

    /**

     * @param array $row

     *

     * @return \Illuminate\Database\Eloquent\Model|null

     */
    public function model(array $row)
    {


        $product=  Product::where('url',@$row['adrs'])->first();
        $category = Category::where('title',@$row['nam_dsth'])->first();
        if (!$category){
        $category=Category::create([
            'title'=>@$row['nam_dsth'],
            'url'=>str_replace(' ', '-',@$row['nam_dsth']),
            'status'=>'0',

            ]);
        }
        if(@$row['aanoan'] != null){
        if(@$row['nam_brnd'] != null){
            $brand = Brand::where('title',@$row['nam_brnd'])->first();
            if(!$brand){
            $brand=Brand::create([
                'title'=>@$row['nam_brnd'],
                'url'=>str_replace(' ', '-',@$row['nam_brnd']),
                'status'=>'1',
            ]);
            }
            if(!$product){
                $product = Product::create([
                    'title'=>@$row['aanoan'],
                    'brand_id'=>@$brand['id'],
                    'title_seo'=>trim(@$row['aanoan_syo']),
                    'description_seo'=>trim(@$row['todyhat_syo']),
                    'status'=>'1',
                    'url'=>str_replace(' ', '-',@$row['adrs']),
                    'old_price'=>@$row['kymt_kbl'],
                    'price'=>@$row['kymt_faaly'],
                    ]);
                $price = Price::create([
                'priceable_id'=>@$product->id,
                'priceable_type'=>'App\Models\Product',
                'old_price'=>@$row['kymt_kbl'],
                'price'=>@$row['kymt_faaly'],]);
                $pro_cat=ProductCategory::where('product_id',@$product['id'])->where('category_id',@$category['id'])->first();
                if(!@$pro_cat){
                    $pro_cat=ProductCategory::insert(['product_id'=>@$product['id'],'category_id'=>@$category['id']]);
                }
            }else{
                if (count($product->variable) == 0){
                    $product->update([
                        'old_price'=>@$row['kymt_kbl'],
                        'price'=>@$row['kymt_faaly'],
                    ]);
                }

            }
        }else{
            if(!@$product){
                $product = Product::create([
                    'title'=>@$row['aanoan'],
                    'title_seo'=>trim(@$row['aanoan_syo']),
                    'description_seo'=>trim(@$row['todyhat_syo']),
                    'status'=>'1',
                    'url'=>str_replace(' ', '-',@$row['adrs']),
                    'old_price'=>@$row['kymt_kbl'],
                    'price'=>@$row['kymt_faaly'],
                    ]);
                $price = Price::create([
                'priceable_id'=>@$product->id,
                'priceable_type'=>'App\Models\Product',
                'old_price'=>@$row['kymt_kbl'],
                'price'=>@$row['kymt_faaly'],]);
                $pro_cat=ProductCategory::where('product_id',@$product['id'])->where('category_id',@$category['id'])->first();
                if(!$pro_cat){
                    $pro_cat=ProductCategory::insert(['product_id'=>@$product['id'],'category_id'=>@$category['id']]);
                }

            }else{
                if (count($product->variable) == 0){
                    $product->update([
                        'old_price'=>@$row['kymt_kbl'],
                        'price'=>@$row['kymt_faaly'],
                    ]);
                }
            }
        }
    }
}
}



