<?php
namespace Database\Factories;

use App\Models\Consulta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ConsultaFactory extends Factory
{
    protected $model = Consulta::class;

    public function definition()
    {
        return [
            'data' => Carbon::now()->addDays($this->faker->numberBetween(1, 30))->toDateString(),
            'horario_inicio' => $this->faker->time('H:i'),
            'horario_fim' => $this->faker->time('H:i'),
            'informacao' => $this->faker->text,
        ];
    }
}