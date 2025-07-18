<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expediente;

class VerificacionExpediente extends Component
{
    public $expedientes;
    public $expedienteSeleccionado = null;

    public function mount()
    {
        $this->expedientes = Expediente::all();
    }

    public function seleccionarExpediente($id)
    {
        $this->expedienteSeleccionado = Expediente::find($id);
    }

    public function validarExpediente()
    {
        if ($this->expedienteSeleccionado) {
            $this->expedienteSeleccionado->estado = 'Aprobado';
            $this->expedienteSeleccionado->fecha_validacion = now();
            $this->expedienteSeleccionado->save();

            $this->reset('expedienteSeleccionado');
            $this->expedientes = Expediente::all();
        }
    }
    public function rechazarExpediente(){
        if ($this->expedienteSeleccionado) {
            $this->expedienteSeleccionado->estado = 'Rechazado';
            $this->expedienteSeleccionado->save();

            $this->reset('expedienteSeleccionado');
            $this->expedientes = Expediente::all();
        }
    }

    public function render()
    {
        return view('livewire.verificacion-expediente');
    }
}
