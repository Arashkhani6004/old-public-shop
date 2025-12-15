<?php

namespace App\Exports;


use App\Models\Order;
use App\Models\Product;
use App\Models\Category;


use App\Models\ProductCategory;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Builder;

class OrderExport implements FromArray
{
    function __construct($request2) {
        $this->request2 = $request2;
    }
    public function array(): array
    {
        $data = Order::get();
        $request = $this->request2;

        $query = Order::query();
        if($request->get('name')){
            $query->whereHas('user',function (Builder $query2)use($request) {
                $query2->where('name' , 'LIKE', '%' . $request->get('name') . '%');
            });

        }
        if($request->get('family')){
            $query->whereHas('user',function (Builder $query2)use($request) {
                $query2->where('family' , 'LIKE', '%' . $request->get('family') . '%');
            });

        }
        if($request->get('mobile')){
            $query->whereHas('user',function (Builder $query2)use($request) {
                $query2->where('mobile' , $request->get('mobile'));
            });

        }
        if($request->get('email')){
            $query->whereHas('user',function (Builder $query2)use($request) {
                $query2->where('email' , $request->get('email'));
            });

        }
        if ($request->get('start') and $request->get('end')) {

            $start = explode('/', $request->get('start'));
            $end = explode('/', $request->get('end'));

            $s = jmktime(0, 0, 0, $start[1], $start[0], $start[2]);
            $e = jmktime(0, 0, 0, $end[1], $end[0], $end[2]);

            $query->whereBetween('created_at', array($s, $e));
        }

        if($request->get('payment')){
            $query->where('payment' ,[intval($request->get('payment'))]);
        }
        if ($request->get('order_status_id')) {
            $query->where('order_status_id', $request->get('order_status_id'));
        }






        $data = $query->get();

        $data_array = [];
        foreach ($data as $order) {



            $data_array[] = [
                "نام" =>$order->user->name,
                "نام خانوادگی" =>$order->user->family,
                "ایمیل" =>$order->user->email,
                "تلفن" =>$order->user->mobile,
                "(تومان) مبلغ پرداختی" =>intval(@$order->payment),

            ];
        }
        return [
            [
                'نام' ,
                'نام خانوادگی',
                'ایمیل',
                'تلفن',
                '(تومان) مبلغ پرداختی',
            ],
            $data_array
        ];
    }
}
