<?php

namespace Database\Factories;

use App\Models\Autor;
use Illuminate\Database\Eloquent\Factories\Factory;

class AutorFactory extends Factory
{
    protected $model = Autor::class;

    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->numberBetween(1, 1000),
            'nome' => $this->faker->name,
        ];
    }
}
