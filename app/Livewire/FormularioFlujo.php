<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class FormularioFlujo extends Component
{
    use WithFileUploads;

    public $codigo, $solicitante, $asunto, $tipo_documento;
    public $area_procedencia, $fecha_recepcion, $documento;
    public $observaciones;

    public function archivar()
    {
        $this->validate([
            'codigo' => 'required',
            'solicitante' => 'required',
            'asunto' => 'required',
            'tipo_documento' => 'required',
            'area_procedencia' => 'required',
            'fecha_recepcion' => 'required|date',
            'documento' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'observaciones' => 'nullable|string',
        ]);

        $documentoPath = $this->documento?->store('documentos', 'public');

        // Aquí puedes guardar los datos en la tabla 'expedientes' o alguna tabla personalizada
        // Por ahora solo mostramos que se completó:
        session()->flash('success', 'Flujo personalizado archivado correctamente.');

        $this->limpiar();
    }

    public function limpiar()
    {
        $this->reset([
            'codigo', 'solicitante', 'asunto', 'tipo_documento',
            'area_procedencia', 'fecha_recepcion', 'documento', 'observaciones'
        ]);
    }

    public function cancelar()
    {
        return redirect()->route('verificacionExpediente');
    }

    public function render()
    {
        return view('livewire.formulario-flujo');
    }
}
