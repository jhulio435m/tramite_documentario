<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PanelSeguimiento extends Component
{
    public $resumen = [];
    public $expedientes = [];

    public $fechaInicio;
    public $fechaFin;

    public function mount()
    {
        $this->cargarDatos();
    }

    public function cargarDatos()
    {
        // Conteo general sin filtro (para mantener el resumen completo)
        $this->resumen = DB::table('expedientes')
            ->select('status_id', DB::raw('count(*) as total'))
            ->groupBy('status_id')
            ->pluck('total', 'status_id')
            ->toArray();

        // Filtro por fechas (si están definidos)
        $query = DB::table('expedientes')->orderByDesc('updated_at');

        if ($this->fechaInicio) {
            $query->whereDate('updated_at', '>=', $this->fechaInicio);
        }
        if ($this->fechaFin) {
            $query->whereDate('updated_at', '<=', $this->fechaFin);
        }

        $this->expedientes = $query->limit(20)->get();
    }

    public function render()
    {
        return view('livewire.panel-seguimiento');
    }
}
