<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FQARequest extends FormRequest
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
            'setting_id' => ['required', Rule::exists('settings', 'id')],
        ];
    }
    public function messages()
    {
        return [
            'setting_id.required' => 'يجب اختيار رقم العنصر',
            'setting_id.exists' => 'يجب ان تختار رقم صحيح',
        ];
    }
}