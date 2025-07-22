<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notificacion;
use Carbon\Carbon;

class MesadepartesRegistro extends Component
{
    // Colección de notificaciones listas para entrega
    public $notificaciones = [];

    // Selección activa
    public $selectedNotificacionId = null;
    public $notificacion = null;

    // Campos registrados
    public $tramite_id;
    public $documento;
    public $tipo;
    public $estado;

    public $fecha_entrega;
    public $hora_entrega;
    public $estado_entrega;
    public $receptor;
    public $observaciones;
    

    public function mount()
    {
        // CA2: Traer lista de notificaciones en estado "Finalizado"
        $this->notificaciones = Notificacion::where('estado', 'Finalizado')->get();

        // CA3: Fecha/Hora por defecto
        $this->fecha_entrega = now()->format('Y-m-d');
        $this->hora_entrega  = now()->format('H:i');
    }

public function updatedSelectedNotificacionId($id)
{
    $noti = Notificacion::find($id);

    if ($noti) {
        $this->tramite_id = $noti->tramite_id;
        $this->documento  = $noti->documento;
        $this->tipo       = $noti->tipo;
        $this->estado     = $noti->estado;
    }
}

    public function registrarEntrega()
    {
        // CA4: Validar campos críticos
        $this->validate([
            'selectedNotificacionId' => 'required|exists:notificacions,id',
            'fecha_entrega'          => 'required|date',
            'hora_entrega'           => 'required',
            'estado_entrega'         => 'required|string',
            'receptor'               => 'required|string|min:3',
        ]);

        $noti = Notificacion::find($this->selectedNotificacionId);

        // CA7: Actualizar la notificación y cambiar su estado a "Finalizado"
        $noti->update([
            'fecha_entrega'  => Carbon::parse("{$this->fecha_entrega} {$this->hora_entrega}"),
            'estado_entrega' => $this->estado_entrega,
            'receptor'       => $this->receptor,
            'observaciones'  => $this->observaciones,
            'estado'         => 'Finalizado',
        ]);

        // CA9: Mensaje de éxito
        session()->flash('success', '✅ Registro de Notificación procesado correctamente.');
    }

    public function render()
    {
        return view('livewire.mesadepartes-registro');
    }
}