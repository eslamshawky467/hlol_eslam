<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AllCouponsRequest extends FormRequest
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
            "coupons_ids" => ["required", "array", "min:1"],
            "coupons_ids.*" => ["required", "string", "distinct", "min:1", "exists:coupons,id"],
        ];

    }
    public function messages()
    {
        return [
            'coupons_ids.required' => 'يجب اختيار الخصومات',
            'coupons_ids.min' => 'يجب اختيار خصم واحد على الاقل',
            'coupons_ids.*.exists' => 'يجب اختيار خصم موجود من قبل',
        ];
    }
}