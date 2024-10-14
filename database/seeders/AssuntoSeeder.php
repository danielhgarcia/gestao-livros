<?php

namespace Database\Seeders;

use App\Models\Autor;
use Illuminate\Database\Seeder;

class AssuntoSeeder extends Seeder
{
    public function run()
    {
        Assunto::factory()->count(10)->create();
    }
}