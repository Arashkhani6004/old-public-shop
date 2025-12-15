<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\StoreUserRequest;
use App\Library\Logs;
use app\Library\UploadImgBrand;
use App\Models\Brand;
use App\Models\Content;

use App\Models\Redirects;
use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public static function  is_english($str){
        if (strlen($str) == strlen(utf8_decode($str))) {
            return false;
        } else {
            return true;
        }
    }
    public function getBrand(Request $request)
    {
        $query= Brand::orderBy('id','DESC');
        if($request->get('title')){
            $query->where('title','LIKE','%'.$request->get('title').'%');
        }
        $brands = $query->paginate(50);
        return View('admin.brands.index')
            ->with('brands', $brands);
    }
    public function getAddBrand()
    {
        $tag = Tag::get();
        return View('admin.brands.add')
            ->with('tag', $tag);
    }
    public function postAddBrand(Request $request)
    {
        $input = $request->all();
        if(empty(trim($request['url']))){
            return redirect()->back()->with('error', 'لینک را وارد کنید');
        }
        if(self::is_english($request['url'])){
            return redirect()->back()->with('error', 'آدرس url را به انگلیسی بنویسید');
        }
        $input['status'] = $request->has('status');
        $input['footer'] = $request->has('footer');
        if ($request->hasFile('image')) {
            $path = "assets/uploads/content/brand/";
            $uploader = new UploadImgBrand();
            $fileName = $uploader->uploadPic($request->file('image'), $path);
            if($fileName){
                $input['image'] = $fileName;
            }else{
                return Redirect::back()->with('error' , 'عکس ارسالی صحیح نیست.');
            }
        }
        if ($request->get('url'))
        {
            $u = Str::slug($input['url']);
            $url = Brand::where('url', $u)->where('id','<>',$request->get('id'))->count();
            if($url === 0)
            {
                $input['url'] = $u;
            }
            else
                {
                return \redirect()->back()->with('error','url وارد شده تکراریست')
                ->withInput($request->input());
            }
        }
        $brand = Brand::create($input);
        if ($request->has('tags')) {
            $tags_input = explode(',', $input['tags']);
            $tags = [];
            foreach ($tags_input as $item) {
                        if (strlen($item) > 1) {
                $tag = Tag::where('title', $item)->first();
                if ($tag == null) {
                    $tag = Tag::create([
                        'title' => $item
                    ]);
                }
                $tags[] = [
                    'taggable_id' => $brand->id,
                    'tag_id' => $tag->id,
                    'taggable_type' => 'App\Models\Brand'
                ];
            }
            }
            Taggable::insert($tags);
        }
        $array = array($input);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$brand->id);
        if ($request->has('back')){
            return Redirect::action('Admin\BrandController@getEditBrand',$brand->id)->with('success', 'کد مورد نظر با موفقیت اضافه شد');
        }
        else{
            return Redirect::action('Admin\BrandController@getBrand')->with('success', 'کد مورد نظر با موفقیت اضافه شد');
        }
    }
    public function getEditBrand($id)
    {
        $data = Brand::find($id);
        $tag_pro = Taggable::where('taggable_id', $id)->where('taggable_type','App\Models\Brand')->pluck('tag_id')->toArray();
        $tag = Tag::whereIn('id',$tag_pro)->get();
        return View('admin.brands.edit')
            ->with('tag', $tag)
            ->with('data', $data);
    }
    public function postEditBrand($id, Request $request)
    {
        $input = $request->all();
        $input['status'] = $request->has('status');
        $input['footer'] = $request->has('footer');
        if(empty(trim($request['url']))){
            return redirect()->back()->with('error', 'لینک را وارد کنید');
        }
        if(self::is_english($request['url'])){
            return redirect()->back()->with('error', 'آدرس url را به انگلیسی بنویسید');
        }
        $content = Brand::find($id);
        if ($request->hasFile('image')) {
            $path = "assets/uploads/content/brand/";
            File::delete($path . '/big/' . $content->image);
            File::delete($path . '/medium/' . $content->image);
            File::delete($path . '/small/' . $content->image);
            $uploader = new UploadImgBrand();
            $fileName = $uploader->uploadPic($request->file('image'), $path);
            if($fileName){
                $input['image'] = $fileName;
            }else{
                return Redirect::back()->with('error' , 'عکس ارسالی صحیح نیست.');
            }
        }
        else {
            $input['image'] = $content->image;
        }
        if ($request->get('url'))
        {
            $u = Str::slug($input['url']);
            $url = Brand::where('url', $u)->where('id', '!=' , $id)->count();
            if($url === 0)
            {
                $input['url'] = $u;
            }
            else
                {
                return \redirect()->back()->with('error','url وارد شده تکراریست');
            }
        }
        $content->update($input);
            if ($request->has('tags')) {
            $tags_input = explode(',', $input['tags']);
            Taggable::where('taggable_id', $content->id)->where('taggable_type','App\Models\Brand')->delete();
            $tags = [];
            foreach ($tags_input as $item) {
                    if (strlen($item) > 1) {
                $tag = Tag::where('title', $item)->first();
                if ($tag == null) {
                    $tag = Tag::create([
                        'title' => $item
                    ]);
                }
                $tags[] = [
                    'taggable_id' => $content->id,
                    'tag_id' => $tag->id,
                    'taggable_type' => 'App\Models\Brand'
                ];
            }
            }
            Taggable::insert($tags);
        }
        $array = array($input);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$content->id);
        if ($request->has('back')){
            return Redirect::back()->with('success', 'کد مورد نظر با موفقیت ویرایش شد');
        }
        else{
            return Redirect::action('Admin\BrandController@getBrand')->with('success' , 'آیتم مورد نظر با موفقیت ویرایش شد');
        }
    }
    public function getDeleteBrand($id)
    {
        $content = Brand::find($id);
        $redirect = Redirects::create([
            "old_address" => @'/brand/'.$content->url,
            "new_address" => 'brands',
        ]);
        File::delete('assets/uploads/content/brand/small/' . $content->image);
        File::delete('assets/uploads/content/brand/big/' . $content->image);
        File::delete('assets/uploads/content/brand/medium/' . $content->image);
        $array = array($content);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$content->id);
        Brand::destroy($id);
        return Redirect::action('Admin\BrandController@getBrand')->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');
    }
    public function postDeleteBrand(Request $request)
    {
        $images = Brand::whereIn('id', $request->get('deleteId'))->pluck('image');
        foreach ($images as $item) {
            File::delete('assets/uploads/content/brand/small/' . $item);
            File::delete('assets/uploads/content/brand/big/' . $item);
            File::delete('assets/uploads/content/brand/medium/' . $item);
        }
        if (Brand::destroy($request->get('deleteId'))) {
            return Redirect::back()
                ->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');
        }
    }
    public function postSort(Request $request)
    {
        if ($request->get('update') == "update") {
            $count = 1;
            if ($request->get('update') == 'update') {
                foreach ($request->get('arrayorder') as $idval) {
                    $category = Brand::find($idval);
                    $category->listorder = $count;
                    $category->save();
                    $count++;
                }
                echo 'با موفقیت ذخیره شد.';
            }
        }
    }

}
