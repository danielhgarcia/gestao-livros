@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('assuntos.index') }}">Assuntos</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $assunto->descricao }}</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container mt-4">
    <h2>Detalhes do Assunto</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Código: {{ $assunto->codigo }}</h5>
            <h5 class="card-title">Descrição: {{ $assunto->descricao }}</h5>
        </div>
    </div>

    <a href="{{ route('assuntos.index') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>
@endsection
