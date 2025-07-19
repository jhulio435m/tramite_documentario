<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/notificacionesSolicitante.css') }}">
    @endpush

    <main class="main-content p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Mis Notificaciones</h2>

        @forelse($notificaciones as $notif)
            <div class="notificacion bg-white shadow rounded p-4 mb-3">
                <p><strong>Expediente Nº:</strong> {{ $notif->codigo }}</p>
                <p><strong>Mensaje:</strong> {{ $notif->mensaje }}</p>
                <p class="text-sm text-gray-500">Enviado: {{ \Carbon\Carbon::parse($notif->enviado_at)->format('d/m/Y H:i') }}</p>
            </div>
        @empty
            <p class="text-gray-500">No tienes notificaciones aún.</p>
        @endforelse
    </main>
</div>
