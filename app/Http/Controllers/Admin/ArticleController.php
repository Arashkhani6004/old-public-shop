<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\StoreUserRequest;
use App\Library\Logs;
use app\Library\UploadImgArticle;
use App\Models\Content;
use App\Models\Log;
use App\Models\Redirects;
use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{

    public function getArticle()
    {
        $articles = Content::orderBy('id','DESC')->Article()->paginate(50);
        $article_cat = Content::orderBy('id','DESC')->ArticleCat()->get();
        return View('admin.article.index')
            ->with('article_cat', $article_cat)
            ->with('articles', $articles);
    }
    public function getAddArticle()
    {
        $article_cat = Content::orderBy('id','DESC')->ArticleCat()->get();
        $tag = Tag::get();
        return View('admin.article.add')
            ->with('article_cat', $article_cat)
            ->with('tag', $tag);
    }
    public function postAddArticle(ArticleRequest $request)
    {
        $input = $request->all();
        $input['status'] = $request->has('status');
        $input['baner_type'] = $request->has('baner_type');
        //        $input['url']=str_replace(' ', '-',$input['url']);
        if ($request->hasFile('image')) {
            $path = "assets/uploads/content/art/";
            $uploader = new UploadImgArticle();
            $fileName = $uploader->uploadPic($request->file('image'), $path);
            if($fileName){
                $input['image'] = $fileName;
            }else{
                return Redirect::back()->with('error' , 'عکس ارسالی صحیح نیست.');
            }
        }
        $input['content_type'] = '1';
        $article = Content::create($input);
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
                        'taggable_id' => $article->id,
                        'tag_id' => $tag->id,
                        'taggable_type' => 'App\Models\Content'
                    ];
                }
            }
            Taggable::insert($tags);
        }
        $array = array($input);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$article->id);
        if ($request->has('back')){
            return Redirect::action('Admin\ArticleController@getEditArticle',$article->id)->with('success', 'کد مورد نظر با موفقیت اضافه شد');
        }
        else{
            return Redirect::action('Admin\ArticleController@getArticle')->with('success', 'کد مورد نظر با موفقیت اضافه شد');
        }
    }
    public function getEditArticle($id)
    {
        $data = Content::Article()->find($id);
        $article_cat = Content::orderBy('id','DESC')->ArticleCat()->get();
        $tag_pro = Taggable::where('taggable_id', $id)->where('taggable_type','App\Models\Content')->pluck('tag_id')->toArray();
        $tag = Tag::whereIn('id',$tag_pro)->get();
        return View('admin.article.edit')
            ->with('data', $data)
            ->with('tag', $tag)
            ->with('article_cat', $article_cat);
    }
    public function postEditArticle($id, ArticleRequest $request)
    {
        $input = $request->all();
        $input['status'] = $request->has('status');
        $input['baner_type'] = $request->has('baner_type');
        //$input['url']=str_replace(' ', '-',$input['url']);
        $content = Content::find($id);
        if ($request->hasFile('image')) {
            $path = "assets/uploads/content/art/";
            File::delete($path . '/big/' . $content->image);
            File::delete($path . '/medium/' . $content->image);
            File::delete($path . '/small/' . $content->image);
            $uploader = new UploadImgArticle();
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
        $input['content_type'] = '1';
        $content->update($input);
        if ($request->has('tags')) {
            $tags_input = explode(',', $input['tags']);
            Taggable::where('taggable_id', $content->id)->where('taggable_type','App\Models\Content')->delete();
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
                        'tag_id' => @$tag->id,
                        'taggable_type' => 'App\Models\Content'
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
        return Redirect::action('Admin\ArticleController@getArticle')->with('success' , 'آیتم مورد نظر با موفقیت ویرایش شد');
    }
    }
    public function getDeleteArticle($id)
    {
        $content = Content::find($id);
        $redirect = Redirects::create([
            "old_address" => @'/blog-detail/'.$content->id,
            "new_address" => 'blogs',
        ]);
        File::delete('assets/uploads/content/art/small/' . $content->image);
        File::delete('assets/uploads/content/art/big/' . $content->image);
        File::delete('assets/uploads/content/art/medium/' . $content->image);
        $array = array($content);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$content->id);
        Content::destroy($id);
        return Redirect::action('Admin\ArticleController@getArticle')->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');
    }
    public function postDeleteArticle(Request $request)
    {
        $images = Content::whereIn('id', $request->get('deleteId'))->Article()->pluck('image');
        foreach ($images as $item) {
            File::delete('assets/uploads/content/art/small/' . $item);
            File::delete('assets/uploads/content/art/big/' . $item);
            File::delete('assets/uploads/content/art/medium/' . $item);
        }
        if (Content::destroy($request->get('deleteId'))) {
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
                    $category = Content::find($idval);
                    $category->listorder = $count;
                    $category->save();
                    $count++;
                }
                echo 'با موفقیت ذخیره شد.';
            }
        }
    }
