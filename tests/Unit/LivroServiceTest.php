<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use App\Services\LivroService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Exception;

class LivroServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $livroService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->livroService = $this->app->make(LivroService::class);
    }

    #[Test]
    public function test_it_should_return_all_livros()
    {
        Livro::factory()->has(Autor::factory()->count(3), 'autores')
            ->has(Assunto::factory()->count(3), 'assuntos')
            ->count(3)->create();

        $livros = $this->livroService->getAll();

        $this->assertCount(3, $livros);
        $this->assertTrue($livros->first()->relationLoaded('autores'));
        $this->assertTrue($livros->first()->relationLoaded('assuntos'));
    }

    #[Test]
    public function test_it_should_create_a_new_livro()
    {
        $data = [
            'codigo' => 123,
            'titulo' => 'Livro Teste',
            'editora' => 'Editora Teste',
            'edicao' => 1,
            'ano_publicacao' => 2023,
            'valor' => 100.50
        ];

        $autores = Autor::factory()->count(3)->create()->pluck('id')->toArray();
        $assuntos = Assunto::factory()->count(2)->create()->pluck('id')->toArray();

        $livro = $this->livroService->create($data, $autores, $assuntos);

        $this->assertDatabaseHas('livros', ['codigo' => 123, 'titulo' => 'Livro Teste']);
        $this->assertCount(3, $livro->autores);
        $this->assertCount(2, $livro->assuntos);
    }

    #[Test]
    public function test_it_should_update_an_existing_livro()
    {
        $livro = Livro::factory()->has(Autor::factory()->count(2), 'autores')
            ->has(Assunto::factory()->count(1), 'assuntos')->create();

        $data = [
            'codigo' => 456,
            'titulo' => 'Livro Atualizado',
            'editora' => 'Editora Atualizada',
            'edicao' => 2,
            'ano_publicacao' => 2024,
            'valor' => 150.75
        ];

        $autores = Autor::factory()->count(1)->create()->pluck('id')->toArray();
        $assuntos = Assunto::factory()->count(2)->create()->pluck('id')->toArray();

        $updatedLivro = $this->livroService->update($data, $livro->id, $autores, $assuntos);

        $this->assertDatabaseHas('livros', ['codigo' => 456, 'titulo' => 'Livro Atualizado']);
        $this->assertCount(1, $updatedLivro->autores);
        $this->assertCount(2, $updatedLivro->assuntos);
    }

    #[Test]
    public function test_it_should_throw_exception_if_livro_not_found_when_updating()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Livro não encontrado para o ID');

        $data = [
            'codigo' => 789,
            'titulo' => 'Livro Inexistente',
            'editora' => 'Editora Inexistente',
            'edicao' => 3,
            'ano_publicacao' => 2025,
            'valor' => 200.00
        ];

        $this->livroService->update($data, 999, [], []);
    }

    #[Test]
    public function test_it_should_delete_a_livro()
    {
        $livro = Livro::factory()->create();

        $this->livroService->delete($livro->id);

        $this->assertDatabaseMissing('livros', ['id' => $livro->id]);
    }

    #[Test]
    public function test_it_should_throw_exception_if_livro_not_found_when_deleting()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Livro não encontrado para o ID');

        $this->livroService->delete(999);
    }

    #[Test]
    public function test_it_should_return_livro_by_id()
    {
        $livro = Livro::factory()->has(Autor::factory()->count(2), 'autores')
            ->has(Assunto::factory()->count(1), 'assuntos')->create();


        $foundLivro = $this->livroService->findById($livro->id);


        $this->assertEquals($livro->id, $foundLivro->id);
        $this->assertTrue($foundLivro->relationLoaded('autores'));
        $this->assertTrue($foundLivro->relationLoaded('assuntos'));
    }

    #[Test]
    public function test_it_should_throw_exception_if_livro_not_found_by_id()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Livro não encontrado para o ID');

        $this->livroService->findById(999);
    }

    #[Test]
    public function test_it_should_paginate_livros()
    {
        Livro::factory()->count(15)->create();

        $paginated = $this->livroService->paginate(10);

        $this->assertCount(10, $paginated);
    }
}
