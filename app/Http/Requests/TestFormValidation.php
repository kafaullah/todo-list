<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestFormValidation extends FormRequest
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
            'name' => 'required|alpha',
            'address' => 'required',
            'address2' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute field must be filled',
            'address.required' => ':attribute field can not left blank'
        ];
    }
}
