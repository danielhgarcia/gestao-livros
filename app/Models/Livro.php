<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'titulo', 'editora', 'edicao', 'ano_publicacao', 'valor'];

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'livro_autor');
    }

    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'livro_assunto');
    }
}
