<?php

namespace Database\Seeders;

use App\Models\Agendamento;
use App\Models\User;
use App\Models\Paciente;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Paciente::factory(10)->create();

        Agendamento::factory(10)->create();
    }
}
