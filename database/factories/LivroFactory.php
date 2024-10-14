<?php

namespace Database\Factories;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Factories\Factory;

class LivroFactory extends Factory
{
    protected $model = Livro::class;

    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->numberBetween(100, 999),
            'titulo' => $this->faker->sentence(3), 
            'editora' => $this->faker->company,
            'edicao' => $this->faker->numberBetween(1, 10),
            'ano_publicacao' => $this->faker->year, 
            'valor' => $this->faker->randomFloat(2, 10, 300),
        ];
    }
}
