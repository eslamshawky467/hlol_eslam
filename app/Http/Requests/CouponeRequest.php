<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponeRequest extends FormRequest
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
            'coupon_name' => ['required', 'string', Rule::unique('coupons', 'name')->ignore($this->id)],
            'coupon_amount' => ['required', 'numeric'],
            'coupon_type' => ['required', 'string', 'in:number,percentage'],
            'coupon_start_at' => ['required', /*'date_format:Y-m-d H:i',*/'after_or_equal:' . date(DATE_ATOM)],
            'coupon_end_at' => [
                'required',
                /*'date_format:Y-m-d H:i',*/        'after_or_equal:' . date(DATE_ATOM, time() + (3 * 60 * 60)),
            ],
            'coupon_status' => ['required', 'in:0,1'],
        ];
    }

    public function messages()
    {
        return [
            'coupon_name.required' => 'يجب ادخال اسم الخصم',
            'coupon_name.string' => 'يجب ادخال اسم الخصم نص',
            'coupon_name.unique' => 'يجب ادخال اسم الخصم غير مستخدم من قبل',
            'coupon_amount.required' => 'يجب ادخال قيمه الخصم',
            'coupon_amount.numeric' => 'يجب ادخال قيمه الخصم رقم',
            'coupon_type.required' => 'يجب ادخال نوع الخصم',
            'coupon_type.string' => 'يجب ادخال نوع الخصم نص',
            'coupon_type.in' => 'يجب ادخال نوع الخصم رقم او نسبه مئويه',
            'coupon_start_at.required' => 'يجب ادخال بدايه الخصم',
            'coupon_start_at.date_format' => 'يجب ادخال بدايه الخصم صحيح',
            'coupon_start_at.after_or_equal' => 'بدايه الخصم غير مقبول',
            'coupon_end_at.required' => 'يجب ادخال نهايه الخصم',
            'coupon_end_at.date_format' => 'يجب ادخال نهايه الخصم صحيح',
            'coupon_end_at.after_or_equal' => 'نهايه الخصم غير مقبول',
            'coupon_status.required' => 'يجب ادخال حاله الخصم',
            'coupon_status.in' => 'قيمه حاله الخصم غي مقبوله',
        ];
    }
}