<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notificacion;

class MesadepartesBandeja extends Component
{
    public $pendientes = [];
    public $finalizadas = [];

    public function mount()
    {
        $this->pendientes = Notificacion::where('estado', 'Pendiente')->latest()->get();
        $this->finalizadas = Notificacion::where('estado', 'Finalizado')->latest()->get();
    }

    public function irAElaboracion($id)
    {
        return redirect()->route('notificaciones.mesadepartes.elaboracion', ['id' => $id]);
    }

    public function irAEntrega($id)
    {
        return redirect()->route('notificaciones.mesadepartes.entrega.lista', ['id' => $id]);
    }

    public function render()
    {
        return view('livewire.mesadepartes-bandeja');
    }
}

