@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Livros</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container mt-4">
    <h2>Listagem de Livros</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('livros.create') }}" class="btn btn-primary mb-3">Novo Livro</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Título</th>
                <th>Editora</th>
                <th>Ano Publicação</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($livros as $livro)
            <tr>
                <td>{{ $livro->id }}</td>
                <td>{{ $livro->codigo }}</td>
                <td>{{ $livro->titulo }}</td>
                <td>{{ $livro->editora }}</td>
                <td>{{ $livro->ano_publicacao }}</td>
                <td>R$ {{ number_format($livro->valor, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('livros.show', $livro->id) }}" class="btn btn-info btn-sm">Visualizar</a>
                    <a href="{{ route('livros.edit', $livro->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            <p>
                {!! __('Mostrando') !!} {{ $livros->firstItem() }} {!! __('até') !!} {{ $livros->lastItem() }} {!! __('de') !!} {{ $livros->total() }} {!! __('resultados') !!}
            </p>
        </div>
        <div class="d-flex justify-content-center">
            {{ $livros->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
