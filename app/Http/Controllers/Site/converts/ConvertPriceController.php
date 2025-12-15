<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Product;
use App\Models\ProductVariable;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\ShipMent;
use App\Models\ShipmentCity;
use App\Models\Order;
use App\Models\City;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;
class ConvertPriceController extends Controller
{
    public function convert(Request $request)
    {
        {
            set_time_limit(200000);
            $products = Product::orderBy('id', 'DESC')->whereHas('variable_stock')->paginate(50);
            foreach ($products as $pr) {
                $product_specification = ProductVariable::orderBy('price', 'ASC')->where('price', '<>', '0')->where('product_id', $pr->id)->first();
                if ($product_specification) {
                    $pr->update([
                        'price' => intval(@$product_specification->price) == 0 ? 0 : intval(@$product_specification->discounted_price),
                        'old_price' => intval(@$product_specification->price) == 0 ? intval(@$product_specification->discounted_price) : intval(@$product_specification->price),
                        'shenase' => 2,
                    ]);
                } else {
                    $pr->update([
                        'old_price' => 0,
                        'price' => 0,
                        'shenase' => 1,
                    ]);
                }

            }
            $limit = ini_get('memory_limit');
            ini_set('memory_limit', -1);
            ini_set('memory_limit', $limit);
            if ($products->lastPage() !== $products->currentPage()) {
                $page = intval($request->page) + 1;
                return redirect('/convert-price?page=' . $page);
            }

        }


    }

}
