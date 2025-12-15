<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Library\Logs;
use app\Library\UploadImg;
use App\Models\Content;
use App\Models\Ista;
use App\Models\Log;
use App\Models\Redirects;
use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Str;

class IstaController extends Controller
{

    public function get()
    {
        $articles = Ista::orderBy('id','DESC')->paginate(50);
        $categorySort =Ista::orderBy('sort','ASC')->get();

        return View('admin.ista.index')


            ->with('categorySort', $categorySort)
            ->with('articles', $articles);
    }

    public function getAdd()
    {


        return View('admin.ista.add');


    }

    public function postAdd(ArticleRequest $request)
    {
        $input = $request->all();
        $input['status'] = $request->has('status');
        $input['footer'] = $request->has('footer');

        $input['url']=str_replace(' ', '-',$input['url']);
        if ($request->hasFile('image')) {
            $path = "assets/uploads/content/page/";
            $uploader = new UploadImg();
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
            $url = Ista::where('url', $u)->where('id','<>',$request->get('id'))->count();
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



        $article = Ista::create($input);
        $array = array($input);
        $serialized_array = serialize($array);

        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$article->id);



        if ($request->has('back')){
            return Redirect::action('Admin\IstaController@getEdit',$article->id)->with('success', 'کد مورد نظر با موفقیت اضافه شد');
        }
        else{
        return Redirect::action('Admin\IstaController@get')->with('success', 'کد مورد نظر با موفقیت اضافه شد');
    }
    }

    public function getEdit($id)
    {
        $data = Ista::find($id);
        return View('admin.ista.edit')
            ->with('data', $data);
    }

    public function postEdit($id, ArticleRequest $request)
    {
        $input = $request->all();
        $input['status'] = $request->has('status');
        $input['footer'] = $request->has('footer');
        $input['url']=str_replace(' ', '-',$input['url']);
        $content = Ista::find($id);
        if ($request->hasFile('image')) {
            $path = "assets/uploads/content/page/";
            File::delete($path . '/big/' . $content->image);
            File::delete($path . '/medium/' . $content->image);
            File::delete($path . '/small/' . $content->image);
            $uploader = new UploadImg();
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
            $url = Ista::where('url', $u)->where('id', '!=' , $id)->count();
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

        $array = array($input);
        $serialized_array = serialize($array);

        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$content->id);
        if ($request->has('back')){
            return Redirect::back()->with('success', 'کد مورد نظر با موفقیت ویرایش شد');
        }
        else{
        return Redirect::action('Admin\IstaController@get')->with('success' , 'آیتم مورد نظر با موفقیت ویرایش شد');
    }
    }
    public function getDelete($id)
    {

        $content = Ista::find($id);
        $redirect = Redirects::create([
            "old_address" => @'/page-detail/'.$content->id,
            "new_address" => '/',

        ]);
        File::delete('assets/uploads/content/page/small/' . $content->image);
        File::delete('assets/uploads/content/page/big/' . $content->image);
        File::delete('assets/uploads/content/page/medium/' . $content->image);
        $array = array($content);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$content->id);
        Ista::destroy($id);
        return Redirect::action('Admin\IstaController@get')->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');

    }
    public function postDelete(Request $request)
    {
        $images = Ista::whereIn('id', $request->get('deleteId'))->pluck('image');
        foreach ($images as $item) {
            File::delete('assets/uploads/content/page/small/' . $item);
            File::delete('assets/uploads/content/page/big/' . $item);
            File::delete('assets/uploads/content/page/medium/' . $item);
        }
        if (Ista::destroy($request->get('deleteId'))) {
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

                    $category = Ista::find($idval);
                    $category->listorder = $count;
                    $category->save();
                    $count++;
                }
                echo 'با موفقیت ذخیره شد.';
            }
        }
    }


}
