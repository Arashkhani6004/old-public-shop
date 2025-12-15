<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_1' => 'required|min:3',
            'title_2' => 'required|min:3',
            'title_3' => 'required|min:3',

        ];
    }
    public function messages()
    {
        return [
            'title_1.required' => '  عنوان 1 اجباری است',
            'title_2.required' => ' عنوان 2 اجباری است',
            'title_3.required' => ' عنوان 3 اجباری است',
        ];
    }
}
