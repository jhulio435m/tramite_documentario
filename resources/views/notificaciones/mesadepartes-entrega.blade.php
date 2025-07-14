@extends('layouts.notificaciones')

@section('title', 'Entrega de Notificación - Mesa de Partes')

@section('content')
<div class="card-custom">
    <h4 class="mb-3 text-warning">📤 Entrega de Notificación</h4>

    <!-- Información del trámite real -->
    <div class="bg-white rounded p-3 mb-4 shadow-sm">
        <h6 class="text-dark fw-bold">📄 Información del Trámite</h6>
        <div class="row mt-2">
            <div class="col-md-6 mb-2">
                <label class="form-label fw-bold">ID del Trámite</label>
                <div class="form-control bg-light">{{ $notificacion->tramite_id }}</div>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label fw-bold">Nombre del Ciudadano</label>
                <div class="form-control bg-light">{{ $notificacion->destinatario_nombre }}</div>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label fw-bold">Tipo de Trámite</label>
                <div class="form-control bg-light">{{ $notificacion->tipo }}</div>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label fw-bold">Estado Actual</label>
                <div class="form-control bg-light text-warning fw-bold">{{ $notificacion->estado }}</div>
            </div>
        </div>
    </div>

    @if($notificacion->estado === 'Lista para entrega')
    <!-- Formulario de entrega -->
    <form method="POST" action="{{ route('notificaciones.mesadepartes.entregar', $notificacion->id) }}">
        @csrf
        <div class="text-center mb-3">
            <button type="submit" class="btn btn-yellow fw-bold">📬 Entregar Notificación</button>
        </div>
    </form>
    @elseif($notificacion->estado === 'Entregada')
        <div class="alert alert-success text-center fw-bold">
            ✅ La notificación ya fue entregada exitosamente al ciudadano.
        </div>
    @else
        <div class="alert alert-info text-center fw-bold">
            Solo se pueden entregar notificaciones que estén listas para entrega.
        </div>
    @endif
</div>
@endsection
