<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Si quieres mantener el factory de prueba:
        \App\Models\User::factory()->create([
            'name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'dni' => '12345678',
            'role_id' => 1,
        ]);

        // 👇 Llamado a los seeders completos del sistema
        $this->call([
            UserSeeder::class,
            TramiteSeeder::class,
            NotificacionSeeder::class,
        ]);
    }
}