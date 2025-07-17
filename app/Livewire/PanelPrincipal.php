<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tramite;

class PanelPrincipal extends Component
{
    public $tramitesRecientes = [];
    public $pendientes = 0;
    public $enProceso = 0;
    public $completados = 0;
    public $derivados = 0;

    public function mount()
    {
        $this->cargarDatos();
    }

    public function cargarDatos()
    {
        // Consultar la base de datos
        $tramites = Tramite::orderBy('created_at', 'desc')->get();

        $this->tramitesRecientes = $tramites;

        // Calcular estadísticas
        $this->pendientes = $tramites->where('estado', 'Pendiente')->count();
        $this->enProceso = $tramites->whereIn('estado', ['En Revisión', 'Atendido'])->count();
        $this->completados = $tramites->whereIn('estado', ['Aprobado', 'Finalizado'])->count();
        $this->derivados = $tramites->where('estado', 'Derivado')->count();
    }

    public function marcarAtendido($tramiteId)
    {
        $tramite = Tramite::findOrFail($tramiteId);
        $tramite->estado = 'Atendido';
        $tramite->save();

        $this->cargarDatos();
        session()->flash('success', 'El trámite se ha marcado como "Atendido".');
    }

    public function aprobar($tramiteId)
    {
        $tramite = Tramite::findOrFail($tramiteId);
        $tramite->estado = 'Aprobado';
        $tramite->save();

        $this->cargarDatos();
        session()->flash('success', 'El trámite se ha aprobado correctamente.');
    }

    public function finalizar($tramiteId)
    {
        $tramite = Tramite::findOrFail($tramiteId);
        $tramite->estado = 'Finalizado';
        $tramite->save();

        $this->cargarDatos();
        session()->flash('success', 'El trámite se ha finalizado correctamente.');
    }

    public function derivar($tramiteId)
    {
        $tramite = Tramite::findOrFail($tramiteId);
        $tramite->estado = 'Derivado';
        $tramite->save();

        $this->cargarDatos();
        session()->flash('success', 'El trámite se ha derivado correctamente.');
    }

    public function render()
    {
        return view('livewire.panel-principal');
    }
}
