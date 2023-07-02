<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|max:60|email|unique:users',
            'password' => 'required|string|min:6|max:60',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'email.unique' => 'The user with the specified email address is already registered',
        ];
    }
}
