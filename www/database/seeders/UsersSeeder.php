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
                'email' => 'admin@admin.com',
                'password' => 'secretaria',
                'role' => 'secretaria',
            ],
            [
                'name' => 'John',
                'email' => 'john@gmail.com',
                'password' => 'psicologo',
                'role' => 'psicologo',
            ],
            [
                'name' => 'Thais',
                'email' => 'thais@gmail.com',
                'password' => 'cliente',
                'role' => 'cliente',
            ]
        ];

        foreach($users as $user) {
            $created_user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);

            $created_user->assignRole($user['role']);
        }

    }
}
