<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientAllRequest extends FormRequest
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
            "clients_ids" => ["required", "array", "min:1"],
            "clients_ids.*" => ["required", "string", "distinct", "min:1", "exists:clients,id"],
        ];

    }
    public function messages()
    {
        return [
            'clients_ids.required' => 'يجب اختيار العملاء',
            'clients_ids.min' => 'يجب اختيار عميل واحد على الاقل',
            'clients_ids.*.exists' => 'يجب اختيار عميل موجود من قبل',
        ];
    }
}
