<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchedulesRequest extends FormRequest
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
            'course_id' => 'required|exists:courses,id',
            'group_id' => 'required|exists:groups,id',
            'user_id' => 'required|exists:users,id',
            'start_time' => 'required|date_format:H:i|after_or_equal:08:00|before_or_equal:20:00',
            'end_time' => 'required|date_format:H:i|after:start_time|before_or_equal:20:00',
            'class_room' => 'required|string|regex:/^[A-Za-z0-9-]+$/|max:10',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        ];
    }
}
