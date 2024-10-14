@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('assuntos.index') }}">Assuntos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Assunto</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container mt-4">
    <h2>Editar Assunto</h2>

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

    <form action="{{ route('assuntos.update', $assunto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo Código -->
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" class="form-control" id="codigo" name="codigo" 
                   value="{{ old('codigo', $assunto->codigo) }}" maxlength="10" 
                   placeholder="Digite o código do assunto">
            @error('codigo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Campo Descrição -->
        <div class="form-group mt-3">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao" name="descricao" 
                   value="{{ old('descricao', $assunto->descricao) }}" maxlength="20" 
                   placeholder="Digite a descrição do assunto">
            @error('descricao')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
        <a href="{{ route('assuntos.index') }}" class="btn btn-secondary mt-4">Cancelar</a>
    </form>
</div>
@endsection
