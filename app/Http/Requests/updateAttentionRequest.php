<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateAttentionRequest extends FormRequest
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
            'attention' => 'boolean',
            'date' => 'date',
            'user_id' => 'integer|exists:users,id',
            'group_id' => 'integer|exists:groups,id'
        ];
    }
}
