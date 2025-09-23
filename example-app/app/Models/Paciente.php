<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Paciente extends Model{
    /** @use HasFactory<\Database\Factories\PacienteFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'data_nascimento'
    ];

    protected $casts = [
        'data_nascimento' => 'date'
    ];

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class, 'paciente_id');
    }
}
