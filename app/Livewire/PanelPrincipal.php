<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tramite;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PanelPrincipal extends Component
{
    public $tramitesPendientes = [];
    public $tramiteSeleccionado = null;
    public $pendientes = 0;
    public $enProceso = 0;
    public $completados = 0;
    public $derivados = 0;

    // Propiedades para filtros de fecha
    public $fechaDesde = null;
    public $fechaHasta = null;

    public function mount()
    {
        $this->cargarDatos();
    }

    public function cargarDatos()
    {
        $usuarioActual = Auth::user();
        
        // Query base para trámites del usuario
        $queryPendientes = Tramite::where('estado', 'Pendiente')
                                 ->where('funcionario_destinatario', $usuarioActual->email);

        // Aplicar filtros de fecha si están presentes
        if ($this->fechaDesde) {
            $queryPendientes->whereDate('fecha_inicio', '>=', $this->fechaDesde);
        }
        
        if ($this->fechaHasta) {
            $queryPendientes->whereDate('fecha_inicio', '<=', $this->fechaHasta);
        }

        $this->tramitesPendientes = $queryPendientes->orderBy('created_at', 'desc')->get();

        // Si hay trámites pendientes y no hay uno seleccionado, seleccionar el primero
        if ($this->tramitesPendientes->isNotEmpty() && !$this->tramiteSeleccionado) {
            $this->tramiteSeleccionado = $this->tramitesPendientes->first();
        }

        // Estadísticas (sin filtros de fecha para mantener vista general)
        $this->pendientes = Tramite::where('estado', 'Pendiente')
                                ->where('funcionario_destinatario', $usuarioActual->email)
                                ->count();
        
        $this->enProceso = Tramite::whereIn('estado', ['En Revisión', 'Atendido'])
                                ->where('funcionario_destinatario', $usuarioActual->email)
                                ->count();
        
        $this->completados = Tramite::whereIn('estado', ['Aprobado', 'Finalizado'])
                                ->where('funcionario_destinatario', $usuarioActual->email)
                                ->count();
        
        $this->derivados = Tramite::where('estado', 'Derivado')
                                ->where('funcionario_destinatario', $usuarioActual->email)
                                ->count();
    }

    // Método para aplicar filtros
    public function aplicarFiltros()
    {
        $this->cargarDatos();
        
        // Limpiar selección si el trámite seleccionado ya no está en los resultados
        if ($this->tramiteSeleccionado && !$this->tramitesPendientes->contains('id', $this->tramiteSeleccionado->id)) {
            $this->tramiteSeleccionado = $this->tramitesPendientes->first();
        }
    }

    // Método para limpiar filtros
    public function limpiarFiltros()
    {
        $this->fechaDesde = null;
        $this->fechaHasta = null;
        $this->cargarDatos();
    }

    // Watcher para actualizar automáticamente cuando cambien las fechas
    public function updatedFechaDesde()
    {
        $this->aplicarFiltros();
    }

    public function updatedFechaHasta()
    {
        $this->aplicarFiltros();
    }

    public function seleccionarTramite($tramiteId)
    {
        $tramite = Tramite::where('id', $tramiteId)
                          ->where('funcionario_destinatario', Auth::user()->email)
                          ->first();
        
        if ($tramite) {
            $this->tramiteSeleccionado = $tramite;
        }
    }

    public function marcarAtendido($tramiteId)
    {
        $tramite = Tramite::where('id', $tramiteId)
                      ->where('funcionario_destinatario', Auth::user()->email)
                      ->first();
        
        if ($tramite) {
            $tramite->estado = 'Atendido';
            $tramite->save();

            $this->cargarDatos();
            
            if ($this->tramiteSeleccionado && $this->tramiteSeleccionado->id == $tramiteId) {
                $this->tramiteSeleccionado = $this->tramitesPendientes->first();
            }

            session()->flash('success', 'El trámite se ha marcado como "Atendido".');
        }
    }

    public function aprobar($tramiteId)
    {
        $tramite = Tramite::where('id', $tramiteId)
                          ->where('funcionario_destinatario', Auth::user()->email)
                          ->first();
        
        if ($tramite) {
            $tramite->estado = 'Aprobado';
            $tramite->save();

            $this->cargarDatos();
            
            if ($this->tramiteSeleccionado && $this->tramiteSeleccionado->id == $tramiteId) {
                $this->tramiteSeleccionado = $this->tramitesPendientes->first();
            }

            session()->flash('success', 'El trámite se ha aprobado correctamente.');
        }
    }

    public function finalizar($tramiteId)
    {
        $tramite = Tramite::where('id', $tramiteId)
                          ->where('funcionario_destinatario', Auth::user()->email)
                          ->first();
        
        if ($tramite) {
            $tramite->estado = 'Finalizado';
            $tramite->save();

            $this->cargarDatos();
            
            if ($this->tramiteSeleccionado && $this->tramiteSeleccionado->id == $tramiteId) {
                $this->tramiteSeleccionado = $this->tramitesPendientes->first();
            }

            session()->flash('success', 'El trámite se ha finalizado correctamente.');
        }
    }

    public function derivar($tramiteId)
    {
        $tramite = Tramite::where('id', $tramiteId)
                          ->where('funcionario_destinatario', Auth::user()->email)
                          ->first();
        
        if ($tramite) {
            $tramite->estado = 'Derivado';
            $tramite->save();

            $this->cargarDatos();
            
            if ($this->tramiteSeleccionado && $this->tramiteSeleccionado->id == $tramiteId) {
                $this->tramiteSeleccionado = $this->tramitesPendientes->first();
            }

            session()->flash('success', 'El trámite se ha derivado correctamente.');
        }
    }

    public function render()
    {
        return view('livewire.panel-principal');
    }
}