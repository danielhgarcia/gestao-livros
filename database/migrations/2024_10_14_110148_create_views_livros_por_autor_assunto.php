<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateViewsLivrosPorAutorAssunto extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE VIEW `view_livros_por_assunto` AS
            SELECT
                livros.id AS livro_id,
                livros.titulo AS titulo,
                livros.editora AS editora,
                livros.ano_publicacao AS ano_publicacao,
                assuntos.descricao AS assunto_descricao,
                autores.nome AS autor_nome
            FROM
                livros
            JOIN
                livro_assunto ON livros.id = livro_assunto.livro_id
            JOIN
                assuntos ON assuntos.id = livro_assunto.assunto_id
            JOIN
                livro_autor ON livros.id = livro_autor.livro_id
            JOIN
                autores ON autores.id = livro_autor.autor_id
            ORDER BY
                assuntos.descricao;
        ");

        DB::statement("
            CREATE VIEW `view_livros_por_autor` AS
            SELECT
                livros.id AS livro_id,
                livros.titulo AS titulo,
                livros.editora AS editora,
                livros.ano_publicacao AS ano_publicacao,
                autores.nome AS autor_nome,
                assuntos.descricao AS assunto_descricao
            FROM
                livros
            JOIN
                livro_autor ON livros.id = livro_autor.livro_id
            JOIN
                autores ON autores.id = livro_autor.autor_id
            JOIN
                livro_assunto ON livros.id = livro_assunto.livro_id
            JOIN
                assuntos ON assuntos.id = livro_assunto.assunto_id
            ORDER BY
                autores.nome;
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `view_livros_por_assunto`");
        DB::statement("DROP VIEW IF EXISTS `view_livros_por_autor`");
    }
}

