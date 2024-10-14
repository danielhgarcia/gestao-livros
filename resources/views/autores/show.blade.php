@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('autores.index') }}">Autores</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $autor->nome }}</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container mt-4">
    <h2>Detalhes do Autor</h2>

    <div class="card">
        <div class="card-body">
            <p class="card-text">Código: {{ $autor->codigo }}</p>
            <h5 class="card-title">Nome: {{ $autor->nome }}</h5>
        </div>
    </div>

    <a href="{{ route('autores.index') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>
@endsection
