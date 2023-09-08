<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteServiceRequest extends FormRequest
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
            'id' => ['required', 'exists:services,id']
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'يجب اختيار رقم الخدمه',
            'id.exists' => 'يجب اختيار رقم خدمه موجود',
        ];
    }
}
