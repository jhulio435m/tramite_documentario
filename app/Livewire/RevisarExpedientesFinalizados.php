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
            // Actualiza estado del expediente
            DB::table('expedientes')
                ->where('id', $this->expedienteSeleccionado->id)
                ->update([
                    'estado' => 'Finalizado',
                    'observaciones' => $this->mensajeNotificacion,
                    'updated_at' => now(),
                ]);

            // Agrega notificación para el solicitante
            DB::table('notificaciones')->insert([
                'expediente_id' => $this->expedienteSeleccionado->id,
                'mensaje' => $this->mensajeNotificacion ?? 'Su expediente ha sido finalizado',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Redirige recargando la vista con mensaje de éxito
            return redirect()->route('revisarExpedientesFinalizados')
                ->with('success', 'Expediente marcado como finalizado y notificación enviada.');
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
