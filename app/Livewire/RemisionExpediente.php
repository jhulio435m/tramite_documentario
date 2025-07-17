<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expediente;
use Carbon\Carbon;

class RemisionExpediente extends Component
{
    public $expedienteId;
    public $expediente;
    public $medioEnvio = 'Sistema eDoc';
    public $confirmacion = false;
    public $timestampEnvio = null;

    public function mount($expedienteId)
    {
        $this->expediente = Expediente::find($expedienteId);
        $this->expedienteId = $expedienteId;
        $this->timestampEnvio = $this->expediente->fecha_envio ?? null;
    }

    public function enviar()
    {
        if ($this->expediente) {
            $this->expediente->medio_envio = $this->medioEnvio;
            $this->expediente->estado = 'Remitido';
            $this->expediente->fecha_envio = now();
            $this->expediente->save();

            $this->confirmacion = true;
            $this->timestampEnvio = $this->expediente->fecha_envio;
        }
    }

    public function render()
    {
        return view('livewire.remision-expediente');
    }
}
