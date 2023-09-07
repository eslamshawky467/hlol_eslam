<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteRequest extends FormRequest
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
            'id' => ['required', Rule::exists('sections', 'id')],
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'يجب اختيار رقم العنصر',
            'id.exists' => 'يجب ان تختار رقم صحيح',
        ];
    }
}
