<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('livro') ?: null;

        return [
            'codigo' => [
                'required',
                'integer',
                'unique:livros,codigo,' . $id,
            ],
            'titulo' => 'required|string|max:40',
            'editora' => 'required|string|max:40',
            'edicao' => 'integer|nullable',
            'ano_publicacao' => 'required|integer|digits:4|min:1000|max:' . date('Y'),
            'autores' => 'required|array',
            'autores.*' => 'exists:autores,id',
            'assuntos' => 'required|array',
            'assuntos.*' => 'exists:assuntos,id',
            'valor' => 'required|numeric|between:0,999999.99',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.required' => 'O código é obrigatório.',
            'codigo.integer' => 'O código deve ser um número inteiro.',
            'titulo.required' => 'O título é obrigatório.',
            'titulo.string' => 'O título deve ser um texto.',
            'titulo.max' => 'O título não pode ter mais de 40 caracteres.',
            'autores.required' => 'Pelo menos um autor deve ser selecionado.',
            'autores.array' => 'O campo autores deve ser uma lista de autores.',
            'autores.*.exists' => 'O autor selecionado não existe.',
            'assuntos.required' => 'Pelo menos um assunto deve ser selecionado.',
            'assuntos.array' => 'O campo assuntos deve ser uma lista de assuntos.',
            'assuntos.*.exists' => 'O assunto selecionado não existe.',
            'ano_publicacao.digits' => 'O ano de publicação deve ter 4 dígitos.',
            'ano_publicacao.min' => 'O ano de publicação deve ser um ano válido.',
            'ano_publicacao.max' => 'O ano de publicação não pode ser maior que o ano atual.',
            'valor.required' => 'O campo valor é obrigatório.',
            'valor.numeric' => 'O valor deve ser um número.',
        ];
    }

    public function attributes(): array
    {
        return [
            'codigo' => 'código',
            'titulo' => 'título',
            'editora' => 'editora',
            'edicao' => 'edição',
            'ano_publicacao' => 'ano de publicação',
            'valor' => 'valor',
            'autores' => 'autores',
            'assuntos' => 'assuntos',
        ];
    }
}
