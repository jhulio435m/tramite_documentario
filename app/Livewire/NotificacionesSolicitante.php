<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class NotificacionesSolicitante extends Component
{
    public $solicitante; // El nombre del solicitante autenticado o identificado
    public $notificaciones = [];

    public function mount($solicitante)
    {
        $this->solicitante = $solicitante;
        $this->cargarNotificaciones();
    }

    public function cargarNotificaciones()
    {
        $this->notificaciones = DB::table('notificaciones')
            ->join('expedientes', 'notificaciones.expediente_id', '=', 'expedientes.id')
            ->where('expedientes.solicitante', $this->solicitante)
            ->orderByDesc('notificaciones.enviado_at')
            ->select('notificaciones.*', 'expedientes.codigo')
            ->get();
    }

    public function render()
    {
        return view('livewire.notificaciones-solicitante');
    }
}
