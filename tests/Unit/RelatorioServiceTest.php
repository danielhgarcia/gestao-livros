<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Autor;
use App\Models\Assunto;
use App\Services\RelatorioService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Exception;

class RelatorioServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $relatorioService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->relatorioService = $this->app->make(RelatorioService::class);
    }

    #[Test]
    public function test_it_should_return_livros_por_autor()
    {
        $autor = Autor::factory()->hasLivros(2)->create();

        $autores = $this->relatorioService->getLivrosPorAutor();

        $this->assertCount(1, $autores);
        $this->assertCount(2, $autores->first()->livros);
    }

    #[Test]
    public function test_it_should_throw_exception_if_no_autores_with_livros_found()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Nenhum autor com livros encontrado.');

        $this->relatorioService->getLivrosPorAutor();
    }

    #[Test]
    public function test_it_should_return_livros_por_assunto()
    {
        $assunto = Assunto::factory()->hasLivros(2)->create();

        $assuntos = $this->relatorioService->getLivrosPorAssunto();

        $this->assertCount(1, $assuntos);
        $this->assertCount(2, $assuntos->first()->livros);
    }

    #[Test]
    public function test_it_should_throw_exception_if_no_assuntos_with_livros_found()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Nenhum assunto com livros encontrado.');

        $this->relatorioService->getLivrosPorAssunto();
    }
}
