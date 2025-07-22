<?php

namespace App\Livewire;

use Livewire\Component;

class TramitesLista extends Component
{
    public $types = [
        'Constancia de expedito para optar título profesional',
        'Constancia de expedito para grado de bachiller',
        'Constancia de prácticas preprofesionales/internado',
        'Constancia de inscripción, aprobación y asesoramiento del plan de tesis',
        'Constancia de egresado (bachiller y título profesional)',
        'Certificado de estudios de pregrado (formato 1)',
        'Certificado de prácticas preprofesionales y profesionales',
        'Constancia de récord académico, estudios, matrícula y otros',
        'Constancia con orden de mérito: décimo, quinto, tercio superior',
        'Cambio de título del plan de tesis / Cambio de asesor',
        'Ampliación de plazo para conclusión de ejecución de tesis',
        'Otorgar el título profesional',
        'Otorgar grado académico de maestro, doctor y título de segunda especialidad profesional',
        'Otros trámites',
    ];

    public function verDetalle($tramite)
    {
        // Mapeo de trámites a sus rutas correspondientes
        $rutasTramites = [
            'Constancia de expedito para optar título profesional' => 'constancia_expedito_profesional',
            'Constancia de expedito para grado de bachiller' => 'constancia_expedito_bachiller',
            'Constancia de prácticas preprofesionales/internado' => 'constancia_practicas_preprofesionales',
            'Constancia de inscripción, aprobación y asesoramiento del plan de tesis' => 'constancia_plan_tesis',
            'Constancia de egresado (bachiller y título profesional)' => 'constancia_egresado',
            'Certificado de estudios de pregrado (formato 1)' => 'certificado_estudios_pregrado',
            'Certificado de prácticas preprofesionales y profesionales' => 'certificado_practicas',
            'Constancia de récord académico, estudios, matrícula y otros' => 'constancia_record_academico',
            'Constancia con orden de mérito: décimo, quinto, tercio superior' => 'constancia_orden_merito',
            'Cambio de título del plan de tesis / Cambio de asesor' => 'cambio_titulo_asesor',
            'Ampliación de plazo para conclusión de ejecución de tesis' => 'ampliacion_plazo_tesis',
            'Otorgar el título profesional' => 'otorgar_titulo_profesional',
            'Otorgar grado académico de maestro, doctor y título de segunda especialidad profesional' => 'otorgar_grado_academico',
            'Otros trámites' => 'otros_tramites',
        ];

        // Verificar si existe la ruta para el trámite seleccionado
        if (isset($rutasTramites[$tramite])) {
            // Usar redirectRoute en lugar de redirect()->route() para Livewire
            $this->redirectRoute($rutasTramites[$tramite]);
        } else {
            // Si no existe la ruta, mostrar mensaje
            session()->flash('message', 'Este trámite estará disponible próximamente');
        }
    }

    public function render()
    {
        return view('livewire.tramites-lista');
    }
}