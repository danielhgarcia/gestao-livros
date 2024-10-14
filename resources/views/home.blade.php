@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Livros
                </div>
                <div class="card-body">
                    <p class="card-text">Gerencie todos os livros cadastrados no sistema.</p>
                    <a href="{{ route('livros.index') }}" class="btn btn-primary">Gerenciar Livros</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Autores
                </div>
                <div class="card-body">
                    <p class="card-text">Cadastre e atualize informações dos autores.</p>
                    <a href="{{ route('autores.index') }}" class="btn btn-success">Gerenciar Autores</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    Assuntos
                </div>
                <div class="card-body">
                    <p class="card-text">Gerencie os assuntos vinculados aos livros.</p>
                    <a href="{{ route('assuntos.index') }}" class="btn btn-warning">Gerenciar Assuntos</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Relatório de Livros por Autor
                </div>
                <div class="card-body">
                    <p class="card-text">Visualize o relatório dos livros agrupados por autor.</p>
                    <a href="{{ route('livros.relatorioPorAutor') }}" class="btn btn-info">Ver Relatório</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    Relatório de Livros por Assunto
                </div>
                <div class="card-body">
                    <p class="card-text">Visualize o relatório dos livros agrupados por assunto.</p>
                    <a href="{{ route('livros.relatorioPorAssunto') }}" class="btn btn-danger">Ver Relatório</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
