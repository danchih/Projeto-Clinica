<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_secretaria = Role::create(['name' => 'secretaria']);
        $role_psicologo = Role::create(['name' => 'psicologo']);
        $role_cliente = Role::create(['name' => 'cliente']);

    }
}
