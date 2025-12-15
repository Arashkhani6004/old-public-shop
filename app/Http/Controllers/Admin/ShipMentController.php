<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\Help;
use App\Library\Helper;
use App\Models\City;
use App\Models\ShipMent;
use App\Models\ShipmentCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use function Ramsey\Uuid\v1;

class ShipMentController extends Controller
{
    public function getIndex()
    {
        $data = ShipMent::all();
        return view('admin.shipment.index',compact('data'));
    }

    public function getCreate()
    {
        $cities = City::all();
        return view('admin.shipment.create',compact('cities'));
    }

    public function postCreate(Request $request)
    {
        $input = $request->all();
        
        if($request->get('description') == null){
             $input['description'] = " ";
        }
        if($input['price'] == null ){
            return Redirect::action('Admin\ShipMentController@getCreate')->with('error', 'قیمت را وارد کنید');
        }
        if($input['max_price'] == null ){
            return Redirect::action('Admin\ShipMentController@getCreate')->with('error', ' حداقل مبلغ برای رایگان شدن سفارش  را وارد کنید');
        }
        if($request->get('city_id') == null){
            return Redirect::action('Admin\ShipMentController@getCreate')->with('error', 'حداقل یک شهر انتخاب کنید');
        }

        $input['pay_at_home'] = $request->has('pay_at_home');
        $input['status'] = $request->has('status');
        $shipment = ShipMent::create([
            'title'=>$input['title'],
            'price'=>Helper::persian2LatinDigit($input['price']),
            'max_price' =>Helper::persian2LatinDigit($input['max_price']),
            'pay_at_home' => $input['pay_at_home'],
            'description' => @$input['description'],
            'status' => $input['status'],
        ]);

        if($input['city_id'])
        {
            foreach($input['city_id'] as $city)
            {
                ShipmentCity::create([
                    'ship_ment_id' => $shipment->id,
                    'city_id' => $city
                ]);
            }
        }


        return Redirect::action('Admin\ShipMentController@getIndex')->with('success', 'روش ارسال مورد نظر با موفقیت اضافه شد');
    }

    public function getEdit($id)
    {
        $data = ShipMent::find($id);
        $cat_pro = $data->city->pluck('id')->toArray();
        $cities = City::all();
        return view('admin.shipment.edit', compact('data', 'cities', 'cat_pro'));
    }

    public function postEdit($id, Request $request)
    {

        $input = $request->all();
        
        $shipMent = ShipMent::find($id);
        $input['pay_at_home'] = $request->has('pay_at_home');
        $input['status'] = $request->has('status');
        $shipMent->update([
            'title'=>$input['title'],
            'price'=>Helper::persian2LatinDigit($input['price']),
            'max_price' =>Helper::persian2LatinDigit($input['max_price']),
            'pay_at_home' => $input['pay_at_home'],
            'description' =>    @$input['description'],
            'status' => $input['status'],

        ]);


        // Add City
        $cities = ShipmentCity::where('ship_ment_id', $id)->get();
        foreach($cities as $city)
        {
            $city->delete();
        };


        foreach($input['city_id'] as $cit)
        {
            ShipmentCity::create([
                'ship_ment_id' => $id,
                'city_id' => $cit
            ]);
        }
        return Redirect::action('Admin\ShipMentController@getIndex')->with('success', 'روش ارسال مورد نظر با موفقیت ویرایش شد');

    }

    public function getDeleteShip($id)
    {
        $cities = ShipmentCity::where('ship_ment_id', $id)->get();
        foreach($cities as $city)
        {
            $city->delete();
        }

        ShipMent::find($id)->delete();
        return redirect()->back()->with('success', 'روش ارسال مورد نظر با موفقیت حذف شد');
    }
}
