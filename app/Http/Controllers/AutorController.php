<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorRequest;
use App\Services\AutorService;

class AutorController extends Controller
{
    protected $autorService;

    public function __construct(AutorService $autorService)
    {
        $this->autorService = $autorService;
    }

    public function index()
    {
        $autores = $this->autorService->paginate(10);
        return view('autores.index', compact('autores'));
    }

    public function create()
    {
        return view('autores.create');
    }

    public function store(AutorRequest $request)
    {
        $data = $request->validated();
        $this->autorService->create($data);

        return redirect()->route('autores.index')->with('success', 'Autor cadastrado com sucesso.');
    }

    public function show($id)
    {
        $autor = $this->autorService->findById($id);
        return view('autores.show', compact('autor'));
    }

    public function edit($id)
    {
        $autor = $this->autorService->findById($id);
        return view('autores.edit', compact('autor'));
    }

    public function update(AutorRequest $request, $id)
    {
        $data = $request->validated();
        $this->autorService->update($data, $id);

        return redirect()->route('autores.index')->with('success', 'Autor atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $this->autorService->delete($id);

        return redirect()->route('autores.index')->with('success', 'Autor excluído com sucesso.');
    }
}
