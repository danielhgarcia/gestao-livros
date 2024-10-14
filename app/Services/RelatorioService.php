<?php

namespace App\Services;

use App\Models\Autor;
use App\Models\Assunto;
use Illuminate\Database\QueryException;
use Exception;

class RelatorioService
{
    public function getLivrosPorAutor()
    {
        try {
            $autores = Autor::with('livros')->get();
            
            if ($autores->isEmpty()) {
                throw new Exception('Nenhum autor com livros encontrado.');
            }

            return $autores;
        } catch (QueryException $e) {
            throw new Exception('Erro ao buscar livros por autor: ' . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getLivrosPorAssunto()
    {
        try {
            $assuntos = Assunto::with('livros')->get();
            
            if ($assuntos->isEmpty()) {
                throw new Exception('Nenhum assunto com livros encontrado.');
            }

            return $assuntos;
        } catch (QueryException $e) {
            throw new Exception('Erro ao buscar livros por assunto: ' . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
