<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expedientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'name',
        'year',
        'month',
        'faculty_id',
        'document_type',
        'status',
        'sumilla',
        'observaciones',
    ];

    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'faculty_id');
    }
}
