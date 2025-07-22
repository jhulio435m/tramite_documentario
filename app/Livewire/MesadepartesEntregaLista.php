<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notificacion;

class MesadepartesEntregaLista extends Component
{
    public $notificaciones;

    public function mount()
    {
        $this->notificaciones = Notificacion::where('estado', 'Lista para entrega')->get();
    }

    public function entregar($id)
    {
        $notificacion = Notificacion::find($id);
        if ($notificacion) {
            $notificacion->estado = 'Finalizado';
            $notificacion->save();
            session()->flash('success', '✅ Notificación entregada correctamente.');
            
            $this->notificaciones = Notificacion::where('estado', 'Lista para entrega')->get();
        }
    }

    public function render()
    {
        return view('livewire.mesadepartes-entrega-lista');
    }
}
