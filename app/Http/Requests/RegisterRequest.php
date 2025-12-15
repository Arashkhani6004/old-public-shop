<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:3',
            'mobile' => 'unique:users|digits:11',
//            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            're-password'=>'required|same:password',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => '🔴  نام اجباری است',
//            'mobile.required' => '🔴 تلفن اجباری است',
//            'password.required' => '🔴 رمز ورود اجباری است',
            'mobile.unique' => '🔴 تلفن تکراری است   ',
        ];
    }
}
