<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            'Pendiente',
            'Progreso',
            'Aprobado',
            'Rechazado',
            'Enviado',
            'Canalizado',
            'Finalizado',
            'Archivado'
        ];

        foreach ($statuses as $name) {
            \App\Models\Status::create(['name' => $name]);
        }
    }
}
