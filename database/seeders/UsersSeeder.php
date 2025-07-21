<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Usuarios clave con datos realistas
        $users = [
            [
                'name' => 'Admin',
                'last_name' => 'Sistema',
                'email' => 'admin@mesadepartes.com',
                'dni' => '12345678',
                'role_id' => 3, // administrador
                'password' => Hash::make('Admin@123'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Funcionario',
                'last_name' => 'Ejemplo',
                'email' => 'funcionario@mesadepartes.com',
                'dni' => '87654321',
                'role_id' => 3, // funcionario
                'password' => Hash::make('Funcionario@123'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Operador',
                'last_name' => 'Mesa Partes',
                'email' => 'operador@mesadepartes.com',
                'dni' => '11223344',
                'role_id' => 3, // operador
                'password' => Hash::make('Operador@123'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Usuario',
                'last_name' => 'Demo',
                'email' => 'usuario@demo.com',
                'dni' => '44332211',
                'role_id' => 3, // usuario
                'password' => Hash::make('Usuario@123'),
                'email_verified_at' => now()
            ]
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }

        // Generar 10 usuarios aleatorios (opcional)
        User::factory(10)->create();
    }
}