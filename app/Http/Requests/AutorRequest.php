<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('autor') ?: null;

        return [
            'codigo' => [
                'required',
                'integer',
                'unique:autores,codigo,' . $id,
            ],
            'nome' => 'required|string|max:40',            
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.required' => 'O código é obrigatório.',
            'codigo.integer' => 'O código deve ser um número inteiro.',
            'nome.required' => 'O nome é obrigatório.',
            'nome.string' => 'O nome deve ser um texto.',
            'nome.max' => 'O nome não pode ter mais de 40 caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'codigo' => 'código',
            'nome' => 'nome',
        ];
    }
}
