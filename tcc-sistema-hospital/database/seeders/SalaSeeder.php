<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sala;

class SalaSeeder extends Seeder
{
    public function run(): void
    {
        $salas = ['Sala 1', 'Sala 2', 'Sala 3', 'Sala 4']; // coloque os nomes que quiser

        foreach ($salas as $nome) {
            Sala::create(['nome' => $nome]);
        }
    }
}
