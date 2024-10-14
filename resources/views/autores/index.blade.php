@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('autores.index') }}">Autores</a></li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container mt-4">
    <h2>Listagem de Autores</h2>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('autores.create') }}" class="btn btn-primary mb-3">Novo Autor</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($autores as $autor)
            <tr>
                <td>{{ $autor->id }}</td>
                <td>{{ $autor->codigo }}</td>
                <td>{{ $autor->nome }}</td>
                <td>
                    <a href="{{ route('autores.show', $autor->id) }}" class="btn btn-info btn-sm">Visualizar</a>
                    <a href="{{ route('autores.edit', $autor->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('autores.destroy', $autor->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este autor?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            <p>
                {!! __('Mostrando') !!} {{ $autores->firstItem() }} {!! __('até') !!} {{ $autores->lastItem() }} {!! __('de') !!} {{ $autores->total() }} {!! __('resultados') !!}
            </p>
        </div>
        <div class="d-flex justify-content-center">
            {{ $autores->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
