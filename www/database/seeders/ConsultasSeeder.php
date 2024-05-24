<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consulta;
use App\Models\User;
use Carbon\Carbon;

class ConsultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtém todos os psicólogos
        $psicologos = User::role('psicologo')->get();
        
        // Supondo que há pacientes criados anteriormente, você pode pegar os IDs dos pacientes
        $pacientes = User::role('cliente')->get()->pluck('paciente_id')->toArray();

        // Dados de exemplo para as consultas
        $consultas = [
            [
                'user_id' => $psicologos->random()->id,
                'paciente_id' => $pacientes[array_rand($pacientes)],
                'data' => Carbon::parse('2024-08-01')->toDateString(), 
                'horario_inicio' => '09:00',
                'horario_fim' => '10:00',
                'informacao' => null,
            ],
            [
                'user_id' => $psicologos->random()->id,
                'paciente_id' => $pacientes[array_rand($pacientes)],
                'data' => Carbon::parse('2024-05-02')->toDateString(), 
                'horario_inicio' => '11:00',
                'horario_fim' => '12:00',
                'informacao' => 'Paciente liberado com sucesso.',
            ],
            [
                'user_id' => $psicologos->random()->id,
                'paciente_id' => $pacientes[array_rand($pacientes)],
                'data' => Carbon::parse('2024-06-01')->toDateString(), 
                'horario_inicio' => '14:00',
                'horario_fim' => '15:00',
                'informacao' => null,
            ],
            [
                'user_id' => $psicologos->random()->id,
                'paciente_id' => $pacientes[array_rand($pacientes)],
                'data' => Carbon::parse('2024-05-22')->toDateString(), 
                'horario_inicio' => '13:00',
                'horario_fim' => '14:00',
                'informacao' => 'O paciente deve retornar apos 15 dias para realizar uma nova sessao',
            ],
            [
                'user_id' => $psicologos->random()->id,
                'paciente_id' => $pacientes[array_rand($pacientes)],
                'data' => Carbon::parse('2024-09-01')->toDateString(), 
                'horario_inicio' => '15:00',
                'horario_fim' => '16:00',
                'informacao' => null,
            ],
            [
                'user_id' => $psicologos->random()->id,
                'paciente_id' => $pacientes[array_rand($pacientes)],
                'data' => Carbon::parse('2024-04-03')->toDateString(), 
                'horario_inicio' => '16:00',
                'horario_fim' => '17:00',
                'informacao' => 'Paciente deve retornar daqui 20 dias para realizar uma nova sessao',
            ],
            [
                'user_id' => $psicologos->random()->id,
                'paciente_id' => $pacientes[array_rand($pacientes)],
                'data' => Carbon::parse('2024-07-01')->toDateString(), 
                'horario_inicio' => '17:00',
                'horario_fim' => '18:00',
                'informacao' => null,
            ],
            [
                'user_id' => $psicologos->random()->id,
                'paciente_id' => $pacientes[array_rand($pacientes)],
                'data' => Carbon::parse('2024-06-02')->toDateString(), 
                'horario_inicio' => '08:00',
                'horario_fim' => '09:00',
                'informacao' => null,
            ],
        ];

        // Cria as consultas no banco de dados
        foreach ($consultas as $consulta) {
            Consulta::create($consulta);
        }
    }
}
