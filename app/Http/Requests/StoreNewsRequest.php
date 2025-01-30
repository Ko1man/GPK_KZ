<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
            'title' => 'required|string',
            'short_description' => 'required|string|max:128',
            'full_description' => 'required|string',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author_id' => 'required|string|exists:authors,id',
        ];
    }
}
