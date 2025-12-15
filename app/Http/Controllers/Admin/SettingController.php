<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingRequest;

use App\Http\Controllers\Controller;
use App\Library\Logs;
use app\Library\UploadImg;
use App\Models\City;
use App\Models\Category;
use App\Models\Setting;
use App\Library\Helper;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function getEditSetting()
    {
        $data = Setting::first();
        $cities=City::all();
        return View('admin.setting.form')
            ->with('data', $data)
            ->with('cities', $cities);
    }
    public function postEditSetting($id, SettingRequest $request)
    {
        $input = $request->all();
        // dd($input);
        $setting = Setting::find($id);
        $input['owner_mobile'] = Helper::persian2LatinDigit($request->get('owner_mobile'));
        $input['tax'] = Helper::persian2LatinDigit($request->get('tax'));
        if ($input['tax'] == NULL) {
            $input['tax'] = 0;
        }   

        $input['disable'] = $request->has('disable');
        $input['noindex'] = $request->has('noindex');
        $input['status_send'] = $request->has('status_send');
        // $input['status_police'] = $request->has('status_police');
        $input['box_discount'] = $request->has('box_discount');
        $input['description_type'] = $request->get('description_type');
        $input['call_description'] = $request->get('call_description');
        $input['status_police'] = $request->has('status_police');
        if ($request->hasFile('logo')) {
            File::delete('assets/uploads/content/set/' . $setting->logo);
            $pathMain = "assets/uploads/content/set";
            $extension = $request->file('logo')->getClientOriginalName();
           if (true) {
             $fileName = mt_rand(100, 999)."$extension";
                $request->file('logo')->move($pathMain, $fileName);
                $input['logo'] = $fileName;
            } else {
                return Redirect::back()->with('error', 'فایل ارسالی صحیح نیست.');
            }
        } else {
            $input['logo'] = $setting->logo;
        }
        if ($request->hasFile('special_img')) {
            File::delete('assets/uploads/content/set/' . $setting->special_img);
            $pathMain = "assets/uploads/content/set";
            $extension = $request->file('special_img')->getClientOriginalName();
            if (true) {
                $fileName = mt_rand(100, 999)."$extension";
                $request->file('special_img')->move($pathMain, $fileName);
                $input['special_img'] = $fileName;
            } else {
                return Redirect::back()->with('error', 'فایل ارسالی صحیح نیست.');
            }
        } else {
            $input['special_img'] = $setting->special_img;
        }
        if ($request->hasFile('logo2')) {
            File::delete('assets/uploads/content/set/' . $setting->logo2);
            $pathMain = "assets/uploads/content/set";
            $extension = $request->file('logo2')->getClientOriginalName();
            if (true) {
                $fileName = mt_rand(100, 999)."$extension";
                $request->file('logo2')->move($pathMain, $fileName);
                $input['logo2'] = $fileName;
            } else {
                return Redirect::back()->with('error', 'فایل ارسالی صحیح نیست.');
            }
        } else {
            $input['logo2'] = $setting->logo2;
        }

        if ($request->hasFile('aboutimg')) {
            $path = "assets/uploads/content/set/";
            File::delete($path . '/big/' . $setting->aboutimg);
            File::delete($path . '/medium/' . $setting->aboutimg);
            File::delete($path . '/small/' . $setting->aboutimg);
            $uploader = new UploadImg();
            $fileName = $uploader->uploadPic($request->file('aboutimg'), $path);
            if($fileName){
                $input['aboutimg'] = $fileName;
            }else{
                return Redirect::back()->with('error' , 'عکس ارسالی صحیح نیست.');
            }
        }
        else {
            $input['aboutimg'] = $setting->aboutimg;
        }
        if ($request->hasFile('favicon')) {
            File::delete('assets/uploads/content/set/' . $setting->favicon);
            $pathMain = "assets/uploads/content/set";
            $extension = $request->file('favicon')->getClientOriginalName();
            if (true) {
                $fileName = mt_rand(100, 999)."$extension";
                $request->file('favicon')->move($pathMain, $fileName);
                $input['favicon'] = $fileName;
            } else {
                return Redirect::back()->with('error', 'فایل ارسالی صحیح نیست.');
            }
        } else {
            $input['favicon'] = $setting->favicon;
        }
                if ($request->hasFile('modal_img')) {
            File::delete('assets/uploads/content/set/' . $setting->modal_img);
            $pathMain = "assets/uploads/content/set";
            $extension = $request->file('modal_img')->getClientOriginalName();
            if (true) {
                $fileName = mt_rand(100, 999) . "$extension";
                $request->file('modal_img')->move($pathMain, $fileName);
                $input['modal_img'] = $fileName;
            } else {
                return Redirect::back()->with('error', 'فایل ارسالی صحیح نیست.');
            }
        } else {
            $input['modal_img'] = $setting->modal_img;
        }
        if ($request->hasFile('modal_mobile_img')) {
            File::delete('assets/uploads/content/set/' . $setting->modal_mobile_img);
            $pathMain = "assets/uploads/content/set";
            $extension = $request->file('modal_mobile_img')->getClientOriginalName();
            if (true) {
                $fileName = mt_rand(100, 999) . "$extension";
                $request->file('modal_mobile_img')->move($pathMain, $fileName);
                $input['modal_mobile_img'] = $fileName;
            } else {
                return Redirect::back()->with('error', 'فایل ارسالی صحیح نیست.');
            }
        } else {
            $input['modal_mobile_img'] = $setting->modal_mobile_img;
        }
        $setting->update($input);
        
        $array = array($setting);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(),$serialized_array,Auth::id(),$setting->id);

        return Redirect::action('Admin\SettingController@getEditSetting')->with('success', 'آیتم مورد نظر با موفقیت ویرایش شد.');    }
    public function deleteModal(Request $request)
    {
        $setting = Setting::first();
        if (!empty($setting->modal_img)) {

            if ($setting->modal_img != null) {
                $setting->update(['modal_img' => null]);
                $setting->save();
                return redirect()->back()->with('success', 'آیتم شما با موفقیت حذف شد');
            }
        } else {
            return redirect()->back()->with('error', 'فیلد تصویر مودال خالی است');
        }
    }
    public function deleteModalMobile(Request $request)
    {
        $setting = Setting::first();
        if (!empty($setting->modal_mobile_img)) {

            if ($setting->modal_mobile_img != null) {
                $setting->update(['modal_mobile_img' => null]);
                $setting->save();
                return redirect()->back()->with('success', 'آیتم شما با موفقیت حذف شد');
            }
        } else {
            return redirect()->back()->with('error', 'فیلد تصویر مودال خالی است');
        }
    }
}
