<?php

namespace App\Services;

use App\Models\Autor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class AutorService
{
    public function getAll(): Collection
    {
        try {
            return Autor::all();
        } catch (QueryException $e) {
            throw new Exception('Erro ao buscar os autores: ' . $e->getMessage());
        }
    }

    public function create(array $data): Autor
    {
        try {
            return Autor::create($data);
        } catch (QueryException $e) {
            throw new Exception('Erro ao criar o autor: ' . $e->getMessage());
        }
    }

    public function update(array $data, int $id): Autor
    {
        try {
            $autor = Autor::findOrFail($id);
            $autor->update($data);
            return $autor;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Autor não encontrado para o ID: ' . $id);
        } catch (QueryException $e) {
            throw new Exception('Erro ao atualizar o autor: ' . $e->getMessage());
        }
    }

    public function delete(int $id): void
    {
        try {
            $autor = Autor::findOrFail($id);
            $autor->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Autor não encontrado para o ID: ' . $id);
        } catch (QueryException $e) {
            throw new Exception('Erro ao excluir o autor: ' . $e->getMessage());
        }
    }

    public function findById(int $id): Autor
    {
        try {
            return Autor::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Autor não encontrado para o ID: ' . $id);
        }
    }

    public function paginate($perPage = 10)
    {
        try {
            return Autor::paginate($perPage);
        } catch (QueryException $e) {
            throw new Exception('Erro ao paginar os autores: ' . $e->getMessage());
        }
    }
}
