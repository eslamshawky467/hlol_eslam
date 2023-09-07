<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
            'client_name' => ['required', 'string'],
            'device_token' => ['required', 'string', Rule::unique('clients', 'device_token')->ignore($this->id)],
            'email' => ['required', 'email', Rule::unique('clients', 'email')->ignore($this->id)],
            'client_phone_number' => ['required', 'numeric', Rule::unique('clients', 'phone_number')->ignore($this->id)],
            'gender' => ['required', 'string', 'in:male,female'],
            'is_registered' => ['required', 'in:0,1'],
            'status' => ['required', 'string', 'in:active,inactive'],
        ];
    }

    public function messages()
    {

        return [
            'client_name.required' => 'يجب ادخال اسم العميل',
            'client_name.string' => 'اسم العميل يجب ان يكون نص',
            'device_token.required' => 'توكن الجهاز مطلوبه',
            'device_token.string' => 'توكن الجهاز يجب ان تكون نص',
            'device_token.unique' => 'توكن الجهاز يجب ان تكون غير مستخدمه من قبل',
            'email.required' => 'يجب ادخال البريد الالكترونى',
            'email.email' => 'يجب ادخال صيعه البريد الالكترونى صحيحه',
            'email.unique' => 'يجب ان يكون البريد الالكترونى غير مستخدم من قبل',
            'client_phone_number.required' => 'يجب ادخال رقم الهاتف',
            'client_phone_number.unique' => 'يجب ان يكون رقم الهاتف غير مكرر',
            'client_phone_number.numeric' => 'يجب ان يكون رقم الهاتف رقما',
            'gender.required' => 'يجب ادخال الجنس',
            'gender.string' => 'يجب ان يكون الجنس نصا',
            'gender.in' => 'يجب ان يكون الجنس بين ذكر او انثى فقط',
            'status.required' => 'يجب ادخال الحاله',
            'status.string' => 'يجب ان تكون الحاله نصا',
            'status.in' => 'يجن ان تكون الحاله ما بين مفعل او غير مفعل',
            'is_registered.in' => 'يجب ان تكون حاله التسجيل ما بين مسجل او غير مسجل',
            'is_registered.required' => 'يجب ادخال حاله التسجيل',
        ];
    }
}
