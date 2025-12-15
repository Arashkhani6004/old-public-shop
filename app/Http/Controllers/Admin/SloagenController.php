<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\StoreUserRequest;
use App\Library\Logs;
use App\Models\Area;
use App\Models\CatBrand;
use App\Models\Category;
use App\Models\City;
use App\Models\Content;
use App\Models\Product;
use App\Models\Question;
use App\Models\Sloagen;
use App\Models\Slogan;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class SloagenController extends Controller
{
    public function get()
    {
        $sloagens = Sloagen::orderby('id','desc')->paginate(100);
        return View('admin.sloagen.index')
            ->with('sloagens', $sloagens);
    }

    public function getAdd()
    {
        $categories = Category::orderby('id','desc')->get();
        return View('admin.sloagen.add')
            ->with('categories', $categories);


    }

    public function postAdd(Request $request)
    {
        $input = $request->all();

        $arr = [];


        foreach ($input['title'] as $key => $item) {
            if ($item != null && $input['image'][intval($key)] !== null) {
                if ($input['image'][intval($key)]) {
                    $pathMain = "assets/uploads/content/sloagen/";
                    $extensionf = $input['image'][intval($key)]->getClientOriginalName();
                    $fileName = mt_rand(100, 999) . "$extensionf";
                    $input['image'][intval($key)]->move($pathMain, $fileName);
                    $input['image'][intval($key)] = $fileName;
                }

                $sloagen = Sloagen::create([
                    'title' => $item,
                    'image' => $input['image'][intval($key)],
                ]);
                $categoryIds = is_array($input['category_id']) ? $input['category_id'] : [$input['category_id']];
                $sloagen->categories()->attach($categoryIds);

            }
        }
        $array = array($input);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$sloagen->id);
        return Redirect::action('Admin\SloagenController@get')->with('success', 'کدهای مورد نظر با موفقیت اضافه شدند.');

    }

    public function getEdit($id)
    {

        $data = Sloagen::find($id);
        $categories = Category::orderby('id','desc')->get();
        $selectedCategories = $data->categories->pluck('id')->toArray();

        return view('admin.sloagen.edit', compact('id', 'data', 'categories', 'selectedCategories'));

    }

    public function postEdit($id, Request $request)
    {
        $input = $request->all();
        $sloagen = Sloagen::find($id);
        if ($request->hasFile('image')) {
            File::delete('assets/uploads/content/sloagen/' . $sloagen->image);
            $pathMain = "assets/uploads/content/sloagen";
            $extension = $request->file('image')->getClientOriginalName();
            $fileName = mt_rand(100, 999) . "$extension";
            $request->file('image')->move($pathMain, $fileName);
            $input['image'] = $fileName;
        } else {
            $input['image'] = $sloagen->image;
        }
        $categoryIds = is_array($input['category_id']) ? $input['category_id'] : [$input['category_id']];
        $sloagen->categories()->sync($categoryIds);
        $sloagen->update([
                'title' => $input['title'],
                'image' => $input['image'],
        ]
        );
        $array = array($input);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(), $serialized_array, Auth::id(), $sloagen->id);

        return redirect('/adminstrator/sloagen/')->with('success', 'آیتم موردنظر با موفقیت ویرایش شد.');
        }
    public function getDelete($id)
    {

        $content = Sloagen::find($id);
        $array = array($content);
        $serialized_array = serialize($array);

        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$content->id);
        Sloagen::destroy($id);
        return Redirect::back()
            ->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');

    }
    public function postDelete(Request $request)
    {
        $orders = Sloagen::find($request['deleteId']);
        foreach($orders as $order)
        {
            $array = array($order);
            $serialized_array = serialize($array);

            $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$order->id);
            $order->delete();
        }

            return Redirect::back()
                ->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');


    }


    public function getSlogan()
    {
        $slogans = Slogan::orderby('id','desc')->paginate(100);
        return View('admin.slogan-pro.index')
            ->with('slogans', $slogans);
    }

    public function getAddSlogan()
    {
        $categories = Category::orderby('id','desc')->get();
        $products = Product::orderby('id','desc')->get();

        return View('admin.slogan-pro.add')
            ->with('products', $products)
            ->with('categories', $categories);
    }

    public function postAddSlogan(Request $request)
    {
        $input = $request->all();
        dd($input   , $request->get('sloganable_id'), $request->get('sloganable_type') );

        $arr = [];
        foreach ($input['title'] as $key=>$item){
            if ($item != null && $input['image'][intval($key)] !== null ){
                if(@$input['image'][intval($key)]){
                    $pathMain = "assets/uploads/content/sloagen/";
                    $extensionf = $input['image'][intval($key)]->getClientOriginalName();
                    $fileName =mt_rand(100, 999)."$extensionf";
                    @$input['image'][intval($key)]->move($pathMain, $fileName);
                    @$input['image'][intval($key)] = $fileName;
                }
                $slogan = Slogan::create([
                    'title' => $item,
                    'image' => @$input['image'][intval($key)],
                    'sloganable_id'=> $request->get('sloganable_id'),
                    'sloganable_type'=> $request->get('sloganable_type'),
                ]);
            }
        }


        $array = array($input);

        $serialized_array = serialize($array);

        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$slogan->id);
        return Redirect::action('Admin\SloagenController@getSlogan')->with('success', 'کدهای مورد نظر با موفقیت اضافه شدند.');

    }


}
