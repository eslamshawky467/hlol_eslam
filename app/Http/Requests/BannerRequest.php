<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'banner_name'=>['required','string'],
            'status'=>['required','in:1,0'],
        ];
    }
    public function messages(){
        return [
            'banner_name.required' =>'يجب ادخال اسم اللافته',
            'banner_name.string' =>'يجب ادخال اسم اللافته نصوص',
            'status.required' =>'يجب ادخال حاله اللافته',
            'status.in' =>' يجب ادخال حاله اللافته ضمن القيمتين 1 او 0',
        ];
    }
}
