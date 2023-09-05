<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionAllRequest extends FormRequest
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
            "section_ids" => ["required", "array", "min:1"],
            "section_ids.*" => ["required", "string", "distinct", "min:1", "exists:sections,id"],
        ];

    }
    public function messages()
    {
        return [
            'section_ids.required' => 'يجب اختيار الاقسام',
            'section_ids.min' => 'يجب اختيار قسم واحد على الاقل',
            'section_ids.*.exists' => 'يجب اختيار قسم موجود من قبل',
        ];
    }
}
