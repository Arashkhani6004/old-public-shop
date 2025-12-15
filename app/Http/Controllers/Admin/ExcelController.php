<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Exports\ProductImport;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecification;
use App\Models\ProductSpecificationType;
use App\Models\ProductSpecificationTypeCategory;
use App\Models\Properties;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
//    public function getExcel()
//    {
// $categories = Category::get();
// foreach ($categories as $category){
//     $cat = Category::where('parent_title',$category->title)->get();
// foreach ($cat as $row){
//     $row->update([
//         'parent_id'=>$category->id
//     ]);
// }
//
// }
//    }
//    public function getExcel()
//    {
//        $products = Product::get();
//        foreach ($products as $product){
//            $cat = Category::where('title',$product->category_name)->first();
//if ($cat){
//            $cat_pro[] = [
//                'product_id' => $product->id,
//                'category_id' => $cat->id,
//            ];
//
//
//        }
//        }
//        ProductCategory::insert($cat_pro);
//
//
//    }
//    public function getExcel()
//    {
//        $products = Product::where('brand_name','<>','NULL')->get();
//        foreach ($products as $product){
//            $brand = Brand::where('title',$product->brand_name)->first();
//            if ($brand){
//                $product->update([
//         'brand_id'=>$brand->id
//     ]);
//
//
//            }
//        }
//
//
//
//    }




//        public function getExcel()
//    {
//        $products = Product::get();
//        foreach ($products as $product){
//            $spf = ProductSpecification::where('product_id',$product->id)->get();
//            $cat = ProductCategory::where('product_id',$product->id)->first();
//
//            foreach ($spf as $row){
//                if ($cat){
//                    $cat_pro[] = [
//                        'pst_id' => $row->product_specification_type_id,
//                        'category_id' => $cat->category_id,
//                    ];
//
//
//                }
//            }
//
//        }
//        ProductSpecificationTypeCategory::insert($cat_pro);
//
//
//             }


//    public function getExcel()
//    {
//        $parents = ProductSpecificationType::where('title','LIKE','%'.'سایر'.'%')->get();
//
//        foreach ($parents as $parent){
//            $childs = ProductSpecificationType::where('parent_id',$parent->id)->get();
//            foreach ($childs as $child){
//                $product_id=ProductSpecification::where('product_specification_type_id',$parent->id)->where('product_specification_value_id',$child->id)->pluck('product_id');
//           $products = Product::whereIn('id',$product_id)->get();
//             foreach ($products as $product){
//                 $properties = Properties::create([
//                     'product_id' => @$product->id,
//                     'description' => @$child->title,
//                     'status' => 0,
//
//                 ]);
//             }
//            }
//
//            }
//
//
//
//
//    }
//    public function getExcel()
//    {
//        $parents = ProductSpecificationType::where('title','LIKE','%'.'سایر'.'%')->get();
//
//        foreach ($parents as $parent){
//            $childs = ProductSpecificationType::where('parent_id',$parent->id)->get();
//            foreach ($childs as $child){
//                $products=ProductSpecification::where('product_specification_type_id',$parent->id)->where('product_specification_value_id',$child->id)->get();
//
//                foreach ($products as $product){
//                    ProductSpecification::destroy($product->id);
//
//
//                }
//                ProductSpecificationType::destroy($child->id);
//            }
//            ProductSpecificationType::destroy($parent->id);
//        }
//
//
//
//
//    }
//    public function getExcel()
//    {
//       $prices = Price::get();
//foreach ($prices as $price){
//    if ($price->old_price == $price->price){
//   $price->update([
// 'old_price'=> null
//   ]);
//    }
//}
//
//
//
//    }

//    public function getExcel()
//    {
//        $prices = Brand::get();
//        foreach ($prices as $price){
//            if ($price->image == 'NULL'){
//
//                $price->update([
//                    'image'=> null
//                ]);
//            }
//        }
//
//
//
//    }
//    public function getExcel()
//    {
//        $prices = Category::get();
//        foreach ($prices as $price){
//            if ($price->old_link != null){
//                $splitName = explode('/', $price->old_link);
//                $count = count($splitName);
//                $price->update([
//                    'url'=> $splitName[$count-1]
//                ]);
//            }
//        }
//
//
//
//    }

    public function getImport()
    {


        return view('admin.products.excel');
    }

    public function postExcel(Request $request)
    {
        Excel::import(new ProductImport, $request->file('excel_file'));
        return Redirect::back()->with('success', 'با موفقیت اضافه شد');



}
}
