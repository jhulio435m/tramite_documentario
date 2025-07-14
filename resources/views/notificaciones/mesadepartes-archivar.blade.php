@extends('layouts.notificaciones')

@section('title', 'Archivar Expedientes - Mesa de Partes')

@section('content')
<div class="card-custom">
    <h4 class="mb-4 text-warning">📚 Archivar Expedientes</h4>

    {{-- Sección 1: Expedientes Activos --}}
    <div class="mb-4">
        <h5 class="text-success fw-bold">📁 Expedientes Activos</h5>
        <p>Seleccione los expedientes finalizados para archivar. Solo los expedientes con estado "Finalizado" pueden archivarse.</p>

        <table class="table table-bordered bg-white align-middle">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Trámite</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <!-- CA2 + CA3 -->
                <tr>
                    <td>EXP-1001</td>
                    <td>Certificado de estudios</td>
                    <td><span class="badge bg-success">Finalizado</span></td>
                    <td>2025-07-10</td>
                    <td>
                        <button class="btn btn-sm btn-yellow" onclick="confirmarArchivo(this)">📦 Archivar</button>
                    </td>
                </tr>
                <tr>
                    <td>EXP-1002</td>
                    <td>Informe académico</td>
                    <td><span class="badge bg-warning text-dark">Pendiente</span></td>
                    <td>2025-07-08</td>
                    <td>
                        <button class="btn btn-sm btn-secondary" disabled>📦 Archivar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Sección 2: Expedientes Archivados --}}
    <div>
        <h5 class="text-dark fw-bold">🗃️ Expedientes Archivados</h5>
        <p>Consulta de expedientes ya archivados. Puedes usar los filtros para búsqueda.</p>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">Buscar por ID</label>
                <input type="text" class="form-control" placeholder="Ej: EXP-1001">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Fecha de archivo</label>
                <input type="date" class="form-control">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-outline-dark w-100">🔍 Buscar</button>
            </div>
        </div>

        <table class="table table-bordered bg-white align-middle">
            <thead class="table-dark text-white">
                <tr>
                    <th>ID</th>
                    <th>Trámite</th>
                    <th>Fecha Archivo</th>
                    <th>Archivado por</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>EXP-0999</td>
                    <td>Constancia de matrícula</td>
                    <td>2025-07-07</td>
                    <td>Operador01</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Confirmación visual de archivo (CA4, CA9) --}}
    <div id="mensajeArchivado" class="alert alert-success d-none mt-4">
        ✅ El expediente ha sido archivado exitosamente. Ahora aparece en la lista de expedientes archivados.
    </div>
</div>

<script>
    function confirmarArchivo(btn) {
        const confirmar = confirm("¿Está seguro que desea archivar este expediente?");
        if (confirmar) {
            // Simulación de acción de archivo
            btn.disabled = true;
            btn.classList.remove('btn-yellow');
            btn.classList.add('btn-success');
            btn.innerText = "Archivado ✅";

            document.getElementById('mensajeArchivado').classList.remove('d-none');
        }
    }
</script>
@endsection
