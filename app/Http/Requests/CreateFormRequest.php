<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
            'realname' => 'required|min:3|string',
            'phone' => 'required|numeric|min:8',
            'address' => 'required|string|min:20'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được chừa trống',
            'string' => ':attribute phải là một chuỗi kí tự',
            'min' => ':attribute không được ít hơn :min kí tự',
            'max' => ':attribute không được nhiều hơn :max kí tự',
            'numeric' => ':attribute phải là số'
        ];
    }
}
