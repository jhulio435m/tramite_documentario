<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TramiteExpediente extends Model
{
    protected $fillable = [
        'codigo',
        'tramite_type_id',
        'sustento',
        'archivos',
    ];

    protected $casts = [
        'archivos' => 'array',
    ];

    public function expediente()
    {
        return $this->belongsTo(Expediente::class, 'codigo', 'codigo');
    }

    public function tramiteType()
    {
        return $this->belongsTo(TramiteType::class);
    }
}
