@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('autores.index') }}">Autores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Novo Autor</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container mt-4">
    <h2>Novo Autor</h2>

    <!-- Exibe mensagens de erro -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('autores.store') }}" method="POST">
        @csrf

        <!-- Campo Código -->
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" class="form-control" id="codigo" name="codigo" 
                   value="{{ old('codigo') }}" maxlength="10" 
                   placeholder="Digite o código do autor">
            @error('codigo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Campo Nome -->
        <div class="form-group mt-3">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" 
                   value="{{ old('nome') }}" maxlength="40" 
                   placeholder="Digite o nome do autor">
            @error('nome')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
        <a href="{{ route('autores.index') }}" class="btn btn-secondary mt-4">Cancelar</a>
    </form>
</div>
@endsection
