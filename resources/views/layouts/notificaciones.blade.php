<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Notificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #E0E0E0;
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            background-color: #22572D;
            min-height: 100vh;
            width: 230px;
            padding: 20px;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 12px 0;
            padding: 8px 10px;
            border-radius: 5px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #E5C300;
            color: black;
        }
        .main-content {
            padding: 30px;
        }
        .header {
            background-color: #22572D;
            color: white;
            padding: 15px 30px;
        }
        .btn-yellow {
            background-color: #E5C300;
            color: black;
            border: none;
        }
        .btn-yellow:hover {
            background-color: #d4b100;
        }
        .card-custom {
            background-color: white;
            border-left: 5px solid #E5C300;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- SIDEBAR -->
    <div class="sidebar d-flex flex-column">
        <h5 class="fw-bold text-white">Notificaciones</h5>
        <hr class="bg-light">

        @if (request()->is('notificaciones/dependencia*'))
            <a href="{{ route('notificaciones.dependencia.bandeja') }}" class="{{ request()->routeIs('notificaciones.dependencia.bandeja') ? 'active' : '' }}">📥 Bandeja</a>
            <a href="{{ route('notificaciones.dependencia.solicitud') }}" class="{{ request()->routeIs('notificaciones.dependencia.solicitud') ? 'active' : '' }}">📝 Solicitud</a>

        @elseif (request()->is('notificaciones/mesadepartes*'))
            <a href="{{ route('notificaciones.mesadepartes.bandeja') }}" class="{{ request()->routeIs('notificaciones.mesadepartes.bandeja') ? 'active' : '' }}">📥 Bandeja</a>
            @php
                $primeraPendiente = \App\Models\Notificacion::where('estado', 'Pendiente')->orderBy('id')->first();
            @endphp
            @if($primeraPendiente)
                <a href="{{ route('notificaciones.mesadepartes.elaboracion', ['id' => $primeraPendiente->id]) }}" class="{{ request()->routeIs('notificaciones.mesadepartes.elaboracion') ? 'active' : '' }}">✏️ Elaboración</a>
            @else
                <a href="#" class="disabled" tabindex="-1" aria-disabled="true">✏️ Elaboración</a>
            @endif
            <a href="{{ route('notificaciones.mesadepartes.entrega.lista') }}" class="{{ request()->routeIs('notificaciones.mesadepartes.entrega.lista') ? 'active' : '' }}">📤 Entrega</a>
            <a href="{{ route('notificaciones.mesadepartes.registro') }}" class="{{ request()->routeIs('notificaciones.mesadepartes.registro') ? 'active' : '' }}">📑 Registro</a>
            <a href="{{ route('notificaciones.mesadepartes.archivar') }}" class="{{ request()->routeIs('notificaciones.mesadepartes.archivar') ? 'active' : '' }}">📚 Archivar</a>

        @elseif (request()->is('notificaciones/usuario*'))
            <a href="{{ route('notificaciones.usuario.bandeja') }}" class="{{ request()->routeIs('notificaciones.usuario.bandeja') ? 'active' : '' }}">📩 Mis Notificaciones</a>
        @endif

        <div class="mt-auto pt-3 border-top text-center">
            <button class="btn btn-light btn-sm mt-3">Cerrar Sesión</button>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-grow-1">
        <div class="header">
            <h4 class="m-0">@yield('title')</h4>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>

