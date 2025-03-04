<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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
            'name'=>'string',
            'last_name'=>'string',
            'second_name'=>'string',
            'date_of_admission'=>'date',
            'date_of_birth'=>'date',
            'group_id'=>'integer|exists:groups,id',
            'address'=>'string',
            'email'=>'string|email|unique:users',
            'phone'=>'string|max:11|unique:users',
            'password'=>'string|confirmed|min:6',
            'role'=>'string'
        ];
    }
}
