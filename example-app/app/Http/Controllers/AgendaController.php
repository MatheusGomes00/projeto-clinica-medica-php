<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;

class AgendaController extends Controller
{
    public function retornarAgendamentos() {
        $agendamentos = Agendamento::with('paciente')->get();
        return response()->json($agendamentos->map(function($agendamento){
            return [
                'title' => $agendamento->descricao,
                'start' => $agendamento->hora_inicio,
                'end' => $agendamento->hora_fim,
                'comentario' => $agendamento->comentario,
                'paciente_id' => $agendamento->paciente_id,
                'user_id' => $agendamento->user_id,
                'status' => $agendamento->status,
                'color' => $this->getStatusColor($agendamento->status)
            ];
        }));
    }

    public function getStatusColor($status) {
        return match($status) {
            'confirmado' => '#198754',
            'cancelado' => '#dc3545',
            default => '#ffc107'
        };
    }
}
