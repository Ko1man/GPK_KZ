<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string',
            'last_name'=>'required|string',
            'second_name'=>'required|string',
            'date_of_admission'=>'required|string',
            'date_of_birth'=>'required|string',
            'group_id'=>'required|string',
            'address'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'phone'=>'required|string|max:11|unique:users',
            'password'=>'required|string|confirmed|min:6',
            'role'=>'string'
        ];
    }
}
