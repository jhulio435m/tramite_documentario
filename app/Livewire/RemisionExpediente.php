<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expediente;

class RemisionExpediente extends Component
{
    public $expedienteId;
    public $expediente = null;
    public $medio = 'Sistema eDoc';

    public function mount($expedienteId = null)
    {
        $this->expedienteId = $expedienteId;

        if ($expedienteId) {
            $this->expediente = Expediente::find($expedienteId);
        }
    }

    public function enviarExpediente()
    {
        if (!$this->expediente) return;

        $this->expediente->estado = 'Enviado';
        $this->expediente->medio_envio = $this->medio;
        $this->expediente->fecha_envio = now();
        $this->expediente->save();

        return redirect()->route('verificacionExpediente')->with('success', 'Expediente enviado correctamente a las ' . now()->format('g:i A d/m/Y'));
    }

    public function render()
    {
        return view('livewire.remision-expediente');
    }
}
