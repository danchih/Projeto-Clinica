<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Paciente; // Certifique-se de importar o modelo Paciente
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nome' => 'Admin',
                'username' => 'admin',
                'password' => 'secretaria',
                'paciente_id' => NULL,
                'role' => 'secretaria',
            ],
            [
                'nome' => 'Jose Camargo',
                'username' => 'jose',
                'password' => 'psicologo',
                'paciente_id' => NULL,
                'role' => 'psicologo',
            ],
            [
                'nome' => 'Carla da Silva',
                'username' => 'carlasilva',
                'password' => 'carlas',
                'paciente_id' => NULL,
                'role' => 'psicologo',
            ],
            [
                'nome' => 'João da Silva',
                'username' => 'joaosilva',
                'password' => '123456',
                'role' => 'cliente',
                'paciente' => [
                    'nome' => 'João da Silva',
                    'cep' => '12345678',
                    'endereco' => 'Rua das Flores, 123',
                    'bairro' => 'Centro',
                    'cidade' => 'São Paulo',
                    'estado' => 'SP',
                    'telefone' => '11987654321',
                ],
            ],
            [
                'nome' => 'Maria Oliveira',
                'username' => 'mariaoliveira',
                'password' => 'senha123',
                'role' => 'cliente',
                'paciente' => [
                    'nome' => 'Maria Oliveira',
                    'cep' => '87654321',
                    'endereco' => 'Avenida Paulista, 456',
                    'bairro' => 'Bela Vista',
                    'cidade' => 'São Paulo',
                    'estado' => 'SP',
                    'telefone' => '11987654322',
                ],
            ],
            [
                'nome' => 'Carlos Pereira',
                'username' => 'carlospereira',
                'password' => 'carlosp',
                'role' => 'cliente',
                'paciente' => [
                    'nome' => 'Carlos Pereira',
                    'cep' => '11223344',
                    'endereco' => 'Rua dos Pinheiros, 789',
                    'bairro' => 'Pinheiros',
                    'cidade' => 'São Paulo',
                    'estado' => 'SP',
                    'telefone' => '11987654323',
                ],
            ],
        ];

        foreach($users as $user) {
            if (isset($user['paciente'])) {
                // Cria o paciente
                $paciente = Paciente::create($user['paciente']);
                // Adiciona o ID do paciente ao usuário
                $user['paciente_id'] = $paciente->id;
            }

            // Cria o usuário
            $created_user = User::create([
                'nome' => $user['nome'],
                'username' => $user['username'],
                'password' => Hash::make($user['password']),
                'paciente_id' => $user['paciente_id'],
            ]);

            // Atribui o papel ao usuário
            $created_user->assignRole($user['role']);
        }
    }
}
