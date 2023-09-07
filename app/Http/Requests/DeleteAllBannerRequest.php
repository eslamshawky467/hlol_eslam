<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteAllBannerRequest extends FormRequest
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
            "banners_ids" => ["required", "array", "min:1"],
            "banners_ids.*" => ["required", "string", "distinct", "min:1", "exists:banners,id"],
        ];

    }
    public function messages()
    {
        return [
            'banners_ids.required' => 'يجب اختيار اللافتات',
            'banners_ids.min' => 'يجب اختيار لافته واحده على الاقل',
            'banners_ids.*.exists' => 'يجب اختيار لافته موجوده من قبل',
        ];
    }
}
