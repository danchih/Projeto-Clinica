<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
                'nome' => 'John',
                'username' => 'john',
                'password' => 'psicologo',
                'paciente_id' => NULL,
                'role' => 'psicologo',
            ],

        ];

        foreach($users as $user) {
            $created_user = User::create([
                'nome' => $user['nome'],
                'username' => $user['username'],
                'password' => Hash::make($user['password']),
                'paciente_id' => $user['paciente_id'],
            ]);

            $created_user->assignRole($user['role']);
        }

    }
}
