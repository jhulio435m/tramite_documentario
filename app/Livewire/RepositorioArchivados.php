<?php

namespace App\Livewire;

use Livewire\Component;

class BandejaExpedientes extends Component
{
    public $pantalla = 'facultades';
    public $facultadSeleccionada = null;
    public $tramiteSeleccionado = null;

    public $facultades = [
        'Facultad de Ingeniería',
        'Facultad de Derecho',
        'Ciencias Administrativas',
    ];

    public $tramites = [
        'Facultad de Ingeniería' => [
            'Solicitud Académica',
            'Registro de Proyecto',
            'Actualización de Datos',
        ],
        'Facultad de Derecho' => [
            'Solicitud Académica',
            'Registro de Proyecto',
            'Actualización de Datos',
        ],
        'Ciencias Administrativas' => [
            'Solicitud Académica',
            'Registro de Proyecto',
            'Actualización de Datos',
        ],
    ];

    public function abrirTramites($facultad)
    {
        $this->facultadSeleccionada = $facultad;
        $this->pantalla = 'tramites';
    }

    public function volverFacultades()
    {
        $this->pantalla = 'facultades';
        $this->facultadSeleccionada = null;
    }

    public function abrirDetalle($tramite)
    {
        $this->tramiteSeleccionado = $tramite;
        $this->pantalla = 'detalle';
    }

    public function volverTramites()
    {
        $this->pantalla = 'tramites';
        $this->tramiteSeleccionado = null;
    }

    public function render()
    {
        return view('livewire.bandeja-expedientes');
    }
}