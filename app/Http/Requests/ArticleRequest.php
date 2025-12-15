<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        switch ($this->segment(3)){
            case 'add' :
                return[
                    'title'=>'required',
                ];
                break;
            case 'edit' :
                return [
                    'title'=>'required',
                ];
                break;
            case 'delete' :
                return [
                    'deleteId' => 'required',
                ];
                break;
            case 'sort':
                return [
                    'update' => 'required',
                ];
                break;
        }
    }
    public function messages()
    {
        return [
            'title.required' => 'وارد کردن عنوان اجباری است',
        ];
    }
}
