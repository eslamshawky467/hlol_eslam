<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCouponRequest extends FormRequest
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
            'id' => ['required', 'exists:coupons,id']
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'يجب اختيار رقم الخصم',
            'id.exists' => 'يجب اختيار رقم خصم موجود',
        ];
    }
}
