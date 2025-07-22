<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;


    protected $fillable = [
        'tramite_id',
        'numero_expediente',
        'fecha_solicitud',
        'documento',
        'tipo',
        'destinatario_nombre',
        'destinatario_direccion',
        'destinatario_contacto',
        'funcionario',
        'estado',
        'mensaje',
        'archivo',
        'estado_entrega',
        'fecha_entrega',
        'receptor',
        'observaciones',
        'fecha_archivo',
        'archivado_por',
    ];

    protected $casts = [
        'fecha_solicitud' => 'datetime',
        'fecha_entrega'   => 'datetime',
        'fecha_archivo'   => 'datetime',
    ];
}