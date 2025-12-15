<?php

namespace App\Http\Controllers\Admin;

use App\Exports\InventoryExport;
use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\StoreUserRequest;
use App\Library\Helper;
use App\Library\Logs;
use app\Library\UploadImg;
use App\Models\City;
use App\Models\Content;

use App\Models\Inventory;
use App\Models\InventoryReceipt;
use App\Models\InventoryType;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class InventoryController extends Controller
{

    public function get()
    {
        $inventory = Inventory::orderBy('id','DESC')->paginate(100);

        return View('admin.inventory.index')

            ->with('inventory', $inventory);
    }

    public function getAdd()
    {
            $cities = City::all();
        return View('admin.inventory.add')
            ->with('cities',$cities);


    }

    public function postAdd(Request $request)
    {
        $input = $request->all();

        $inventory = Inventory::create($input);
        $array = array($input);
        $serialized_array = serialize($array);

        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$inventory->id);
        return Redirect::action('Admin\InventoryController@get');
    }

    public function getEdit($id)
    {
        $cities = City::all();
        $data = Inventory::findorfail($id);
        return View('admin.inventory.edit')
            ->with('data', $data)
            ->with('cities',$cities);
    }

    public function postEdit($id, Request $request)
    {
        $input = $request->all();

        $inventory = Inventory::find($id);
        $inventory->update($input);
        $array = array($input);
        $serialized_array = serialize($array);

        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$inventory->id);
        return Redirect::action('Admin\InventoryController@get')->with('success' , 'آیتم مورد نظر با موفقیت ویرایش شد');
    }
    public function getDelete($id)
    {

        $content = Inventory::find($id);
        $array = array($content);
        $serialized_array = serialize($array);

        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$content->id);
        Inventory::destroy($id);
        return Redirect::action('Admin\InventoryController@get');

    }
    public function postDelete(Request $request)
    {

        if (Inventory::destroy($request->get('deleteId'))) {
            return Redirect::back()
                ->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');
        }

    }
    public function getReceipt(Request $request)
    {

        // $receipt = InventoryReceipt::orderBy('id','DESC')->paginate(100);
        $products = Product::all();
        $type = InventoryType::all();
        $inventory = Inventory::all();
        $query = InventoryReceipt::query()->orderBy('id', 'DESC');


        if ($request->get('title'))
        {
            $query->whereHas('product', function ($query2) use ($request) {
                    $query2->where('title', 'LIKE', '%' . $request->get('title') . '%');
        });
        }


        $receipt = $query->paginate(100);
        return View('admin.inventory-receipt.index')

            ->with('data', $receipt)
            ->with('products',$products)
            ->with('type',$type)
            ->with('inventory',$inventory);
    }

    public function getAddReceipt()
    {

        $products = Product::all();
        $type = InventoryType::all();
        $inventory = Inventory::all();
        return View('admin.inventory-receipt.add')

            ->with('products',$products)
            ->with('type',$type)
            ->with('inventory',$inventory);


    }

    public function postAddReceipt(Request $request)
    {
        $input = $request->all();
        $arr = [];
        foreach ($input['count'] as $key=>$item){
            $arr[] = [

                'count'=>Helper::persian2LatinDigit($item),
                'product_id'=>@$input['product_id'][$key],
                'inventory_type_id'=>@$input['inventory_type_id'][$key],
                'inventory_id'=>@$input['inventory_id'][$key],
                'status'=>@$input['status'][$key] ? 1 : 0,
            ];
        }

        $inventory = InventoryReceipt::insert($arr);
        $serialized_inventory = serialize($arr);
        $array = array($input);
        $serialized_array = serialize($array);

        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$serialized_inventory);

        return Redirect::back()
            ->with('success', 'کدهای مورد نظر با موفقیت اضافه شدند.');
    }


    public function getEditReceipt($id)
    {
        $cities = City::all();
        $data = InventoryReceipt::find($id);
        return View('admin.inventory-receipt.edit')
            ->with('data', $data)
            ->with('cities',$cities);
    }

    public function postEditReceiptStatus($id, Request $request)
    {

        $input = $request->all();
        $receipt = InventoryReceipt::find($id);
        $receipt['status'] = $request->get('status');
    if ($request->get('status') == null){
        $receipt['status'] = 0;
    }
        $h = $receipt->update();
        $array = array($input);
        $serialized_array = serialize($array);

        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$receipt->id);
        return Redirect::back()->
        with('success', 'آیتم مورد نظر با موفقیت ویرایش شد.');
    }
    public function getDeleteReceipt($id)
    {

        $content = InventoryReceipt::find($id);
        $array = array($content);
        $serialized_array = serialize($array);

        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$content->id);
        InventoryReceipt::destroy($id);
        return Redirect::action('Admin\InventoryController@get');

    }
    public function postDeleteReceipt(Request $request)
    {

        if (InventoryReceipt::destroy($request->get('deleteId'))) {
            return Redirect::back()
                ->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');
        }

    }
    public function export()
    {
        return Excel::download(new InventoryExport(), 'inventoryreceipt.xlsx');
    }

}
