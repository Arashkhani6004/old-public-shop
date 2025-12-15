<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CkeditorController extends Controller
{
    public function index()
    {
        return view('ckeditor');
    }

    public function upload(Request $request)
    {
        if(env('APP_ENV') === "production") {
            $host_name = request()->getHost();
            $type = explode('.', $host_name);
            if ($type[0] == "www") {
                $host = $type[1] . '.' . $type[2];
            } else {
                $host = $type[0] . '.' . $type[1];
            }
            if ($request->hasFile('upload')) {
                $originName = $request->file('upload')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('upload')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;
                $request->file('upload')->move(base_path('../../public_html/' . $host . '/assets/uploads/content/ckeditor/'), $fileName);
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $url = asset('/assets/uploads/content/ckeditor/' . $fileName);
                $msg = 'تصویر با موفقیت بارگذاری شد.';
                $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                @header('Content-type: text/html; charset=utf-8');
                echo $response;
            }
        }else {
            if($request->hasFile('upload')) {
                $originName = $request->file('upload')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('upload')->getClientOriginalExtension();
                $fileName = $fileName.'_'.time().'.'.$extension;

                $request->file('upload')->move(base_path('public/assets/uploads/content/ckeditor/'), $fileName);

                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $url = asset('assets/uploads/content/ckeditor/'.$fileName);
                $msg = 'تصویر با موفقیت بارگذاری شد.';
                $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

                @header('Content-type: text/html; charset=utf-8');
                echo $response;
            }
        }
    }
}
