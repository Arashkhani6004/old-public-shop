<?php

namespace App\Http\Controllers\Help;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function getIndex()
    {

        return view('help.index');
    }
    public function brandList()
    {


        return view('help.brand.list');
    }
    public function brandDetail()
    {

        return view('help.brand.details');
    }

    public function list()
    {


        return view('help.product-list.index');
    }

    public function detail()
    {

        return view('help.product-detail.index');
    }

    public function getAbout()
    {

        return view('help.us.aboutus');


    }
    public function getRules()
    {

        return view('help.us.rules');


    }
    public function getFaq()
    {

        return view('help.us.faq');


    }
    public static function is_english($str)
    {
        if (strlen($str) != strlen(utf8_decode($str))) {
            return false;
        } else {
            return true;
        }
    }

    public function blogCat()
    {
        return view('help.blog-category.index');

    }
    public function blogList()
    {
        return view('help.blog-list.index');

    }
    public function blogDetail()
    {
        return view('help.blog-detail.index');

    }
    public function pageDetail()
    {
        return view('help.page.details');

    }
    public function getContact()
    {

        return view('help.us.contactus');
    }
}
