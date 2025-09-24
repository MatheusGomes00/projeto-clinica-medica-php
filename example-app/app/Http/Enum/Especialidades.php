<?php

namespace App\Http\Enum;

enum Especialidades: string
{
    case Cardiologia = 'Cardiologia';
    case Pediatria = 'Pediatria';
    case Dermatologia = 'Dermatologia';
    case Ginecologia = 'Ginecologia';
    case Ortopedia = 'Ortopedia';
    case Neurologia = 'Neurologia';
    case Psiquiatria = 'Psiquiatria';
    case Urologia = 'Urologia';
    case Geral = 'Geral';
}
