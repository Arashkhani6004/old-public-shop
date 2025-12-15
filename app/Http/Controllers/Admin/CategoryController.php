<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Http\Requests\ProductRequest;
use App\Library\Logs;
use app\Library\MakeTree;
use App\Models\Category;
use App\Models\Content;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Redirects;
use Classes\UploadImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
  public static function  is_english($str){
        if (strlen($str) == strlen(utf8_decode($str))) {
            return false;
        } else {
            return true;
        }
    }

    public function getCategory()
    {
        $category = Category::orderby('id','DESC')->get()->toArray();
        if (!empty($category)) {
            MakeTree::getData($category);
            $category = MakeTree::GenerateArray(array('paginate' => 50));
        }
        $categorySort = Category::orderby('sort', 'ASC')->whereNull('parent_id')->get();
        return View('admin.category.index')
            ->with('categorySort', $categorySort)
            ->with('category', $category);
    }

    public function getAddCategory()
    {
        $categories = Category::all()->toArray();
//        if (!empty($category)) {
//            MakeTree::getData($category);
//            $parent_id = array(null => 'بدون والد') + MakeTree::GenerateSelect();
//        } else {
//            $parent_id = array(null => 'بدون والد');
//        }

        if (!empty($categories)) {
            MakeTree::getData($categories);
            $categories = MakeTree::GenerateArray(array('get'));
        }

        return View('admin.category.add')
            ->with('categories', $categories)
            ->with('parent_id', $categories);

    }


    public function postAddCategory(ProductRequest $request)
    {
        $input = $request->all();

        $input['show_footer'] = $request->has('show_footer');
        $input['show_menu'] = $request->has('show_menu');
        $input['url']=str_replace(' ', '-',$input['url']);
            if(self::is_english($request['url'])){
            return redirect()->back()->with('error', 'آدرس url را به انگلیسی بنویسید');

        }
        $input['status'] = $request->has('status');
        $input['description_type'] = $request->get('description_type');
        if ($request->hasFile('cover')) {
            $pathMain = "assets/uploads/content/cat";
            $extensionf = $request->file('cover')->getClientOriginalName();
            $fileName = md5(microtime())."$extensionf";
            $request->file('cover')->move($pathMain, $fileName);
            $input['cover'] = $fileName;
        }
             if ($request->hasFile('mega')) {
            $pathMain = "assets/uploads/content/cat/";
            $extensionf = $request->file('mega')->getClientOriginalName();
            $fileName = md5(microtime())."$extensionf";
            $request->file('mega')->move($pathMain, $fileName);
            $input['mega'] = $fileName;
        }

        if ($request->get('url'))
        {
            $u = Str::slug($input['url']);
            $url = Category::where('url', $u)->where('id','<>',$request->get('id'))->count();
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



        $category = Category::create($input);
          $array = array($input);
        $serialized_array = serialize($array);

        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$category->id);
        if ($request->has('back')){
            return Redirect::action('Admin\CategoryController@getEditCategory',$category->id)->with('success', 'کد مورد نظر با موفقیت اضافه شد');
        }
        else{
        return Redirect::action('Admin\CategoryController@getCategory')->with('success', 'کد مورد نظر با موفقیت اضافه شد');
    }
    }

    public function getEditCategory($id)
    {

        $data = Category::find($id);
        $categories = Category::orderby('id','DESC')->get()->toArray();
//        if (!empty($category)) {
//            MakeTree::getData($category);
//            $parent_id = array(null => 'بدون والد') + MakeTree::GenerateSelect();
//        } else {
//            $parent_id = array(null => 'بدون والد');
//        }

        if (!empty($categories)) {
            MakeTree::getData($categories);
            $categories = MakeTree::GenerateArray(array('get'));
        }
        return View('admin.category.edit')
            ->with('data', $data)
            ->with('parent_id', $categories)
            ->with('categories', $categories);
    }

    public function postEditCategory($id, ProductRequest $request)
    {
        $input = $request->all();
        $input['show_footer'] = $request->has('show_footer');
        $input['show_menu'] = $request->has('show_menu');

        $input['url']=str_replace(' ', '-',$input['url']);
          if(self::is_english($request['url'])){
            return redirect()->back()->with('error', 'آدرس url را به انگلیسی بنویسید');

        }
        $input['status'] = $request->has('status');

        $content = Category::find($id);
        if ($request->hasFile('cover')) {
            File::delete('assets/uploads/content/cat/' . $content->cover);
            $pathMain = "assets/uploads/content/cat";
            $extensionf = $request->file('cover')->getClientOriginalName();
            if (true) {
                $fileName = md5(microtime())."$extensionf";
                $request->file('cover')->move($pathMain, $fileName);
                $input['cover'] = $fileName;
            } else {
                return Redirect::back()->with('error', 'فایل ارسالی صحیح نیست.');
            }
        } else {
            $input['cover'] = $content->cover;
        }
        if ($request->hasFile('mega')) {
            File::delete('assets/uploads/content/cat/' . $content->mega);
            $pathMain = "assets/uploads/content/cat";
            $extensionf = $request->file('mega')->getClientOriginalName();
            if (true) {
                $fileName = md5(microtime())."$extensionf";
                $request->file('mega')->move($pathMain, $fileName);
                $input['mega'] = $fileName;
            } else {
                return Redirect::back()->with('error', 'فایل ارسالی صحیح نیست.');
            }
        } else {
            $input['mega'] = $content->mega;
        }
        if ($request->has('parent_id')) {
            if ($content->id == $request->get('parent_id')){
                return Redirect::back()->with('error', 'دسته مورد نظر نمیتواند زیر مجموعه خودش قرار بگیرد.');
            }
            if ((@$content->childs && count(@$content->childs) > 0) && in_array($request->get('parent_id'), @$content->childs->pluck('id')->toArray())){
                return Redirect::back()->with('error', 'دسته مورد نظر نمیتواند زیر مجموعه فرزندانش قرار بگیرد.');
            }
            $input['parent_id'] = $request->get('parent_id');
        } else {
            $input['parent_id'] = null;
        }
        if ($request->get('url'))
        {
            $u = Str::slug($input['url']);
            $url = Category::where('url', $u)->where('id', '!=' , $id)->count();
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
        return Redirect::action('Admin\CategoryController@getCategory');
    }
    }
    public function getDeleteCategory($id, Request $request)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->with('error', 'دسته مورد نظر یافت نشد.');
        }
        if (count($category->products) > 0) {
            return redirect()->back()->with('error', 'دسته مورد نظر دارای محصول است برای حذف آن ابتدا محصول زیرمجموعه را حذف کنید.');
        }
        if($category->parent_id != null){
            if (count($category->childCat) == 0) {
                Category::destroy($category->id);
                return redirect()->back()->with('success', 'زیر دسته ی مورد نظر حذف شد.');
            }if(count($category->childCat) > 0){
                return redirect()->back()->with('error', 'این زیر دسته دارای زیر دسته است ابتدا اقدام به پاک کردن زیر دسته ها بکنید');
            }
        }
        $req = $request->input('req');
        if ($req === 'all') {
            $childCategoryIds = $this->getAllChildCategoryIds($category);
            $productIds = ProductCategory::whereIn('category_id', $childCategoryIds)->pluck('product_id')->toArray();
            $productsCount = Product::whereIn('id', $productIds)->count();
            if ($productsCount > 0) {
                return redirect()->back()->with('error', 'دسته‌های مورد نظر دارای محصول است برای حذف آن ابتدا محصول زیرمجموعه را حذف کنید.');
            }
            Category::destroy($childCategoryIds);
            Category::destroy($category->id);
        } elseif ($req === 'cat') {
            Category::where('parent_id', $category->id)->update(['parent_id' => null]);
            Category::destroy($category->id);
        }
        $redirect = Redirects::create([
            "old_address" => 'cat/' . $category->url,
            "new_address" => '',
        ]);

        return Redirect::action('Admin\CategoryController@getCategory')->with('success', 'دسته‌بندی با موفقیت حذف شد.');
    }

    private function getAllChildCategoryIds($category)
    {
        $childIds = [];
        foreach ($category->subcategories as $subCategory) {
            $childIds[] = $subCategory->id;
            if ($subCategory->subcategories) {
                $childIds = array_merge($childIds, $this->getAllChildCategoryIds($subCategory));
            }
        }
        return $childIds;
    }



    public function postDeleteCategory(Request $request)
    {
        $images = Category::whereIn('id', $request->get('deleteId'));
        if (Category::destroy($request->get('deleteId'))) {
            return Redirect::back()
                ->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');
        }
    }

    public function getSearch(Request $request)
    {

        $query = Category::query();
        if($request->get('title')){
            $query->where('title','LIKE','%'.$request->get('title').'%');
        }

        $category = $query->orderBy('id','DESC')->paginate(100);

        return View('admin.category.search')
            ->with('category', $category);
    }
    public function postSort(Request $request)
    {

        if ($request->get('update') == "update") {
            $count = 1;
            if ($request->get('update') == 'update') {
                foreach ($request->get('arrayorder') as $idval) {

                    $category = Category::find($idval);
                    $category->sort = $count;
                    $category->save();
                    $count++;
                }
                echo 'با موفقیت ذخیره شد.';
            }
        }
    }



}
