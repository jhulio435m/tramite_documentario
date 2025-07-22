<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notificacion;
use Illuminate\Http\Request;

class MesadepartesArchivar extends Component
{
    public $expedientesActivos = [];
    public $expedientesArchivados = [];
    public $buscar;
    public $fecha;

    public function mount()
    {
        $this->expedientesActivos = Notificacion::where('estado', 'Finalizado')->get();
        $this->actualizarArchivados();
    }

    public function updated($property)
    {
        if ($property === 'buscar' || $property === 'fecha') {
            $this->actualizarArchivados();
        }
    }

    public function actualizarArchivados()
    {
        $query = Notificacion::where('estado', 'Archivado');

        if ($this->buscar) {
            $query->where('numero_expediente', 'like', "%{$this->buscar}%");
        }

        if ($this->fecha) {
            $query->whereDate('fecha_archivo', $this->fecha);
        }

        $this->expedientesArchivados = $query->get();
    }

    public function render()
    {
        return view('livewire.mesadepartes-archivar');
    }
}