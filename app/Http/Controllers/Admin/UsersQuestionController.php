<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UsersQuestionController extends Controller
{
    public function getList()
    {
        $questions = Question::with('product')->orderBy('id', 'DESC')->whereNull('answer')->get();
         return view('admin.users-question.index',compact('questions'));
    }
    public function getAdd(Request $request, $id)
    {
        $data = Question::find($id);
        return view('admin.users-question.answer', compact('data'));
    }
    public function postAdd(Request $request, $id)
    {
        $input = $request->all();
        $question = Question::find($id);
        $question->update($input);
        return Redirect::action('Admin\UsersQuestionController@getList')->with('success', 'آیتم موردنظر با موفقیت ثبت شد.');
    }
}
