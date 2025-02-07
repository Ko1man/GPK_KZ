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
            'name' => 'nullable|string',
            'phone' => 'nullable|string|max:11',
            'email' => 'nullable|string|email|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'profile_image' => 'nullable|mimes:jpeg,jpg,png|max:2048',
        ];
    }
}
