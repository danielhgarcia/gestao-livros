<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Autor;
use App\Services\AutorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Exception;

class AutorServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $autorService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->autorService = $this->app->make(AutorService::class);
    }

    #[Test]
    public function test_it_should_return_all_autores()
    {
        Autor::factory()->count(3)->create();

        $autores = $this->autorService->getAll();

        $this->assertCount(3, $autores);
    }

    #[Test]
    public function test_it_should_create_a_new_autor()
    {
        $data = [
            'codigo' => 123,
            'nome' => 'Autor de Teste',
        ];

        $autor = $this->autorService->create($data);

        $this->assertDatabaseHas('autores', ['codigo' => 123, 'nome' => 'Autor de Teste']);
    }

    #[Test]
    public function test_it_should_update_an_existing_autor()
    {
        $autor = Autor::factory()->create();

        $data = [
            'codigo' => 456,
            'nome' => 'Autor Atualizado',
        ];

        $updatedAutor = $this->autorService->update($data, $autor->id);

        $this->assertDatabaseHas('autores', ['id' => $autor->id, 'codigo' => 456, 'nome' => 'Autor Atualizado']);
    }

    #[Test]
    public function test_it_should_throw_exception_if_autor_not_found_when_updating()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Autor não encontrado para o ID');

        $data = [
            'codigo' => 789,
            'nome' => 'Autor Inexistente',
        ];

        $this->autorService->update($data, 999);
    }

    #[Test]
    public function test_it_should_delete_an_autor()
    {
        $autor = Autor::factory()->create();

        $this->autorService->delete($autor->id);

        $this->assertDatabaseMissing('autores', ['id' => $autor->id]);
    }

    #[Test]
    public function test_it_should_throw_exception_if_autor_not_found_when_deleting()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Autor não encontrado para o ID');

        $this->autorService->delete(999);
    }

    #[Test]
    public function test_it_should_return_autor_by_id()
    {
        $autor = Autor::factory()->create();

        $foundAutor = $this->autorService->findById($autor->id);

        $this->assertEquals($autor->id, $foundAutor->id);
    }

    #[Test]
    public function test_it_should_throw_exception_if_autor_not_found_by_id()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Autor não encontrado para o ID');

        $this->autorService->findById(999);
    }

    #[Test]
    public function test_it_should_paginate_autores()
    {
        Autor::factory()->count(15)->create();

        $paginated = $this->autorService->paginate(10);

        $this->assertCount(10, $paginated);
    }
}
