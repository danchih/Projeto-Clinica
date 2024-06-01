<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = ['paciente_id', 'user_id', 'data', 'horario_inicio', 'horario_fim', 'informacao'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
