<?php

namespace App\Services;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacientesService
{


    public function buscarPacientes(Request $request){
        $busca = $request->input('busca');

        $pacientes = Paciente::query()
            ->when($busca, function ($query) use ($busca){
                $query->where('nome', 'LIKE', '%{busca}%')
                    ->orWhere('email', 'LIKE', '%{busca}%')
                    ->orWhere('telefone', 'LIKE', '%{busca}%');
            })
            ->orderBy('nome')
            ->paginate(10);

        return $pacientes;
    }

    public function cadastrarPaciente(array $data): Paciente
    {
        return Paciente::create([
            'nome' => $data['nome'],
            'email'=> $data['email'],
            'telefone'=> $data['telefone'],
            'data_nascimento' => $data['data_nascimento']
        ]);
    }
}
