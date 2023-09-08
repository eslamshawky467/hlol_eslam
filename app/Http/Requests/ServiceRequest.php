<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'service_name_ar' => ['required', 'string'],
            'service_name_en' => ['required', 'string'],
            'section_id' => ['required', "exists:sections,id"],
            'status' => ['required', 'in:1,0'],
        ];
    }
    public function messages()
    {
        return [
            'service_name_ar.required' => 'يجب ادخال اسم الخدمه',
            'service_name_ar.string' => 'يجب ادخال اسم الخدمه نصوص',
            'service_name_en.required' => 'يجب ادخال اسم الخدمه',
            'service_name_en.string' => 'يجب ادخال اسم الخدمه نصوص',
            'section_id.required' => 'يجب ادخال رقم قسم الخدمه',
            'section_id.exists' => ' يجب ان يكون رقم قسم الخدمه موجود',
            'status.required' => 'يجب ادخال حاله اللافته',
            'status.in' => ' يجب ادخال حاله اللافته ضمن القيمتين 1 او 0',
        ];
    }
}
