<?php

namespace Database\Seeders;

use App\Models\Tramite;
use App\Models\User;
use Illuminate\Database\Seeder;

class TramitesSeeder extends Seeder
{
    public function run()
    {
        // Obtener algunos emails de funcionarios
        $funcionarios = User::limit(3)->pluck('email')->toArray();

        $tramites = [
            [
                'documento' => 'Solicitud de Certificado de Estudios',
                'codigo' => 'TR-' . now()->format('Ymd') . '-001',
                'solicitante' => 'Usuario Demo',
                'fecha_inicio' => now()->subDays(3),
                'estado' => 'Pendiente',
                'descripcion' => 'Certificado de estudios completos del año 2023',
                'observaciones' => 'Falta adjuntar DNI',
                'resultado' => '',
                'archivo_adjunto' => '',
                'user_id' => User::first()->id,
                'funcionario_destinatario' => $funcionarios[0] // Usa el email
            ],
            [
                'documento' => 'Constancia de Matrícula',
                'codigo' => 'TR-' . now()->format('Ymd') . '-002',
                'solicitante' => 'Usuario Demo',
                'fecha_inicio' => now()->subDay(),
                'estado' => 'En revisión',
                'descripcion' => 'Constancia de matrícula para beca',
                'observaciones' => 'Verificar datos académicos',
                'resultado' => '',
                'archivo_adjunto' => 'matricula.pdf',
                'user_id' => User::first()->id,
                'funcionario_destinatario' => $funcionarios[1] // Usa el email
            ]
        ];

        Tramite::factory(10)->create();
        
    }
}