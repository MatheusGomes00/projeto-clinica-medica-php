<?php

namespace Database\Seeders;


use App\Models\Paciente;
use Illuminate\Database\Seeder;

class PacienteSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Paciente::factory(10)->create();

    }
}
