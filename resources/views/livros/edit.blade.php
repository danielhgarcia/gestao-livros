@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('livros.index') }}">Livros</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Livro</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container mt-4">
    <h2>Editar Livro</h2>

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

    <form action="{{ route('livros.update', $livro->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo Código -->
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" class="form-control" id="codigo" name="codigo" 
                   value="{{ old('codigo', $livro->codigo) }}" 
                   maxlength="10" placeholder="Digite o código do livro">
            @error('codigo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Campo Título -->
        <div class="form-group mt-3">
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" 
                   value="{{ old('titulo', $livro->titulo) }}" 
                   maxlength="40" placeholder="Digite o título do livro">
            @error('titulo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Campo Editora -->
        <div class="form-group mt-3">
            <label for="editora">Editora:</label>
            <input type="text" class="form-control" id="editora" name="editora" 
                   value="{{ old('editora', $livro->editora) }}" 
                   maxlength="40" placeholder="Digite a editora do livro">
            @error('editora')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Campo Edição -->
        <div class="form-group mt-3">
            <label for="edicao">Edição:</label>
            <input type="number" class="form-control" id="edicao" name="edicao" 
                   value="{{ old('edicao', $livro->edicao) }}" 
                   placeholder="Digite a edição">
            @error('edicao')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Campo Ano de Publicação (somente números) -->
        <div class="form-group mt-3">
            <label for="ano_publicacao">Ano de Publicação:</label>
            <input type="number" class="form-control" id="ano_publicacao" name="ano_publicacao" 
                   value="{{ old('ano_publicacao', $livro->ano_publicacao) }}" 
                   maxlength="4" min="1000" max="{{ date('Y') }}" 
                   placeholder="Digite o ano de publicação">
            @error('ano_publicacao')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Campo Valor (com máscara de valor) -->
        <div class="form-group mt-3">
            <label for="valor">Valor (R$):</label>
            <input type="text" class="form-control" id="valor" name="valor" 
                   value="{{ old('valor', $livro->valor) }}" 
                   placeholder="Digite o valor (ex: 1.221,21)">
            @error('valor')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Seleção múltipla de Autores -->
        <div class="form-group mt-3">
            <label for="autores">Autores:</label>
            <select multiple class="form-control select2" id="autores" name="autores[]">
                @foreach($autores as $autor)
                    <option value="{{ $autor->id }}" {{ in_array($autor->id, $livro->autores->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $autor->nome }}
                    </option>
                @endforeach
            </select>
            @error('autores')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Seleção múltipla de Assuntos -->
        <div class="form-group mt-3">
            <label for="assuntos">Assuntos:</label>
            <select multiple class="form-control select2" id="assuntos" name="assuntos[]">
                @foreach($assuntos as $assunto)
                    <option value="{{ $assunto->id }}" {{ in_array($assunto->id, $livro->assuntos->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $assunto->descricao }}
                    </option>
                @endforeach
            </select>
            @error('assuntos')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
        <a href="{{ route('livros.index') }}" class="btn btn-secondary mt-4">Cancelar</a>
    </form>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Inicializa o Select2
            $('.select2').select2({
                placeholder: 'Selecione o registro',
                allowClear: true
            });

            // Máscara para campo de valor (R$)
            $('#valor').mask('000.000,00', {reverse: true});
        });

        // Converte o valor formatado (ex: 1.221,21) para o formato aceito pelo PHP (ex: 1221.21)
        document.querySelector('form').addEventListener('submit', function(event) {
            var valorField = document.getElementById('valor');
            valorField.value = valorField.value.replace(/\./g, '').replace(',', '.');
        });
    </script>

    <!-- Importa o jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
@endsection
