<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory; // Esta línea es crucial para usar factories

    protected $fillable = [
        'documento',
        'codigo',
        'solicitante',
        'fecha_inicio',
        'estado',
        'descripcion',
        'observaciones',
        'resultado',
        'archivo_adjunto',
        'user_id',
        'funcionario_destinatario'
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}