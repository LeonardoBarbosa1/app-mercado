<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFairRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'date_fair' => 'required|date',
            'status' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :Attribute é obrigatório.',
            'max' => 'O campo :Attribute deve ter no máximo :max caracteres.',
            'string' => 'O campo :Attribute deve ser uma string.',
            'date' => 'O campo :Attribute deve ser uma data válida.'
        ];
    }
}
