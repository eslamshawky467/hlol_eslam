<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteBannerRequest extends FormRequest
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
            'id'=>['required','exists:banners,id']
        ];
    }
    public function messages(){
        return [
            'id.required'=>'يجب اختيار رقم اللافته',
            'id.exists'=>'يجب اختيار رقم لافته موجود',
        ];
    }
}
