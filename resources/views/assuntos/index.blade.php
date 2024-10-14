@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('assuntos.index') }}">Assuntos</a></li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Listagem de Assuntos</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('assuntos.create') }}" class="btn btn-primary">Novo Assunto</a>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assuntos as $assunto)
            <tr>
                <td>{{ $assunto->id }}</td>
                <td>{{ $assunto->codigo }}</td>
                <td>{{ $assunto->descricao }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('assuntos.show', $assunto->id) }}" class="btn btn-info btn-sm">Visualizar</a>
                    <a href="{{ route('assuntos.edit', $assunto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('assuntos.destroy', $assunto->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este assunto?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            <p>
                {!! __('Mostrando') !!} {{ $assuntos->firstItem() }} {!! __('até') !!} {{ $assuntos->lastItem() }} {!! __('de') !!} {{ $assuntos->total() }} {!! __('resultados') !!}
            </p>
        </div>
        <div class="d-flex justify-content-center">
            {{ $assuntos->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
