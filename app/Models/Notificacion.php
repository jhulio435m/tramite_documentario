<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'tramite_id',
        'fecha_solicitud',
        'documento',
        'tipo',
        'destinatario_nombre',
        'destinatario_direccion',
        'destinatario_contacto',
        'funcionario',
        'estado',
    ];
}

