<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tramite; // 👈 Esta línea es clave

class TramiteSeeder extends Seeder
{
    public function run(): void
    {
        Tramite::create([
            'codigo' => 'TR-001',
            'asunto' => 'Solicitud de informe técnico',
            'descripcion' => 'Requiere validación por oficina técnica',
            'estado' => 'Activo',
        ]);

        Tramite::create([
            'codigo' => 'TR-002',
            'asunto' => 'Informe de estado legal',
            'descripcion' => 'Debe ser revisado por oficina legal',
            'estado' => 'Pendiente',
        ]);
    }
}