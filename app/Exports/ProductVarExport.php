<?php
namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;

class ProductVarExport implements FromArray
{
    public function array(): array
    {
        $products = Product::with(['variable' => function($query) {
            $query->orderBy('id', 'desc');
        }])->get();
        $data_array = [];

        $data_array[] = [
            'کد محصول',
            ' نام محصول',
            'کد متغییر',
            'نام متغییر',
            'تعداد متغییر',
            'قیمت متغییر',
            'قیمت تخفیف خورده متغییر'
        ];

        foreach ($products as $product) {
            foreach ($product->variable as $variable) {
                $data_array[] = [
                    $product->id,
                    $product->title,
                    $variable->id,
                    $variable->title,
                    $variable->stock,
                    $variable->price,
                    $variable->discounted_price,
                ];
            }
        }

        return $data_array;
    }
}
