<?php

namespace App\Http\Controllers\Admin;
use App\Library\Logs;
use App\Models\Sitemap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;



class SitemapController extends Controller
{
    public function getIndex(Request $request)
    {
        $data = Sitemap::get();
        return View('admin.sitemap.index')
            ->with('data', $data);
    }

    public function postAdd(Request $request)
    {

        $input = $request->all();
        // dd($input);
        foreach($request['changefreq'] as $key=>$ch){

            $x = Sitemap::create([
                'changefreq' => $ch ,
                'priority' => $request['priority'][$key],
                'type' => $key ,
            ]);
        }
        return \redirect()->back()->with('success','سایت مپ آپدیت شد.');
    }
    public function postEdit(Request $request)
    {
        $input = $request->all();
        foreach($request['changefreq'] as $key=>$ch){
            $x = Sitemap::where('id', $key)->first()->update([
                'changefreq' => $ch ,
                'priority' => $request['priority'][$key],
            ]);
        }
        return \redirect()->back()->with('success','سایت مپ آپدیت شد.');
    }

}
