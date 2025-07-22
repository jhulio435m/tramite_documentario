<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Auth;

class UsuarioBandeja extends Component
{
    public $notificaciones = [];

    public function mount()
    {
        $correoUsuario = Auth::user()->email;

        $this->notificaciones = Notificacion::whereIn('estado', ['Finalizado', 'Atendido'])
            ->where('destinatario_contacto', $correoUsuario)
            ->latest()
            ->get();
    }

    public function marcarComoLeido($id)
    {
        $noti = Notificacion::find($id);

        if ($noti && $noti->estado === 'Finalizado') {
            $noti->update(['estado' => 'Atendido']);
            session()->flash('success', '✅ Notificación marcada como atendida.');
            $this->mount(); // recarga las notificaciones
        }
    }

    public function render()
    {
        return view('livewire.usuario-bandeja');
    }
}