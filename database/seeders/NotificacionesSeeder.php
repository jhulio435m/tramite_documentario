<?php

namespace Database\Seeders;

use App\Models\Notificacion;
use Illuminate\Database\Seeder;

class NotificacionesSeeder extends Seeder
{
    public function run()
    {
        $notificaciones = [
            [
                'user_id' => 4,
                'titulo' => 'Trámite recibido',
                'mensaje' => 'Hemos recibido tu solicitud de Certificado de Estudios',
                'visto' => false
            ],
            [
                'user_id' => 3,
                'titulo' => 'Nuevo trámite asignado',
                'mensaje' => 'Tienes un nuevo trámite para revisar (Certificado de Estudios)',
                'visto' => true
            ]
        ];

        foreach ($notificaciones as $notificacion) {
            Notificacion::create($notificacion);
        }
    }
}