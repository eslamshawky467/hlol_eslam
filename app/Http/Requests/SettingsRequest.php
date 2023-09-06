<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingsRequest extends FormRequest
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
            'setting_title_ar' => ['required', 'string'],
            'setting_title_en' => ['required', 'string'],
            'setting_content_ar' => ['required', 'string'],
            'setting_content_en' => ['required', 'string'],
            'setting_id' => ['nullable', 'integer', Rule::exists('settings', 'id')],
            'type' => ['required', 'string', "in:technical,fqa,about-us"],
        ];
    }
}