<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            TramitesSeeder::class,
            NotificacionesSeeder::class,
            NotificationPreferencesSeeder::class,
        ]);

        // Usuario de prueba también como funcionario
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'dni' => '99999999',
            'role_id' => 3, // Ahora como funcionario
            'password' => bcrypt('password'),
        ]);
    }
}