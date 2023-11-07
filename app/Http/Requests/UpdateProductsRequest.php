<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $status = $this->has('status');

        $this->merge([
            'status' => $status,
        ]);
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
            'brand' => 'required|string|max:100',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
            'string' => 'O campo :attribute deve ser uma string.',
            'integer' => 'O campo :attribute deve ser um número inteiro.',
            'numeric' => 'O campo :attribute deve ser um número.',
            'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
        ];
    }
}
