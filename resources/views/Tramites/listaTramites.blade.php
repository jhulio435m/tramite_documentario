@extends('layouts.app')

@section('title', 'Listado de Trámites')

@section('content')
    <h2>Listado de Trámites</h2>

    @php
        $tramites = [
            'Constancia de expedito para optar título profesional',
            'Constancia de expedito para grado de bachiller',
            'Constancia de prácticas preprofesionales/profesional',
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
            'Otros trámites'
        ];
    @endphp

    @foreach ($tramites as $tramite)
        <div class="tramite">
            <span class="tramite-text">{{ $tramite }}</span>
            <a href="{{ route('tramites.show', ['id' => $loop->index]) }}">
                <button>Ver Trámite</button>
            </a>
        </div>
    @endforeach
@endsection
