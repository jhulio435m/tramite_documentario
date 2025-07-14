@extends('layouts.notificaciones')

@section('title', 'Elaboración de la Notificación - Mesa de Partes')

@section('content')
<div class="card-custom">
    <h4 class="mb-3 text-warning">✏️ Elaboración de la Notificación</h4>

    <!-- Información del trámite -->
    <div class="bg-white rounded p-3 mb-4 shadow-sm">
        <h6 class="text-dark fw-bold">📄 Información del Trámite</h6>
        <div class="row mt-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">ID Trámite</label>
                <div class="form-control bg-light">{{ $notificacion->tramite_id }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tipo</label>
                <div class="form-control bg-light">{{ $notificacion->tipo }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nombre del Solicitante</label>
                <div class="form-control bg-light">{{ $notificacion->destinatario_nombre }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Dirección del Solicitante</label>
                <div class="form-control bg-light">{{ $notificacion->destinatario_direccion }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Contacto del Solicitante</label>
                <div class="form-control bg-light">{{ $notificacion->destinatario_contacto }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Funcionario Responsable</label>
                <div class="form-control bg-light">{{ $notificacion->funcionario }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Fecha de Presentación</label>
                <div class="form-control bg-light">{{ \Carbon\Carbon::parse($notificacion->fecha_solicitud)->format('Y-m-d H:i') }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Estado Actual</label>
                <div class="form-control bg-light text-warning fw-bold">{{ $notificacion->estado }}</div>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label fw-bold">Documento a Entregar</label>
                <div class="form-control bg-light">{{ $notificacion->documento }}</div>
            </div>
        </div>
    </div>

    @if($notificacion->estado === 'Pendiente')
    <!-- Formulario para redactar mensaje y subir documento -->
    <form method="POST" action="{{ route('notificaciones.finalizar', $notificacion->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Redactar Mensaje de Notificación</label>
            <textarea name="mensaje" class="form-control" rows="4" placeholder="Redacte aquí el mensaje que se notificará al ciudadano..." required>{{ old('mensaje') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Adjuntar Documento Final (PDF)</label>
            <input type="file" name="archivo" class="form-control" accept="application/pdf">
        </div>
        <button type="submit" class="btn btn-success">✅ Guardar Notificación</button>
    </form>
    @else
        <div class="alert alert-info mt-3">Esta notificación ya fue finalizada y está lista para entrega.</div>
    @endif
</div>
@endsection
