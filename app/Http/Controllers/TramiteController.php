<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TramiteController extends Controller
{
    public function listaTramites()
    {
        return view('Tramites.listaTramites');
    }

    public function show($id)
    {
        // Base de datos simulada de trámites por ID
        $tramites = [
            0 => [
                'titulo' => 'CONSTANCIA DE EXPEDITO PARA OPTAR TÍTULO PROFESIONAL',
                'descripcion' => 'CONSTANCIA DE EXPEDITO PARA OPTAR TÍTULO PROFESIONAL',
                'duracion' => '5 días hábiles',
                'area' => 'Unidad de Administración Documentaria ',
                'dependencia' => 'Sin asignar',
                'requisitos' => [
                    'Solicitud dirigida al Decano de la Facultad',
                    'Informe y reporte de originalidad del software detector de similitud (Turnitin) con un porcentaje máximo de similitud del 25% y firma del asesor en todas las hojas',
                    'Informe de los (03) tres revisores, por lo menos dos de ellos favorables',
                    'Informe de culminación de asesoría de tesis del docente asesor',
                    'Constancia única de no adeudo (CUNA) con antigüedad no mayor de seis meses',
                    'Constancia de inscripción del plan de tesis',
                    'Diploma del grado académico de bachiller escaneado ambas caras',
                    'Constancia de inscripción SUNEDU del grado académico de bachiller',
                    'Declaración jurada simple de no tener antecedentes penales ni judiciales',
                    'Constancia de egresado',
                    'Certificado de estudios',
                    'Ficha de matrícula del primer semestre',
                    'Pago por derecho de constancia - Costo: S/. 5.00',
                    'Pago por derecho de ficha estadística - Costo: S/. 2.00',
                    'Pago por derecho de diploma de título profesional - Costo: S/. 188.00',
                    'Pago por derecho de trámite documentario - Costo: S/. 3.00',
                    'Archivo SUNEDU (en .rar)',
                ]
            ],
            1 => [
                'titulo' => 'CONSTANCIA DE EXPEDITO PARA GRADO DE BACHILLER',
                'descripcion' => 'CONSTANCIA DE EXPEDITO PARA GRADO DE BACHILLER',
                'duracion' => '30 días',
                'area' => 'Unidad de Administración Documentaria',
                'dependencia' => 'Sin Asignar',
                'requisitos' => [
                    'Solicitud dirigida al Decano de la Facultad',
                    'Constancia de egresado',
                    'Constancia de prácticas preprofesionales/internado',
                    'Certificado de proyección social',
                    'Certificado de estudios',
                    'Certificado de ofimática',
                    'Certificado de idioma extranjero o lengua nativa - nivel básico (ingresantes 2011-II)',
                    'Constancia única de no adeudo (CUNA) con antigüedad no mayor de seis meses',
                    'Declaración jurada simple de no tener antecedentes penales ni judiciales',
                    'Ficha de matrícula del primer semestre',
                    'En caso de traslado (interno y/o externo) y segunda carrera, deberán adjuntar la resolución de convalidación de asignaturas y cuadro de convalidaciones',
                    'Pago por derecho de constancia - Costo: S/. 5.00',
                    'Pago por derecho de diploma de bachiller - Costo: S/. 110.00',
                    'Pago por derecho de diploma de título profesional - Costo: S/. 188.00',
                    'Pago por derecho de ficha estadística - Costo: S/. 2.00',
                    'Pago por derecho de trámite documentario - Costo: S/. 3.00',
                    'Archivo SUNEDU (en .rar)',
                ]
            ],
            2 => [
                'titulo' => 'CONSTANCIA DE PRÁCTICAS PREPROFESIONALES/INTERNADO',
                'descripcion' => 'CONSTANCIA DE PRÁCTICAS PREPROFESIONALES/INTERNADO',
                'duracion' => '3 días',
                'area' => 'Unidad de Administración Documentaria',
                'dependencia' => 'Sin asignar',
                'requisitos' => [
                    'Solicitud dirigida al decano de la facultad',
                    'Pago por derecho de trámite documentario - costo : s/. 3.00',
                    'Pago por derecho de constancia - costo : s/. 5.00',
                    'Constancias del centro de salud del internado comunitario y/o clínico (solo enfermería)',
                    'Certificado de capacitación aprobado (solo enfermería)',
                    'Caso de estudio clínico (solo enfermería)',
                    'Instrumentos de evaluación con nota aprobatoria (solo enfermería)',
                ]
            ],
        ];

        // Validación: si el ID no existe en el array
        if (!array_key_exists($id, $tramites)) {
            abort(404, 'Trámite no encontrado');
        }

        return view('Tramites.tramite0', $tramites[$id]);
    }
}

