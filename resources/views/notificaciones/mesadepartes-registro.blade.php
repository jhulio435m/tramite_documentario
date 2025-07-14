@extends('layouts.notificaciones')

@section('title', 'Registro de Entrega - Mesa de Partes')

@section('content')
<div class="card-custom">
    <h4 class="mb-3 text-warning">📑 Registro de Entrega</h4>
    <form onsubmit="return validarRegistro();" id="formRegistro">
        <div class="row">
            <!-- CA2: Identificador del Trámite -->
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">ID del Trámite</label>
                <select class="form-select" required>
                    <option value="">Seleccione una opción</option>
                    <option value="TRM1001">TRM1001 - Constancia</option>
                    <option value="TRM1002">TRM1002 - Informe</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Número de Expediente</label>
                <input type="text" class="form-control" placeholder="Ej: EXP-2025-015" required>
            </div>

            <!-- CA3: Fecha y hora -->
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Fecha de Entrega</label>
                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Hora de Entrega</label>
                <input type="time" class="form-control" value="{{ date('H:i') }}" required>
            </div>

            <!-- CA3: Estado de entrega -->
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Estado de la Entrega</label>
                <select class="form-select" required>
                    <option value="">Seleccione una opción</option>
                    <option value="Entregado">Entregado</option>
                    <option value="No entregado">No entregado</option>
                    <option value="Rechazado">Rechazado</option>
                    <option value="Pendiente">Pendiente</option>
                </select>
            </div>

            <!-- Tipo / Estado del Trámite -->
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tipo / Nombre del Trámite</label>
                <input type="text" class="form-control" placeholder="Ej: Constancia de Matrícula" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Estado Actual del Trámite</label>
                <select class="form-select" required>
                    <option>Pendiente</option>
                    <option>Finalizado</option>
                    <option>Rechazado</option>
                </select>
            </div>

            <!-- Receptor y observaciones -->
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nombre del Receptor</label>
                <input type="text" class="form-control" placeholder="Ej: Juan Pérez" required>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label fw-bold">Observaciones</label>
                <textarea class="form-control" rows="3" placeholder="Detalles adicionales del registro..."></textarea>
            </div>
        </div>

        <!-- Botón para registrar -->
        <div class="text-end">
            <button class="btn btn-yellow fw-bold">📋 Registrar Entrega</button>
        </div>

        <!-- Confirmación visual post-registro -->
        <div id="mensajeConfirmacion" class="alert alert-success d-none mt-3">
            ✅ Entrega registrada correctamente. Esta información se añadirá a la bandeja de Notificaciones Finalizadas.
        </div>
    </form>
</div>

<script>
    function validarRegistro() {
        // Validación simple de campos requeridos antes de simular registro (CA4, CA5)
        const form = document.getElementById('formRegistro');
        if (!form.checkValidity()) {
            alert('Por favor, complete todos los campos requeridos.');
            return false;
        }

        document.getElementById('mensajeConfirmacion').classList.remove('d-none');
        return false; // Evita el envío real del formulario
    }
</script>
@endsection
