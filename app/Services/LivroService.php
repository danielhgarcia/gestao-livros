<?php

namespace App\Services;

use App\Models\Livro;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Exception;

class LivroService
{
    public function getAll()
    {
        try {
            return Livro::with(['autores', 'assuntos'])->get();
        } catch (QueryException $e) {
            throw new Exception('Erro ao buscar os livros: ' . $e->getMessage());
        }
    }

    public function create(array $data, array $autores, array $assuntos): Livro
    {
        try {
            $livro = Livro::create($data);
            $livro->autores()->sync($autores);
            $livro->assuntos()->sync($assuntos);

            return $livro;
        } catch (QueryException $e) {
            throw new Exception('Erro ao criar o livro: ' . $e->getMessage());
        }
    }

    public function update(array $data, int $id, array $autores, array $assuntos): Livro
    {
        try {
            $livro = Livro::findOrFail($id);
            $livro->update($data);
            $livro->autores()->sync($autores);
            $livro->assuntos()->sync($assuntos);

            return $livro;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Livro não encontrado para o ID: ' . $id);
        } catch (QueryException $e) {
            throw new Exception('Erro ao atualizar o livro: ' . $e->getMessage());
        }
    }

    public function delete(int $id): void
    {
        try {
            $livro = Livro::findOrFail($id);
            $livro->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Livro não encontrado para o ID: ' . $id);
        } catch (QueryException $e) {
            throw new Exception('Erro ao excluir o livro: ' . $e->getMessage());
        }
    }

    public function findById(int $id): Livro
    {
        try {
            return Livro::with(['autores', 'assuntos'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Livro não encontrado para o ID: ' . $id);
        }
    }

    public function paginate($perPage = 10)
    {
        try {
            return Livro::paginate($perPage);
        } catch (QueryException $e) {
            throw new Exception('Erro ao paginar os livros: ' . $e->getMessage());
        }
    }
}
