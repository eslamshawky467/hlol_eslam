<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingAllRequest extends FormRequest
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
            "settings_ids" => ["required", "array", "min:1"],
            "settings_ids.*" => ["required", "string", "distinct", "min:1", "exists:settings,id"],
        ];

    }
    public function messages()
    {
        return [
            'settings_ids.required' => 'يجب اختيار الاسئله',
            'settings_ids.min' => 'يجب اختيار سؤال واحد على الاقل',
            'settings_ids.*.exists' => 'يجب اختيار سؤال موجود من قبل',
        ];
    }
}