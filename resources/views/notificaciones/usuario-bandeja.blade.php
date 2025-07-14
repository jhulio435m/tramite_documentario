@extends('layouts.notificaciones')

@section('title', 'Mis Notificaciones - Usuario')

@section('content')
<div class="card-custom">
    <h4 class="mb-3 text-warning">📩 Mis Notificaciones</h4>

    {{-- Mensaje si hay nuevas notificaciones --}}
    <div class="alert alert-info fw-bold">
        🔔 Tiene 1 notificación nueva disponible
    </div>

    {{-- Listado de notificaciones entregadas --}}
    <div class="bg-white p-3 rounded shadow-sm">
        <h6 class="text-dark fw-bold">📄 Notificaciones Recibidas</h6>

        <div class="mt-3 border p-3 rounded">
            <div class="mb-2">
                <strong class="text-dark">ID del Trámite:</strong> TRM1001
            </div>
            <div class="mb-2">
                <strong class="text-dark">Estado del Trámite:</strong> Finalizado
            </div>
            <div class="mb-2">
                <strong class="text-dark">Mensaje del Operador:</strong>
                <div class="bg-light p-2 rounded">
                    Su constancia ha sido procesada exitosamente. Puede descargarla desde el siguiente enlace o acercarse a la oficina.
                </div>
            </div>
            <div class="mb-3">
                <strong class="text-dark">Documento Adjunto:</strong>
                <a href="#" class="btn btn-sm btn-outline-primary ms-2">📎 Ver Constancia.pdf</a>
            </div>

            <div class="text-end">
                <button class="btn btn-yellow">✅ Marcar como Leída</button>
            </div>
        </div>
    </div>
</div>
@endsection
