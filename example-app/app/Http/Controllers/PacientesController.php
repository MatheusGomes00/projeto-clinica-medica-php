<?php

use App\Http\Controllers\Controller;
use App\Services\PacientesService;
use Illuminate\Http\Request;

class PacientesController extends Controller
{

    protected PacientesService $pacientesService;

    public function __construct(PacientesService $pacientesService){
        $this->pacientesService = $pacientesService;
    }

    public function create() {
        return view('Pacientes');
    }

    public function cadastrarPaciente(Request $request) {
        $validated = $request->validate([
            'name' => 'required', 'string', 'max:100',
            'telefone' => 'required', 'string', 'max:20',
            'email' => 'nullable', 'string', 'min:100',
            'data_nascimento' => 'required', 'date',
        ]);

        $response = $this->pacientesService->cadastrarPaciente($validated);
        return redirect()->back()->with('success', $response);
    }

}