//======================article cat================
    public function getArticleCat()
    {
        $article_cat = Content::orderBy('id','DESC')->ArticleCat()->paginate(50);
        return View('admin.article-cat.index')
            ->with('article_cat', $article_cat);
    }

    public function getAddArticleCat()
    {
        return View('admin.article-cat.add');
    }

    public function postAddArticleCat(ArticleRequest $request)
    {
        $input = $request->all();
        //        $input['url']=str_replace(' ', '-',$input['url']);
        if ($request->hasFile('image')) {
            $path = "assets/uploads/content/art/";
            $uploader = new UploadImgArticle();
            $fileName = $uploader->uploadPic($request->file('image'), $path);
            if($fileName){
                $input['image'] = $fileName;
            }else{
                return Redirect::back()->with('error' , 'عکس ارسالی صحیح نیست.');
            }
        }
        $input['content_type'] = '5';
        $article = Content::create($input);
        $article->update([
            'url' => 'blog-cat/'.$article->id,
        ]);
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
                        'taggable_id' => $article->id,
                        'tag_id' => $tag->id,
                        'taggable_type' => 'App\Models\Content'
                    ];
                }
            }
            Taggable::insert($tags);
        }
        $array = array($input);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$article->id);
        if ($request->has('back')){
            return Redirect::action('Admin\ArticleController@getEditArticleCat',$article->id)->with('success', 'کد مورد نظر با موفقیت اضافه شد');
        }
        else{
            return Redirect::action('Admin\ArticleController@getArticleCat')->with('success', 'کد مورد نظر با موفقیت اضافه شد');
        }
    }
    public function getEditArticleCat($id)
    {
        $data = Content::ArticleCat()->find($id);
        return View('admin.article-cat.edit')
            ->with('data', $data);
    }
    public function postEditArticleCat($id, ArticleRequest $request)
    {
        $input = $request->all();
        //$input['url']=str_replace(' ', '-',$input['url']);
        $content = Content::find($id);
        if ($request->hasFile('image')) {
            $path = "assets/uploads/content/art/";
            File::delete($path . '/big/' . $content->image);
            File::delete($path . '/medium/' . $content->image);
            File::delete($path . '/small/' . $content->image);
            $uploader = new UploadImgArticle();
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
        $input['content_type'] = '5';
        $content->update($input);
            if ($request->has('tags')) {
            $tags_input = explode(',', $input['tags']);
            Taggable::where('taggable_id', $content->id)->where('taggable_type','App\Models\Content')->delete();
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
                        'taggable_type' => 'App\Models\Content'
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
            return Redirect::action('Admin\ArticleController@getArticleCat')->with('success' , 'آیتم مورد نظر با موفقیت ویرایش شد');
        }
    }
    public function getDeleteArticleCat($id)
    {
        $content = Content::find($id);
        $redirect = Redirects::create([
            "old_address" => @'/blog-detail/'.$content->id,
            "new_address" => 'blogs',
        ]);
        File::delete('assets/uploads/content/art/small/' . $content->image);
        File::delete('assets/uploads/content/art/big/' . $content->image);
        File::delete('assets/uploads/content/art/medium/' . $content->image);
        $array = array($content);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$content->id);
        Content::destroy($id);
        return Redirect::action('Admin\ArticleController@getArticleCat');
    }
    public function postDeleteArticleCat(Request $request)
    {
        $images = Content::whereIn('id', $request->get('deleteId'))->Article()->pluck('image');
        foreach ($images as $item) {
            File::delete('assets/uploads/content/art/small/' . $item);
            File::delete('assets/uploads/content/art/big/' . $item);
            File::delete('assets/uploads/content/art/medium/' . $item);
        }
        if (Content::destroy($request->get('deleteId'))) {
            return Redirect::back()
                ->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');
        }
    }
}
