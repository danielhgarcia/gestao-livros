<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssuntoRequest;
use App\Services\AssuntoService;
use Illuminate\Http\Request;

class AssuntoController extends Controller
{
    protected $assuntoService;

    public function __construct(AssuntoService $assuntoService)
    {
        $this->assuntoService = $assuntoService;
    }

    public function index()
    {
        $assuntos = $this->assuntoService->paginate(10);
        return view('assuntos.index', compact('assuntos'));
    }

    public function create()
    {
        return view('assuntos.create');
    }

    public function store(AssuntoRequest $request)
    {
        $data = $request->validated();
        $this->assuntoService->create($data);

        return redirect()->route('assuntos.index')->with('success', 'Assunto cadastrado com sucesso.');
    }

    public function show($id)
    {
        $assunto = $this->assuntoService->findById($id);
        return view('assuntos.show', compact('assunto'));
    }

    public function edit($id)
    {
        $assunto = $this->assuntoService->findById($id);
        return view('assuntos.edit', compact('assunto'));
    }

    public function update(AssuntoRequest $request, $id)
    {
        $data = $request->validated();
        $this->assuntoService->update($data, $id);

        return redirect()->route('assuntos.index')->with('success', 'Assunto atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $this->assuntoService->delete($id);

        return redirect()->route('assuntos.index')->with('success', 'Assunto excluído com sucesso.');
    }
}
