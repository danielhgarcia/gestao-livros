<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Assunto;
use App\Services\AssuntoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Exception;

class AssuntoServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $assuntoService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->assuntoService = $this->app->make(AssuntoService::class);
    }

    #[Test]
    public function test_it_should_return_all_assuntos()
    {
        Assunto::factory()->count(3)->create();
        $assuntos = $this->assuntoService->getAll();
        $this->assertCount(3, $assuntos);
    }

    #[Test]
    public function test_it_should_create_a_new_assunto()
    {
        $data = ['codigo' => 123, 'descricao' => 'Assunto de Teste'];
        $assunto = $this->assuntoService->create($data);
        $this->assertDatabaseHas('assuntos', ['codigo' => 123, 'descricao' => 'Assunto de Teste']);
    }

    #[Test]
    public function test_it_should_update_an_existing_assunto()
    {
        $assunto = Assunto::factory()->create();
        $data = ['codigo' => 456, 'descricao' => 'Assunto Atualizado'];
        $updatedAssunto = $this->assuntoService->update($data, $assunto->id);
        $this->assertDatabaseHas('assuntos', ['id' => $assunto->id, 'codigo' => 456, 'descricao' => 'Assunto Atualizado']);
    }

    #[Test]
    public function test_it_should_throw_exception_if_assunto_not_found_when_updating()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Assunto não encontrado para o ID');
        $data = ['codigo' => 789, 'descricao' => 'Assunto Inexistente'];
        $this->assuntoService->update($data, 999);
    }

    #[Test]
    public function test_it_should_delete_an_assunto()
    {
        $assunto = Assunto::factory()->create();
        $this->assuntoService->delete($assunto->id);
        $this->assertDatabaseMissing('assuntos', ['id' => $assunto->id]);
    }

    #[Test]
    public function test_it_should_throw_exception_if_assunto_not_found_when_deleting()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Assunto não encontrado para o ID');
        $this->assuntoService->delete(999);
    }

    #[Test]
    public function test_it_should_return_assunto_by_id()
    {
        $assunto = Assunto::factory()->create();
        $foundAssunto = $this->assuntoService->findById($assunto->id);
        $this->assertEquals($assunto->id, $foundAssunto->id);
    }

    #[Test]
    public function test_it_should_throw_exception_if_assunto_not_found_by_id()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Assunto não encontrado para o ID');
        $this->assuntoService->findById(999);
    }

    #[Test]
    public function test_it_should_paginate_assuntos()
    {
        Assunto::factory()->count(15)->create();
        $paginated = $this->assuntoService->paginate(10);
        $this->assertCount(10, $paginated);
    }
}
