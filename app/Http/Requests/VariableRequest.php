<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function PHPUnit\Framework\returnSelf;

class VariableRequest extends FormRequest
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
        switch ($this->segment(3)){
            
            case 'variables':
                return[
                    'title' =>'required',
                    'stock'=>'required|numeric',
                    'price' => 'required|numeric',
                    // 'discounted_price' =>'numeric',
                ];
        }
    }

    public function messages()
    {
        return[
            'title.required' => 'وارد کردن عنوان اجباری است',
            'stock.required' => 'وارد کردن موجودی اجباری است',
            'stock.numeric' => 'موجودی باید عدد باشد',
            'price.required' => 'وارد کردن مقدار قیمت اجباری است',
            'price.numeric' => 'قیمت باید عدد باشد ',
            // 'discounted_price.numeric' => 'قیمت بعد تخفیف باید عدد باشد',
        ];
    }
}
