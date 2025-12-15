<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductSpecificationTypeRequest;
use App\Library\Logs;
use App\Models\Category;
use App\Models\ProductSpecificationType;
use App\Http\Controllers\Controller;
use App\Models\ProductSpecificationTypeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProductSpecificationTypeController extends Controller
{
    public function getList(Request $request, $parent_id = null)
    {
        if ($parent_id != null) {
            $first = ProductSpecificationType::whereId($parent_id)->first();
            $parent_id = $first->id;
        }
        $category = Category::orderby('id', 'DESC')->get();
        $query = ProductSpecificationType::whereParentId($parent_id)->select('id', 'title', 'status', 'view');
        if ($request->get('title')) {
            $query->where('title', 'LIKE', '%' . $request->get('title') . '%');
        }
        if (\request()->has('category_id')) {
            $query = ProductSpecificationType::whereParentId($parent_id)
            ->whereHas('categories', function ($q) use ($request) {
                $q->where('category_id', 'LIKE', '%' . $request->get('category_id') . '%');
            });
        }
        $data = $query->paginate(20);
        $parent = ProductSpecificationType::where('id', $parent_id)->first();
        $cat_pro = Category::all()->pluck('id')->toArray();
        $spe = ProductSpecificationTypeCategory::pluck('category_id')->toArray();
        $sortDatas = $query->orderBy('sort', 'ASC')->paginate(5);
        return View('admin.product-specification-type.index', compact('category', 'data', 'parent', 'parent_id', 'cat_pro', 'spe', 'sortDatas'));
    }

    public function getAdd($parent_id = null)
    {
        return View('admin.product-specification-type.add')->with('parent_id', $parent_id);
    }

    public function postAdd(Request $request, $parent_id = null)
    {
        $input = $request->all();
        $input['view'] = $request->has('view');
        $arr = [];
        foreach ($input['title'] as $key => $item) {
            if ($item !== null) {
                $arr[] = [
                    'title' => $item,
                    'parent_id' => @$parent_id,
                    'status' => @$input['status'][$key] ? 1 : 0,
                ];
            }
        }
        $p =  ProductSpecificationType::insert($arr);
        $array = array($input);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(), $serialized_array, Auth::id(), 'ProductSpecificationType');
        return Redirect::action('Admin\ProductSpecificationTypeController@getList', @$parent_id)->with('success', 'آیتم جدید اضافه شد.');
    }
    public function postAddMain(Request $request, $parent_id = null)
    {
        $input = $request->all();
        if ($input['title_main'] == null) {
            return Redirect::back()->with('error', 'عنوان  مشخصه را وارد کنید');
        }
        $p =  ProductSpecificationType::create([
            'title' => $input['title_main'],
            'status' => @$input['status'] ? 1 : 0,
            'view' => @$input['view'] ? 1 : 0,
        ]);
        $arr = [];
        foreach ($input['title'] as $key => $item) {
            if ($item !== null) {
                $arr[] = [
                    'title' => $item,
                    'parent_id' => @$p->id,
                    'status' => @$input['status'][$key] ? 1 : 0,
                ];
            }
        }
        $d =  ProductSpecificationType::insert($arr);
        $array = array($input);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(), $serialized_array, Auth::id(), 'ProductSpecificationType');
        return Redirect::action('Admin\ProductSpecificationTypeController@getList', @$parent_id)->with('success', 'آیتم جدید اضافه شد.');
    }

    public function getEdit($id)
    {
        $data = ProductSpecificationType::find($id);
        return View('admin.product-specification-type.edit')->with('data', $data);
    }

    public function postEdit($id, Request $request)
    {
        $input = $request->all();
        $input['status'] = $request->has('status');
        $input['view'] = $request->has('view');
        $page_category = ProductSpecificationType::find($id);
        $page_category->update($input);
        $array = array($input);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(), $serialized_array, Auth::id(), $page_category->id);
        return Redirect::action('Admin\ProductSpecificationTypeController@getList', @$input['parent_id'])->with('success', 'آیتم مورد نظر با موفقیت ویرابش شد.');
    }
    public function getDelete($id)
    {
        $content = ProductSpecificationType::find($id);
        $array = array($content);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(), $serialized_array, Auth::id(), $content->id);
        ProductSpecificationType::destroy($id);
        return Redirect::back()->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');
    }

    public function postDelete(Request $request)
    {
        if (ProductSpecificationType::destroy($request->get('deleteId'))) {
            return Redirect::back()->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');
        }
    }

    public function postCatAdd(Request $request)
    {
        $input = $request->all();
        $pst = ProductSpecificationType::whereId($request->get('pst_id'))->first();
        $input['status'] = $request->has('status');
        $pst->categories()->attach($request->get('category_id'));
        $array = array($pst);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(), $serialized_array, Auth::id(), $pst->id);
        return Redirect::back()->with('success', 'آیتم مورد نظر با موفقیت انجام شدند.');
    }

    public function getCatDelete($pst_id, $cat_id)
    {
        $pst = ProductSpecificationType::find($pst_id);
        $array = array($pst);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(), $serialized_array, Auth::id(), $pst->id);
        $pst->categories()->detach($cat_id);
        return Redirect::back()->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');
    }

    public function View($id)
    {
        $pst = ProductSpecificationType::find($id);
        if ($pst->view == 0) {
            $pst->update(['view' => 1]);
            return redirect()->back();
        } elseif ($pst->view == 1) {
            $pst->update(['view' => 0]);
            return Redirect::back()->with('success', 'آیتم مورد نظر با موفقیت ویرایش شد.');
        }
    }
    public function Status($id)
    {
        $pst = ProductSpecificationType::find($id);
        if ($pst->status == 0) {
            $pst->update(['status' => 1]);
            return redirect()->back();
        } elseif ($pst->status == 1) {
            $pst->update(['status' => 0]);
            return Redirect::back()->with('success', 'آیتم مورد نظر با موفقیت ویرایش شد.');
        }
    }

    public function sortSpe(Request $request)
    {
        if ($request->get('update') == "update") {
            $count = 1;
            if ($request->get('update') == 'update') {
                foreach ($request->get('arrayorder') as $idval) {
                    $category = ProductSpecificationType::find($idval);
                    $category->sort = $count;
                    $category->save();
                    $count++;
                }
                echo 'با موفقیت ذخیره شد.';
            }
        }
    }

    public static function updateview()
    {
        $views = ProductSpecificationType::withTrashed()->where('view', 0)->get();
        foreach ($views as $view) {
            $view->update(['view' => 1]);
        }
        return "success";
    }
}
