<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class RevisarExpedientesFinalizados extends Component
{
    public $expedientes = [];
    public $expedienteSeleccionado = null;

    public $mensajeNotificacion = '';

    public function mount()
    {
        $this->cargarExpedientes();
    }

    public function cargarExpedientes()
    {
        // Carga expedientes en estado 'Enviado' o 'Canalizado'
        $this->expedientes = DB::table('expedientes')
            ->whereIn('estado', ['Enviado', 'Canalizado'])
            ->orderByDesc('fecha_envio')
            ->get();
    }

    public function seleccionarExpediente($id)
    {
        $this->expedienteSeleccionado = DB::table('expedientes')->find($id);
    }

    public function cancelarSeleccion()
    {
        $this->expedienteSeleccionado = null;
        $this->mensajeNotificacion = '';
    }

    public function marcarComoFinalizado()
    {
        if (!$this->expedienteSeleccionado) return;

        // Actualizar estado a 'Finalizado'
        DB::table('expedientes')
            ->where('id', $this->expedienteSeleccionado->id)
            ->update([
                'estado' => 'Finalizado',
                'updated_at' => now(),
                'observaciones' => $this->mensajeNotificacion,
            ]);

        // Podrías aquí enviar notificación real (correo, etc.)
        // Por ahora, solo limpiamos selección y recargamos lista
        $this->expedienteSeleccionado = null;
        $this->mensajeNotificacion = '';

        session()->flash('success', 'Expediente marcado como finalizado y solicitante notificado.');
        $this->cargarExpedientes();
    }

    public function render()
    {
        return view('livewire.revisar-expedientes-finalizados');
    }
}
