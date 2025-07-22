<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Notificacion;
use App\Models\Tramite;

class NotificacionSeeder extends Seeder
{
    public function run(): void
    {
        $tramite1 = Tramite::firstWhere('codigo', 'TR-001');
        $tramite2 = Tramite::firstWhere('codigo', 'TR-002');

        Notificacion::create([
            'tramite_id' => $tramite1->id,
            'documento' => 'DOC-001',
            'tipo' => 'Solicitud',
            'mensaje' => 'Documento entregado con firma digital.',
            'estado' => 'Finalizado',
            'funcionario' => 'Luis Fernández',
            'destinatario_nombre' => 'Juan Pérez',
            'destinatario_direccion' => 'Av. Lima 123',
            'destinatario_contacto' => 'usuario@demo.com',
            'fecha_solicitud' => Carbon::now()->subDays(2),
            'fecha_entrega' => Carbon::now()->subDay(),
            'archivo' => 'archivos/doc001.pdf',
        ]);

        Notificacion::create([
            'tramite_id' => $tramite1->id,
            'documento' => 'DOC-002',
            'tipo' => 'Informe',
            'mensaje' => 'Ya fue revisado por el receptor.',
            'estado' => 'Atendido',
            'funcionario' => 'Luis Fernández',
            'destinatario_nombre' => 'Juan Pérez',
            'destinatario_direccion' => 'Av. Lima 123',
            'destinatario_contacto' => 'usuario@demo.com',
            'fecha_solicitud' => Carbon::now()->subDays(3),
            'fecha_entrega' => Carbon::now()->subDays(2),
            'archivo' => 'archivos/doc002.pdf',
        ]);

        Notificacion::create([
            'tramite_id' => $tramite2->id,
            'documento' => 'DOC-003',
            'tipo' => 'Trámite',
            'mensaje' => 'Se solicita atención inmediata.',
            'estado' => 'Solicitada',
            'funcionario' => 'Carolina Quispe',
            'destinatario_nombre' => 'María López',
            'destinatario_direccion' => 'Jr. Constitución 456',
            'destinatario_contacto' => 'dependencia@demo.com',
            'fecha_solicitud' => Carbon::now(),
        ]);

        Notificacion::create([
            'tramite_id' => $tramite2->id,
            'documento' => 'DOC-004',
            'tipo' => 'Trámite',
            'mensaje' => 'Solicitud gestionada.',
            'estado' => 'Pendiente',
            'funcionario' => 'Carolina Quispe',
            'destinatario_nombre' => 'María López',
            'destinatario_direccion' => 'Jr. Constitución 456',
            'destinatario_contacto' => 'dependencia@demo.com',
            'fecha_solicitud' => Carbon::now()->subDays(3),
            'fecha_entrega' => Carbon::now()->subDay(),
        ]);
    }
}