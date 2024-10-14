<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssuntoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('assunto') ?: null;

        return [
            'codigo' => [
                'required',
                'integer',
                'unique:assuntos,codigo,' . $id,
            ],
            'descricao' => 'required|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.required' => 'O código é obrigatório.',
            'codigo.integer' => 'O código deve ser um número inteiro.',
            'descricao.required' => 'A descrição é obrigatória.',
            'descricao.string' => 'A descrição deve ser um texto.',
            'descricao.max' => 'A descrição não pode ter mais de 20 caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'codigo' => 'código',
            'descricao' => 'descrição',
        ];
    }
}
