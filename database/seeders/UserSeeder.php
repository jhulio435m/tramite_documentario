<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Operador',
            'last_name' => 'Mesa',
            'email' => 'operador@demo.com',
            'password' => bcrypt('123456'),
            'role_id' => 1,
            'dni' => '11111111',
        ]);

        User::create([
            'name' => 'Usuario',
            'last_name' => 'Dependencia',
            'email' => 'dependencia@demo.com',
            'password' => bcrypt('123456'),
            'role_id' => 2,
            'dni' => '22222222',
        ]);

        User::create([
            'name' => 'Usuario',
            'last_name' => 'Final',
            'email' => 'usuario@demo.com',
            'password' => bcrypt('123456'),
            'role_id' => 3,
            'dni' => '33333333',
        ]);
    }
}