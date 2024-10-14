<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livro_autor', function (Blueprint $table) {
            $table->unsignedBigInteger('livro_id');
            $table->unsignedBigInteger('autor_id');
            $table->foreign('livro_id')->references('id')->on('livros')->onDelete('cascade');
            $table->foreign('autor_id')->references('id')->on('autores')->onDelete('cascade');
            $table->primary(['livro_id', 'autor_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livro_autor');
    }
};
