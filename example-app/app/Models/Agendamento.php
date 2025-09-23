<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Agendamento extends Model
{
    /** @use HasFactory<\Database\Factories\AgendamentoFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'descricao',
        'hora_inicio',
        'hora_fim',
        'comentario',
        'paciente_id',
        'user_id',
        'status',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
