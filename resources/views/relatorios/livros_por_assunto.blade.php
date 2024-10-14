@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Relatório de Livros por Assunto</h2>

    <a href="{{ route('livros.relatorioPorAssuntoPdf') }}" class="btn btn-danger">
        Gerar Relatório de Livros por Assunto em PDF
    </a>

    @if(session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif

    @foreach($assuntos as $assunto)
        <div class="card mt-3">
            <div class="card-header bg-success text-white">
                Assunto: {{ $assunto->descricao }}
            </div>
            <div class="card-body">
                @if($assunto->livros->isEmpty())
                    <p>Nenhum livro cadastrado para este assunto.</p>
                @else
                    <ul>
                        @foreach($assunto->livros as $livro)
                            <li>{{ $livro->titulo }} ({{ $livro->ano_publicacao }})</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
