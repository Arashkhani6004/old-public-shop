<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                    'url'=>'required'
                ];
                break;
            case 'edit' :
                return [
                   'title'=>'required',
                    'url'=>'required',
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
            'title.required' => 'نام اجباری است',
            'url.required' => 'url اجباری است',
        ];
    }
}
