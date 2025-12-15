<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
                    'image'=>'required',


                ];
                break;
            case 'edit' :
                return [
//                    'title'=>'required',
//                    'description'=>'required',

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
            'image.required' => 'وارد کردن تصویر اجباری است',
      

        ];
    }
}
