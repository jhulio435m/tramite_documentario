<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Notificacion;

class MesadepartesElaboracion extends Component
{
    use WithFileUploads;

    public $notificacion;
    public $archivoTemporal;

    public function mount($id)
    {
        $this->notificacion = Notificacion::findOrFail($id)->toArray();
    }

    public function guardarCambios()
    {
        // Buscar la notificación original
        $noti = Notificacion::findOrFail($this->notificacion['id']);

        // Actualizar campos editables
        $noti->estado = $this->notificacion['estado'] ?? $noti->estado;
        $noti->mensaje = $this->notificacion['mensaje'] ?? $noti->mensaje;

        // Si se sube un nuevo archivo
        if ($this->archivoTemporal) {
            $ruta = $this->archivoTemporal->store('notificaciones', 'public');
            $noti->archivo = $ruta;
        }

        $noti->save();

        session()->flash('success', '✅ Notificación actualizada correctamente.');

        return redirect()->route('notificaciones.mesadepartes.entrega.lista');
    }

    public function render()
    {
        return view('livewire.mesadepartes-elaboracion');
    }
}
