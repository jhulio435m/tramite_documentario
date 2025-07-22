<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Auth;

class DependenciaBandeja extends Component
{
    public $notificaciones = [];

    public function mount()
    {
        $correo = Auth::user()->email;

        $this->notificaciones = Notificacion::where('estado', 'Solicitada')
            ->where('destinatario_contacto', $correo)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.dependencia-bandeja');
    }
}