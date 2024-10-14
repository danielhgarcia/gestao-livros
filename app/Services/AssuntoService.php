<?php

namespace App\Services;

use App\Models\Assunto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Exception;

class AssuntoService
{
    public function getAll(): Collection
    {
        try {
            return Assunto::all();
        } catch (QueryException $e) {
            throw new Exception('Erro ao buscar os assuntos: ' . $e->getMessage());
        }
    }

    public function create(array $data): Assunto
    {
        try {
            return Assunto::create($data);
        } catch (QueryException $e) {
            throw new Exception('Erro ao criar o assunto: ' . $e->getMessage());
        }
    }

    public function update(array $data, int $id): Assunto
    {
        try {
            $assunto = Assunto::findOrFail($id);
            $assunto->update($data);
            return $assunto;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Assunto não encontrado para o ID: ' . $id);
        } catch (QueryException $e) {
            throw new Exception('Erro ao atualizar o assunto: ' . $e->getMessage());
        }
    }

    public function delete(int $id): void
    {
        try {
            $assunto = Assunto::findOrFail($id);
            $assunto->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Assunto não encontrado para o ID: ' . $id);
        } catch (QueryException $e) {
            throw new Exception('Erro ao excluir o assunto: ' . $e->getMessage());
        }
    }

    public function findById(int $id): Assunto
    {
        try {
            return Assunto::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Assunto não encontrado para o ID: ' . $id);
        }
    }

    public function paginate($perPage = 10)
    {
        try {
            return Assunto::paginate($perPage);
        } catch (QueryException $e) {
            throw new Exception('Erro ao paginar os assuntos: ' . $e->getMessage());
        }
    }
}
