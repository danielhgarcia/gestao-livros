<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livro_assunto', function (Blueprint $table) {
            $table->unsignedBigInteger('livro_id');
            $table->unsignedBigInteger('assunto_id');
            $table->foreign('livro_id')->references('id')->on('livros')->onDelete('cascade');
            $table->foreign('assunto_id')->references('id')->on('assuntos')->onDelete('cascade');
            $table->primary(['livro_id', 'assunto_id']);
            $table->timestamps();
        });      
    }

    public function down(): void
    {
        Schema::dropIfExists('livro_assunto');
    }
};
