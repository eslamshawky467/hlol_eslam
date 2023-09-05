<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'section_name_ar' => [
                'required',
                'string',
                Rule::unique('section_translations', 'section_name')->where(function ($q) {
                    $q->where('locale', '=', 'ar');
                })->ignore($this->id, 'section_id'),
            ],
            'section_name_en' => [
                'required',
                'string',
                Rule::unique('section_translations', 'section_name')->where(function ($q) {
                    $q->where('locale', '=', 'en');
                })->ignore($this->id, 'section_id'),
            ],
            'section_image' => ['nullable', 'mimes:jpeg,png,jpg'],
            'parent_id' => ['nullable', Rule::exists('sections', 'id')],
        ];
    }
    public function messages()
    {
        return [
            'section_name_ar.required' => 'يجب ادخال اسم القسم باللغه العربيه',
            'section_name_en.required' => 'يجب ادخال اسم القسم باللغه الانجليزيه',
            'parent_id.required' => 'يجب اختيار نوع القسم',
            'section_name_ar.string' => 'يجب ادخال اسم القسم حروف',
            'section_name_en.string' => 'يجب ادخال اسم القسم حروف',
            'section_image.mimes' => 'يجب اختيار نوع الملف صحيح',
            'parent_id.exists' => 'يجب ان يكون نوع القسم موجود',
        ];
    }
}
