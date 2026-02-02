<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // title — если присутствует, обязательно и с теми же ограничениями
            'title' => 'sometimes|required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'nullable|in:pending,in_progress,completed',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле "title" обязательно для заполнения.',
            'title.string'   => 'Поле "title" должно быть строкой.',
            'title.max'      => 'Поле "title" не должно превышать 255 символов.',
            'title.min'      => 'Поле "title" должно содержать минимум 3 символа.',
            'description.string' => 'Поле "description" должно быть строкой.',
            'description.max'    => 'Поле "description" не должно превышать 1000 символов.',
            'status.in' => 'Статус должен быть одним из: pending, in_progress, completed.',
        ];
    }

    protected function prepareForValidation()
    {
        // Трим только если поле присутствует (чтобы не превращать отсутствующее поле в null)
        if ($this->has('title')) {
            $title = $this->input('title');
            $this->merge(['title' => is_string($title) ? trim($title) : $title]);
        }

        if ($this->has('description')) {
            $description = $this->input('description');
            $this->merge(['description' => is_string($description) ? trim($description) : $description]);
        }
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => 'ошибка валидации данных',
            'errors'  => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
