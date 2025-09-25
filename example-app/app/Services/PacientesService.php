<?php

namespace App\Services;

use App\Models\Paciente;

class PacientesService
{
    public function cadastrarPaciente(array $data): Paciente
    {
        return Paciente::create([
            'name' => $data['name'],
            'email'=> $data['email'],
            'telefone'=> $data['telefone'],
            'data_nascimento' => $data['data_nascimento']
        ]);
    }
}
