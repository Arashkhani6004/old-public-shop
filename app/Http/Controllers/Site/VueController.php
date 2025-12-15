<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Like;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecification;
use App\Models\ProductSpecificationType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;

class VueController extends Controller
{
    public static function productArr($pro)
    {
        $x = 0;
        if(@$pro->old_price > 0 && @$pro->price > 0 ){
            $x = round(((@$pro->old_price - @$pro->price)/@$pro->old_price)*100) ;
        }
        if(count($pro->variable) > 0){
            $img = $pro->variable[0]->medium_image;
            return [
                'title' => @$pro->title,
                'brand' => @$pro->brands->title,
                'id' => @$pro->id,
                'url' => route('site.product.detail', ['id' => @$pro->url]),
                'image' => @$img,
                'price' => intval(@$pro->price),
                'old_price' => @$pro->old_price,
                'priceNmber' => intval(@$pro->price)  ? number_format(@$pro->price).' تومان ' : '',
                'old_priceNmber' => intval(@$pro->old_price)  ? number_format(@$pro->old_price).' تومان ' : '',
                'price2' => intval(@$pro->price_second['price']),
                'calcute' => $x,
                'like' => false,
                'likes' => @$pro->likes ? count(@$pro->likes) : 0,
                'finalOrders' => @$pro->orders ? count(@$pro->orders) : 0,
                'stock' => @$pro->count,
                'soon' => @$pro->soon,
            ];
        }else{
            return [
                'title' => @$pro->title,
                'brand' => @$pro->brands->title,
                'id' => @$pro->id,
                'url' => route('site.product.detail', ['id' => @$pro->url]),
                'image' => @$pro->medium_image,
                'price' => intval(@$pro->price),
                'old_price' => @$pro->old_price,
                'price2' => intval(@$pro->price_second['price']),
                'priceNmber' => intval(@$pro->price)  ? number_format(@$pro->price).' تومان ' : '',
                'old_priceNmber' => intval(@$pro->old_price)  ? number_format(@$pro->old_price).' تومان ' : '',
                'calcute' => $x,
                'like' => false,
                'likes' => @$pro->likes ? count(@$pro->likes) : 0,
                'finalOrders' => @$pro->orders ? count(@$pro->orders) : 0,
                'stock' => @$pro->count,
                'soon' => @$pro->soon,
            ];
        }
    }
    public function customProduct($products, $price = null, $stock = null)
    {
        $list = [];
        foreach ($products as $key => $row) {
            $proPrice = intval(@$row->price) != 0 ? intval(@$row->price) : intval(@$row->old_price);
            if ($stock) {
                if ($row->count > 0) {
                    if ($price) {

                        if ($proPrice >= $price[1] && $proPrice <= $price[0] ) {
                            $list[] = self::productArr($row);
                        }
                    } else {
                        $list[] = self::productArr($row);
                    }
                }
            } else {
                if ($price) {
                    if ($proPrice >= $price[1] && intval($proPrice <= $price[0]) ) {
                        $list[] = self::productArr($row);
                    }
                } else {
                    $list[] = self::productArr($row);
                }
            }
        }
        return $list;
    }
    public function productList(Request $request)
    {
        $req = $request->all();
        $cat = Category::find($req['category_id']);
        $categories = [$cat->id];
        foreach ($cat->childs as $ch) {
            array_push($categories, $ch->id);
            if (count($ch->childs) > 0){
                foreach ($ch->childs as $ch2){
                    array_push($categories, $ch2->id);
                }
            }
        }
        $cat_pro = ProductCategory::whereIn('category_id', $categories)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $cat_pro)->where('status',1)->orderByDesc('count')->Latest()->get();
        return response()->json(['products' => self::customProduct($products)], 200);
    }
       public function filterProduct(Request $request)
    {
        $req = $request->all();

        $product_specification = ProductSpecification::whereIn('product_specification_value_id', $req['specification'])->pluck('product_id');
        if($request->priceRange == "-"){
            $price = null;
        }else{
            $price = $request->priceRange ? explode('-', str_replace(' ', '', $request->priceRange)) : null;

        }
            $available = $request->get('available');

        $query = Product::query()->whereStatus(1)->where('sell', '<>', '1');
        $cat = Category::find($req['category_id']);
        $cat_list = [$cat->id];
        foreach ($cat->childs as $ch) {
            array_push($cat_list, $ch->id);
            if (count($ch->childs) > 0){
                foreach ($ch->childs as $ch2){
                    array_push($cat_list, $ch2->id);
                }
            }
        }
        $query->whereHas('categories', function ($query2) use ($cat_list) {
            $query2->whereIn('category_id', $cat_list);
        });

        if (count($req['specification']) > 0){
            $spfs = ProductSpecificationType::whereIn('id', $req['specification'])->get()->groupBy('parent_id');
            foreach ($spfs as $spf) {
                $query->whereHas('specifications', function ($query2) use ($spf) {
                    $query2->whereIn("product_specification_value_id", $spf->pluck('id'));
                });
            }

        }
        if (count($req['brand']) > 0){
            $query->whereIn('brand_id', $req['brand']);

        }
            if ($request->get('discount')){
                $query->whereNotNull('price')
                ->where('price', '!=', 0)
                ->whereNotNull('old_price')
                ->where('old_price', '!=', 0);
                $available = true;
            }

        // if ($request->get('discount'))
        //     $query->whereHas('prices', function ($query3) use ($req) {
        //         $query3->where('old_price', '<>', '0')->whereNotNull('old_price');
        //     });
        if ($request->get('timer')){
            $query->where('timer', 1)->where("date", ">=", Carbon::now()->timezone('Asia/Tehran')->format("Y-m-d H:i"));
            $available = true;
        }

        if ($request->get('sortBy') == 'like') {
            $query->where('popular', '1');
            $available = true;
        }

        if ($request->get('sortBy') == 'most'){
            $query->where('special', 1);
            $available = true;

        }

        if ($request->get('sortBy') == 'cheapest'){
            $query->orderBy('old_price', 'asc');
            $available = true;
        }


        if ($request->get('sortBy') == 'expensive'){
            $query->orderBy('old_price', 'desc');
            $available = true;
        }


            $products = $query->orderByDesc('count')->get();

        return response()->json(['products' => self::customProduct($products, $price, $available)], 200);
    }

    public function Brands(Request $request)
    {
        $req = $request->all();
        $cat = Category::find($req['category_id']);
        $cat_list = [$cat->id];
        foreach ($cat->childs as $ch){
            $cat_list[]=$ch['id'];
            if ($ch->has('childs')){
                foreach ($ch->childs as $child){
                    $cat_list[]=$child['id'];
                }
            }
        }


        $brand_ids = Product::whereHas('categories', function ($query2) use ($cat_list) {
            $query2->whereIn('id', $cat_list);
        })->pluck('brand_id');
        if ($req['title'] != null){
            $brands = Brand::whereIn('id', $brand_ids)->where('title', 'LIKE', '%' . $req['title'] . '%')->get();
        }else{
            $brands = Brand::whereIn('id', $brand_ids)->get();
        }

        return json_encode(['success' => true, 'brands' => $brands]);
    }
    public function Cats(Request $request)
    {
        $req = $request->all();
        $query = Product::whereHas('brands', function ($query2) use ($req) {
            $query2->where('brand_id', $req['brand_id']);
        })->pluck('id');
        $cat_id = ProductCategory::whereIn('product_id', $query)->pluck('category_id');
        $categories = Category::whereIn('id', $cat_id)->get();
        return json_encode(['success' => true, 'categories' => $categories]);
    }
    public function brandList(Request $request)
    {
        $req = $request->all();
        $products = Product::where('brand_id', $req['brand_id'])->orderByDesc('count')->where('status',1)->get();
        return response()->json(['products' => self::customProduct($products)], 200);
    }
    public function filterBrand(Request $request)
    {
        $req = $request->all();

        if($request->priceRange == "-"){
            $price = null;
        }else{
            $price = $request->priceRange ? explode('-', str_replace(' ', '', $request->priceRange)) : null;

        }
            $available = $request->get('available');

        $query = Product::query()->whereStatus(1)->where('sell', '<>', '1');
        $query->where('brand_id', $req['brand_id']);
        if (count($req['category']) > 0)
            $query->whereHas('categories', function ($query2) use ($req) {
                $query2->whereIn('id', $req['category']);
            });
        if ($request->get('discount')){
            $query->whereNotNull('price');
            $available = true;
        }

        // if ($request->get('discount'))
        //     $query->whereHas('prices', function ($query3) use ($req) {
        //         $query3->where('old_price', '<>', '0')->whereNotNull('old_price');
        //     });
        if ($request->get('timer')){
            $query->where('timer', 1)->where("date", ">=", Carbon::now()->timezone('Asia/Tehran')->format("Y-m-d H:i"));
            $available = true;
        }

        if ($request->get('sortBy') == 'like') {
            $query->where('popular', '1');
            $available = true;
        }

        if ($request->get('sortBy') == 'most'){
            $query->where('special', 1);
            $available = true;

        }

        if ($request->get('sortBy') == 'cheapest'){
            $query->orderBy('old_price', 'asc');
            $available = true;
        }


        if ($request->get('sortBy') == 'expensive'){
            $query->orderBy('old_price', 'desc');
            $available = true;
        }


        $products = $query->latest()->get();
        return response()->json(['products' => self::customProduct($products, $price, $available)], 200);
    }
    public function All(Request $request)
    {
        $req = $request->all();
        $query = Product::pluck('id');
        $cat_id = ProductCategory::whereIn('product_id', $query)->pluck('category_id');
        $categories = Category::whereIn('id', $cat_id)->get();
        $brands = Brand::get();
        $products = Product::where('status',1)->orderByDesc('count')->get();
        return json_encode(['success' => true, 'categories' => $categories, 'brands' => $brands, 'products' => $products]);
    }
    public function filterAll(Request $request)
    {
        $req = $request->all();
        if($request->priceRange == "-"){
            $price = null;
        }else{
            $price = $request->priceRange ? explode('-', str_replace(' ', '', $request->priceRange)) : null;

        }
        $available = $request->get('available');
        $query = Product::query();
        if (count($req['category']) > 0)
            $query->whereHas('categories', function ($query2) use ($req) {
                $query2->whereIn('id', $req['category']);
            });
        if (count($req['brand']) > 0)
            $query->whereHas('brands', function ($query5) use ($req) {
                $query5->whereIn('id', $req['brand']);
            });
        if ($request->get('discount')){
            $query->whereNotNull('price')
            ->where('price', '!=', 0)
            ->whereNotNull('old_price')
            ->where('old_price', '!=', 0);
            $available = true;
        }

        // if ($request->get('discount'))
        //     $query->whereHas('prices', function ($query3) use ($req) {
        //         $query3->where('old_price', '<>', '0')->whereNotNull('old_price');
        //     });
        if ($request->get('timer')){
            $query->where('timer', 1)->where("date", ">=", Carbon::now()->timezone('Asia/Tehran')->format("Y-m-d H:i"));
            $available = true;
        }

        if ($request->get('sortBy') == 'like') {
            $query->where('popular', '1');
            $available = true;
        }

        if ($request->get('sortBy') == 'most'){
            $query->where('special', 1);
            $available = true;

        }

        if ($request->get('sortBy') == 'cheapest'){
            $query->orderBy('old_price', 'asc');
            $available = true;
        }


        if ($request->get('sortBy') == 'expensive'){
            $query->orderBy('old_price', 'desc');
            $available = true;
        }


        $products = $query->latest()->get();
        $product_array = collect(self::customProduct($products));

        return response()->json(['products' => self::customProduct($products, $price, $available)], 200);
    }
    public function allList(Request $request)
    {
        $req = $request->all();
        $products = Product::where('status',1)->get()->sortByDesc('calcute');
        return response()->json(['products' => self::customProduct($products)], 200);
    }

}
