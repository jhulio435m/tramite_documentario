@extends('layouts.notificaciones')
@section('title', 'Bandeja de Notificaciones (Dependencia)')

@section('content')
<div class="card-custom">
    <h4 class="text-warning">📥 Bandeja - Trámites con notificación solicitada</h4>
    <p>Aquí se muestran los trámites notificados por esta dependencia.</p>
    <ul class="list-group">
        <li class="list-group-item">TRM001 - Solicitud de Certificado</li>
        <li class="list-group-item">TRM002 - Constancia Académica</li>
    </ul>
</div>
@endsection
