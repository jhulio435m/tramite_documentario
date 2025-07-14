@extends('layouts.notificaciones')

@section('title', 'Entrega de Notificaciones - Mesa de Partes')

@section('content')
<div class="card-custom">
    <h4 class="mb-3 text-warning">📤 Notificaciones Listas para Entrega</h4>
    <table class="table table-bordered table-hover bg-white">
        <thead class="table-secondary">
            <tr>
                <th>ID</th>
                <th>Trámite</th>
                <th>Solicitante</th>
                <th>Fecha</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notificaciones as $noti)
                <tr>
                    <td>{{ $noti->id }}</td>
                    <td>{{ $noti->documento }}</td>
                    <td>{{ $noti->destinatario_nombre }}</td>
                    <td>{{ \Carbon\Carbon::parse($noti->fecha_solicitud)->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('notificaciones.mesadepartes.entrega', ['id' => $noti->id]) }}" class="btn btn-sm btn-primary">Entregar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay notificaciones listas para entrega.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
