@extends('layouts.notificaciones')

@section('title', 'Bandeja de Notificaciones - Mesa de Partes')

@section('content')
<div class="row">
    <!-- Recuentos -->
    <div class="col-md-6">
        <div class="card-custom text-center">
            <h5 class="text-warning">📌 Notificaciones Pendientes</h5>
            <h2 class="text-dark fw-bold">{{ count($pendientes) }}</h2>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-custom text-center">
            <h5 class="text-warning">✅ Notificaciones Finalizadas</h5>
            <h2 class="text-dark fw-bold">{{ count($finalizadas) }}</h2>
        </div>
    </div>
</div>

<!-- Bandeja de Notificaciones Pendientes -->
<div class="card-custom mt-4">
    <h5 class="text-warning mb-3">📥 Notificaciones Pendientes</h5>
    <table class="table table-bordered table-hover bg-white">
        <thead class="table-secondary">
            <tr>
                <th>ID</th>
                <th>Trámite</th>
                <th>Solicitante</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendientes as $noti)
                @if($noti->id)
                    <tr class="clickable-row" onclick="window.location='{{ route('notificaciones.mesadepartes.elaboracion', ['id' => $noti->id]) }}'">
                        <td>{{ $noti->id }}</td>
                        <td>{{ $noti->documento }}</td>
                        <td>{{ $noti->destinatario_nombre }}</td>
                        <td>{{ $noti->fecha_solicitud }}</td>
                        <td><span class="badge bg-warning text-dark">{{ $noti->estado }}</span></td>
                    </tr>
                @endif
            @empty
                <tr><td colspan="5">No hay notificaciones pendientes.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>


<!-- Bandeja de Notificaciones Finalizadas -->
<div class="card-custom mt-4">
    <h5 class="text-warning mb-3">📤 Notificaciones Finalizadas</h5>
    <table class="table table-bordered table-hover bg-white">
        <thead class="table-secondary">
            <tr>
                <th>ID</th>
                <th>Trámite</th>
                <th>Solicitante</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($finalizadas as $noti)
            <tr>
                <td>{{ $noti->id }}</td>
                <td>{{ $noti->documento }}</td>
                <td>{{ $noti->destinatario_nombre }}</td>
                <td>{{ \Carbon\Carbon::parse($noti->fecha_solicitud)->format('Y-m-d H:i') }}</td>
                <td>
                    <span class="badge bg-success">{{ $noti->estado }}</span>
                    @if($noti->estado === 'Lista para entrega')
                        <a href="{{ route('notificaciones.mesadepartes.entrega', ['id' => $noti->id]) }}" class="btn btn-sm btn-primary ms-2">Entregar</a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No hay notificaciones finalizadas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
    .clickable-row {
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
    .clickable-row:hover {
        background-color: #f3f3f3;
    }
</style>
@endsection
