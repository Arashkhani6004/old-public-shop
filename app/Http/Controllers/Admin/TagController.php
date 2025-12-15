<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\Logs;
use App\Models\Tag;
use Classes\UploadImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class TagController extends Controller
{
        public static function  is_english($str)
    {
        if (strlen($str) == strlen(utf8_decode($str))) {
            return false;
        } else {
            return true;
        }
    }
    public function get(){
        $data = Tag::paginate(100);
        return view('admin.tag.index')
            ->with('data',$data);
    }
    public function getEdit($id){
        $data = Tag::find($id);
        return view('admin.tag.edit')
            ->with('data',$data);
    }
    
    
     public function getCrate()
    {

        return view('admin.tag.add');
    }

    public function postCreate(Request $request)
    {
        $input = $request->all();
        $input['url'] = str_replace(' ', '-', $request->get('url'));
        if (self::is_english($request['url'])) {
            return redirect()->back()->with('error', 'آدرس url را به انگلیسی بنویسید');
        }

        Tag::create($input);
        return Redirect::action('Admin\TagController@get')->with('success' , 'آیتم مورد نظر با موفقیت اضافه شد');
    }
    
    
    
    public function postEdit(Request $request , $id){
        $input = $request->all();
               $input['url'] = str_replace(' ', '-', $input['url']);
        if (self::is_english($request['url'])) {
            return redirect()->back()->with('error', 'آدرس url را به انگلیسی بنویسید');
        }
        $tag = Tag::find($id);
        $tag->update($input);
        $array = array($input);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$tag->id);
        if ($request->has('back')){
            return Redirect::back()->with('success', 'کد مورد نظر با موفقیت ویرایش شد');
        }
        else{
            return Redirect::action('Admin\TagController@get')->with('success' , 'آیتم مورد نظر با موفقیت ویرایش شد');
        }


    }
    
    public function delete($id)
    {
       
        $tag = Tag::find($id)->delete();
        return Redirect::action('Admin\TagController@get')->with('success' , 'آیتم مورد نظر با موفقیت حذف شد');
    }


}
