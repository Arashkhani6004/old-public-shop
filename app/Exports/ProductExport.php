<?php

namespace App\Exports;


use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Content;
use App\Models\Inventory;
use App\Models\InventoryReceipt;
use App\Models\InventoryType;
use App\Models\Message;
use App\Models\Product;
use App\Models\ProductVariable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Builder;

class ProductExport implements FromArray
{
    function __construct($request) {
        $this->request = $request;
    }
    public function array(): array
    {
        $query = Product::query();

        $request = $this->request;

        if ($request->has('brand_id') && $request->get('brand_id') !== null) {
            $brandId = $request->get('brand_id');
            $query->where('brand_id', $brandId);
        }

        if ($request->has('cat_id') && $request->get('cat_id') !== null) {
            $query->whereHas('categories', function (Builder $query) use ($request) {
                $catId = $request->get('cat_id');
                $query->where('category_id', $catId);
            });
        }

        $data = $query->orderBy('id', 'DESC')->get();

        if ($data->isEmpty()) {
            $data = Product::orderBy('id', 'DESC')->get();
        }

//        dd($data);

        $data_array = [];
        foreach ($data as $row) {
            $variables = ProductVariable::where('product_id', @$row['id'])->get();
            $variable_info = '';
            foreach ($variables as $variable) {
                $variable_info = $variable->title . ': ' . $variable->stock . ', ';
            }
            $variable_info = rtrim($variable_info, ', ');
            $brand = Brand::where('id', @$row['brand_id'])->first();
            $category = '';
            foreach ($row->categories as $row2) {
                $category = $row2->title;
            }
            $data_array[] = [
                "کد" => @$row['id'],
                "عنوان" => @$row['title'],
                "دسته" => $category,
                "برند" => @$brand->title,
                "قیمت قبلی" => @$row['old_price'],
                "قیمت فعلی" => @$row['price'],
                "آدرس" => @$row['url'],
                "موجودی" => @$row['count'],
                "متغیرها-موجودی" => $variable_info,
            ];
        }

        return [
            ['کد', 'عنوان ', 'دسته', 'برند', 'قیمت قبلی', 'قیمت فعلی', 'آدرس', 'موجودی', 'متغیرها-موجودی'],
            $data_array
        ];
    }

}

