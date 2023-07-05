<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => 'required|min:3|max:50',
            'description' => 'nullable|max:255',
            'status' => 'required|in:В процессе,Выполнена',
            'images' => 'nullable|images|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required_without_all:tag1,tag2,tag3|min:1|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле "Название" не должно быть пустым',
            'title.min' => 'Название должно быть не менее :min символов',
            'title.max' => 'Название должно быть не более :max символов',
            'description.required' => 'Поле "Описание" не должно быть пустым',
            'description.min' => 'Описание должно быть не менее :min символов',
            'description.max' => 'Описание должно быть не более :max символов',
            'status.required' => 'Пожалуйста, выберите статус задачи',
            'status.in' => 'Поле "Статус" имеет неверное значение',
            'images.images' => 'Файл должен быть изображением',
            'images.mimes' => 'Файл должен быть в формате jpeg, png, jpg или gif',
            'images.max' => 'Размер файла не должен превышать :max Кб',
            'tags.max' => 'Максимальная длина тега :max символов',
            'tags.required' => 'Поле "Тег" не должно быть пустым',
        ];
    }
}
