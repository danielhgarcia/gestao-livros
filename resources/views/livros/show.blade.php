@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('livros.index') }}">Livros</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $livro->titulo }}</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container mt-4">
    <h2>Detalhes do Livro</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Código: {{ $livro->codigo }}</h5>
            <h5 class="card-title">Título: {{ $livro->titulo }}</h5>
            <p class="card-text">Editora: {{ $livro->editora }}</p>
            <p class="card-text">Edição: {{ $livro->edicao }}</p>
            <p class="card-text">Ano de Publicação: {{ $livro->ano_publicacao }}</p>
            <p class="card-text">Valor: R$ {{ number_format($livro->valor, 2, ',', '.') }}</p>

            <h5>Autores</h5>
            <ul>
                @foreach($livro->autores as $autor)
                    <li>{{ $autor->nome }}</li>
                @endforeach
            </ul>

            <h5>Assuntos</h5>
            <ul>
                @foreach($livro->assuntos as $assunto)
                    <li>{{ $assunto->descricao }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <a href="{{ route('livros.index') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>
@endsection
