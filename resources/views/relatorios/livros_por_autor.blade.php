@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Relatório de Livros por Autor</h2>

    <div class="text-right mb-3">
        <a href="{{ route('livros.relatorioPorAutorPdf') }}" class="btn btn-danger">
            Gerar Relatório em PDF
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif

    @foreach($autores as $autor)
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                Autor: {{ $autor->nome }}
            </div>
            <div class="card-body">
                @if($autor->livros->isEmpty())
                    <p>Nenhum livro cadastrado para este autor.</p>
                @else
                    <ul>
                        @foreach($autor->livros as $livro)
                            <li>{{ $livro->titulo }} ({{ $livro->ano_publicacao }})</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endforeach
</div>

@endsection
