<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Services\PacientesService;
use Illuminate\Http\Request;

class PacientesController extends Controller
{

    protected PacientesService $pacientesService;

    public function __construct(PacientesService $pacientesService){
        $this->pacientesService = $pacientesService;
    }

    public function telaPacientes()
    {
        return view('pacientes.pacientes');
    }

    public function createView() {
        return view('pacientes.CadastrarPacientes');
    }

    public function cadastrarPaciente(Request $request) {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'data_nascimento' => 'required|date'
        ]);

        $this->pacientesService->cadastrarPaciente($validated);
        return view('dashboard');
    }

    public function buscarPacientes(Request $request) {
        $pacientes = $this->pacientesService->buscarPacientes($request);
        return view('pacientes.pacientes', compact('pacientes'));
    }


}
