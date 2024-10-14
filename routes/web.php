<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('assuntos', AssuntoController::class);
Route::resource('autores', AutorController::class)->parameters([
    'autores' => 'autor'
]);
Route::resource('livros', LivroController::class);

Route::get(
    'relatorios/livros-por-autor', 
    [RelatorioController::class, 'relatorioPorAutor']
)->name('livros.relatorioPorAutor');

Route::get(
    'relatorios/livros-por-autor-pdf', 
    [RelatorioController::class, 'relatorioPorAutorPdf']
)->name('livros.relatorioPorAutorPdf');

Route::get(
    'relatorios/livros-por-assunto',
    [RelatorioController::class, 'relatorioPorAssunto']
)->name('livros.relatorioPorAssunto');

Route::get(
    'relatorios/livros-por-assunto-pdf', 
    [RelatorioController::class, 'relatorioPorAssuntoPdf']
)->name('livros.relatorioPorAssuntoPdf');
