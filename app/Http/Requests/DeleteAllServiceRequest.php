<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteAllServiceRequest extends FormRequest
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
            "services_ids" => ["required", "array", "min:1"],
            "services_ids.*" => ["required", "string", "distinct", "min:1", "exists:services,id"],
        ];

    }
    public function messages()
    {
        return [
            'services_ids.required' => 'يجب اختيار اللافتات',
            'services_ids.min' => 'يجب اختيار لافته واحده على الاقل',
            'services_ids.*.exists' => 'يجب اختيار لافته موجوده من قبل',
        ];
    }
}
