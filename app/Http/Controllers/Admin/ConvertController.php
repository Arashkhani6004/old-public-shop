<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\Help;
use App\Library\Helper;
use App\Models\InventoryReceipt;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;

class ConvertController extends Controller
{
    function converPrice()
    {
        $products = Product::orderBy('id', 'desc')->get();
        foreach($products as $product)
        {
            $price = Price::where('priceable_id', $product->id)->orderBy('created_at', 'DESC')->first();
            if($price)
            {
                $product->update([
                    'price' => intval(Helper::persian2LatinDigit($price->price)),
                    'old_price'=> intval(Helper::persian2LatinDigit($price->old_price)),
                ]);
            }
        }
    }
    public function convertStoke()
    {
        $products = Product::orderBy('id', 'desc')->get();
        foreach($products as $product)
        {
            $stoks_in = InventoryReceipt::where('product_id', $product->id)->where('inventory_type_id', 1)->sum('count');
            $stoks_out = InventoryReceipt::where('product_id', $product->id)->where('inventory_type_id', 2)->sum('count');
            $stoke = intval($stoks_in) - intval($stoks_out);
            $product->update([
                    'count' => Helper::persian2LatinDigit($stoke),
                ]);
        }
    }
}
