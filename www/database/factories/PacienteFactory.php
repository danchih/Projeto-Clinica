<?php
namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    protected $model = Paciente::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'cep' => $this->faker->postcode,
            'endereco' => $this->faker->streetAddress,
            'bairro' => $this->faker->citySuffix,
            'cidade' => $this->faker->city,
            'estado' => $this->faker->stateAbbr,
            'telefone' => $this->faker->phoneNumber,
        ];
    }
}