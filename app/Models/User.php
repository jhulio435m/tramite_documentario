<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'dni',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Relación: Trámites asignados a este usuario
     */
    public function tramites()
    {
        return $this->hasMany(Tramite::class, 'user_id');
    }

    /**
     * Relación: Trámites solicitados por este usuario
     */
    public function tramitesSolicitados()
    {
        return $this->hasMany(Tramite::class, 'solicitante_id');
    }

    /**
     * Obtener trámites pendientes del usuario
     */
    public function tramitesPendientes()
    {
        return $this->tramites()->where('estado', 'Pendiente');
    }

    /**
     * Contar trámites pendientes del usuario
     */
    public function contarTramitesPendientes()
    {
        return $this->tramitesPendientes()->count();
    }
}