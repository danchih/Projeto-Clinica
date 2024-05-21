<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psicologo extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email'];

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'psicologo_id');
    }
}
