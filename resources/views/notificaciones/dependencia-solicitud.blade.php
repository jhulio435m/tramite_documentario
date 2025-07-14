@extends('layouts.notificaciones')

@section('title', 'Solicitud de Notificación')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        ✅ {{ session('success') }}
    </div>
@endif

<div class="card-custom">
    <h4 class="mb-3 text-warning">📬 Solicitud de Notificación a Mesa de Partes</h4>

    <form method="POST" action="{{ route('notificaciones.store') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">ID del Trámite</label>
                <input type="text" name="tramite_id" class="form-control" placeholder="Ej: TRM2025" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Fecha y Hora de Solicitud</label>
                <input type="datetime-local" name="fecha_solicitud" class="form-control" value="{{ now()->format('Y-m-d\TH:i') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Documento o Resultado a Notificar</label>
            <input type="text" name="documento" class="form-control" placeholder="Ej: Resolución N°123" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Tipo de Notificación</label>
            <select name="tipo" class="form-select" required>
                <option value="">Seleccione...</option>
                <option value="Personal">Personal</option>
                <option value="Correo electrónico">Correo electrónico</option>
                <option value="Vía digital">Vía digital</option>
            </select>
        </div>

        <hr class="text-secondary">

        <h5 class="fw-bold text-success">📇 Datos del Destinatario</h5>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Nombre del Destinatario</label>
                <input type="text" name="destinatario_nombre" class="form-control" placeholder="Ej: Juan Pérez" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Dirección</label>
                <input type="text" name="destinatario_direccion" class="form-control" placeholder="Ej: Av. Universitaria 123" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Correo / Contacto</label>
            <input type="email" name="destinatario_contacto" class="form-control" placeholder="Ej: juanperez@email.com" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Funcionario que Solicita</label>
            <input type="text" name="funcionario" class="form-control" placeholder="Ej: Lic. Mariana Torres" required>
        </div>

        <button type="submit" class="btn btn-yellow">📨 Enviar Solicitud</button>
    </form>
</div>
@endsection
