<?php

namespace Database\Factories;

use App\Models\Assunto;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssuntoFactory extends Factory
{

    protected $model = Assunto::class;

    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->numberBetween(1, 1000),
            'descricao' => $this->faker->word,
        ];
    }
}
