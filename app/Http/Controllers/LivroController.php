<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Services\LivroService;
use App\Models\Autor;
use App\Models\Assunto;

class LivroController extends Controller
{
    protected $livroService;

    public function __construct(LivroService $livroService)
    {
        $this->livroService = $livroService;
    }

    public function index()
    {
        $livros = $this->livroService->paginate(10);
        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        $autores = Autor::all();
        $assuntos = Assunto::all();
        return view('livros.create', compact('autores', 'assuntos'));
    }

    public function store(LivroRequest $request)
    {
        $data = $request->validated();
        $this->livroService->create($data, $request->input('autores'), $request->input('assuntos'));
        return redirect()->route('livros.index')->with('success', 'Livro cadastrado com sucesso.');
    }

    public function show($id)
    {
        $livro = $this->livroService->findById($id);
        return view('livros.show', compact('livro'));
    }

    public function edit($id)
    {
        $livro = $this->livroService->findById($id);
        $autores = Autor::all();
        $assuntos = Assunto::all();
        return view('livros.edit', compact('livro', 'autores', 'assuntos'));
    }

    public function update(LivroRequest $request, $id)
    {
        $data = $request->validated();
        $this->livroService->update($data, $id, $request->input('autores'), $request->input('assuntos'));

        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $this->livroService->delete($id);

        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso.');
    }
}
