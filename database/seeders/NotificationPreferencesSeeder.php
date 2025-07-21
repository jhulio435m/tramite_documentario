<?php

namespace Database\Seeders;

use App\Models\NotificationPreference;
use Illuminate\Database\Seeder;

class NotificationPreferencesSeeder extends Seeder
{
    public function run()
    {
        // Usar el modelo correcto (NotificationPreference)
        NotificationPreference::updateOrCreate(
            ['user_id' => 1],
            [
                'email_enabled' => true,
                'database_enabled' => true,
                'push_enabled' => false,
                'start_time' => '08:00',
                'end_time' => '17:00'
            ]
        );

        NotificationPreference::updateOrCreate(
            ['user_id' => 2],
            [
                'email_enabled' => true,
                'database_enabled' => true,
                'push_enabled' => false,
                'start_time' => '09:00',
                'end_time' => '18:00'
            ]
        );
    }
}