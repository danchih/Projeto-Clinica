<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = ['paciente_id', 'psicologo_id', 'data', 'horario_inicio', 'horario_fim'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function psicologo()
    {
        return $this->belongsTo(Psicologo::class, 'psicologo_id');
    }
}
