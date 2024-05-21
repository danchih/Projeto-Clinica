<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';
    protected $fillable = [
        'nome',
        'cep',
        'endereco',
        'bairro',
        'cidade',
        'estado',
        'telefone',
        'login',
        'senha',
    ];

    protected $hidden = [
        'senha',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'paciente_id');
    }

    public function consulta()
    {
        return $this->hasMany(Consulta::class, 'paciente_id');
    }
}
