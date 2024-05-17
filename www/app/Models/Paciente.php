<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Paciente extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'endereco',
        'telefone',
        'login',
        'senha',
    ];

    protected $hidden = [
        'senha',
    ];
}


