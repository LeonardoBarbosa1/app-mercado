<?php

namespace App\Http\Requests;

use App\Models\Fair;
use Illuminate\Foundation\Http\FormRequest;

/* @var $fair */
class StoreProductsRequest extends FormRequest
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
        $id = session('id');
        $status = $this->has('status');

        $this->merge([
            'fair_id' => $id,
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
            'status' => 'required|boolean',
            'fair_id' => 'required|integer|exists:fairs,id',
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
            'exists' => 'O valor selecionado para :attribute não é válido.',
        ];
    }
}
