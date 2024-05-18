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
                'name' => 'Admin',
                'username' => 'admin',
                'password' => 'secretaria',
                'role' => 'secretaria',
            ],
            [
                'name' => 'John',
                'username' => 'john',
                'password' => 'psicologo',
                'role' => 'psicologo',
            ],
            [
                'name' => 'Thais',
                'username' => 'thais',
                'password' => 'cliente',
                'role' => 'cliente',
            ]
        ];

        foreach($users as $user) {
            $created_user = User::create([
                'name' => $user['name'],
                'username' => $user['username'],
                'password' => Hash::make($user['password']),
            ]);

            $created_user->assignRole($user['role']);
        }

    }
}
