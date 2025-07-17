<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expediente;

class VerificacionExpediente extends Component
{
    public $expedientes;
    public $expedienteSeleccionado = null;
    public $observaciones = '';

    public function mount()
    {
        $this->expedientes = Expediente::all();
    }

    public function seleccionarExpediente($id)
    {
        $this->expedienteSeleccionado = Expediente::find($id);
        $this->observaciones = $this->expedienteSeleccionado->observaciones ?? '';
    }

    public function validarExpediente()
    {
        if ($this->expedienteSeleccionado) {
            $this->expedienteSeleccionado->estado = 'Aprobado';
            $this->expedienteSeleccionado->observaciones = $this->observaciones;
            $this->expedienteSeleccionado->save();

            $this->reset('expedienteSeleccionado', 'observaciones');
            $this->expedientes = Expediente::all();
        }
    }

    public function rechazarExpediente()
    {
        if ($this->expedienteSeleccionado) {
            $this->expedienteSeleccionado->estado = 'Rechazado';
            $this->expedienteSeleccionado->observaciones = $this->observaciones;
            $this->expedienteSeleccionado->save();

            $this->reset('expedienteSeleccionado', 'observaciones');
            $this->expedientes = Expediente::all();
        }
    }

    public function render()
    {
        return view('livewire.verificacion-expediente');
    }
}
