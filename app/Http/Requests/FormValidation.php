<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormValidation extends FormRequest
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address2' => 'required|string|max:255',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'The :attribute field can not be left blank',
            'address.required' => ':attribute field must be filled',
        ];
    }
}
