<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'funcionario', 'created_at' => now(), 'updated_at' => now()], // Primero
            ['name' => 'administrador', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'operador', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'usuario', 'created_at' => now(), 'updated_at' => now()], // Último
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['name' => $role['name']],
                $role
            );
        }
    }
}