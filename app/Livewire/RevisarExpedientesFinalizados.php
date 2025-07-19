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
        $this->expedientes = DB::table('expedientes')
            ->where(function($query) {
                $query->where('estado', 'Canalizado')
                      ->orWhere(function($q) {
                          $q->where('estado', 'Enviado')
                            ->where('medio_envio', 'Sistema eDoc');
                      });
            })
            ->orderByDesc('fecha_envio')
            ->get();
    }

    public function seleccionarExpediente($id)
    {
        $this->expedienteSeleccionado = DB::table('expedientes')->find($id);
        $this->mensajeNotificacion = '';
    }

    public function marcarComoFinalizado()
    {
        if ($this->expedienteSeleccionado) {
            DB::table('expedientes')
                ->where('id', $this->expedienteSeleccionado->id)
                ->update([
                    'estado' => 'Finalizado',
                    'observaciones' => $this->mensajeNotificacion,
                    'updated_at' => now(),
                ]);

            session()->flash('success', 'Expediente marcado como Finalizado.');
            $this->expedienteSeleccionado = null;
            $this->mensajeNotificacion = '';
            $this->cargarExpedientes();
        }
    }

    public function cancelarSeleccion()
    {
        $this->expedienteSeleccionado = null;
        $this->mensajeNotificacion = '';
    }

    public function render()
    {
        return view('livewire.revisar-expedientes-finalizados');
    }
}
