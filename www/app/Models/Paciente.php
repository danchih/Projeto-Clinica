<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Paciente extends Authenticatable
{
    use HasFactory;

    protected $table = 'pacientes';
    protected $fillable = ['nome', 'cep', 'endereco','bairro','cidade','estado','telefone'];

    public function user()
    {
        return $this->hasOne(User::class, 'paciente_id');
    }

    public function consulta()
    {
        return $this->hasMany(Consulta::class, 'paciente_id');
    }
}


