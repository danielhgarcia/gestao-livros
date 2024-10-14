<?php

namespace App\Http\Controllers;

use App\Services\RelatorioService;
use PDF;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    protected $relatorioService;

    public function __construct(RelatorioService $relatorioService)
    {
        $this->relatorioService = $relatorioService;
    }

    public function relatorioPorAutor()
    {
        $autores = $this->relatorioService->getLivrosPorAutor();
        return view('relatorios.livros_por_autor', compact('autores'));
    }

    public function relatorioPorAutorPdf()
    {
        try {
            $dados = DB::table('view_livros_por_autor')->get();
            $pdf = PDF::loadView('relatorios.livros_por_autor_pdf', compact('dados'));
            return $pdf->download('relatorio_livros_por_autor.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao gerar o relatório. Por favor, tente novamente.');
        }
    }
    
    public function relatorioPorAssunto()
    {
        $assuntos = $this->relatorioService->getLivrosPorAssunto();
        return view('relatorios.livros_por_assunto', compact('assuntos'));
    }

    public function relatorioPorAssuntoPdf()
    {
        try {
            $dados = DB::table('view_livros_por_assunto')->get();
            $pdf = PDF::loadView('relatorios.livros_por_assunto_pdf', compact('dados'));
            return $pdf->download('relatorio_livros_por_assunto.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao gerar o relatório. Por favor, tente novamente.');
        }
    }
}
