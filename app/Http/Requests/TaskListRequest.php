<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskListRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле "Название" не должно быть пустым',
            'title.min' => 'Название должно быть не менее :min символов',
            'title.max' => 'Название должно быть не более :max символов',
        ];
    }
}
