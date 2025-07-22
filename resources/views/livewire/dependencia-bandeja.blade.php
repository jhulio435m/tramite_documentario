<div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold text-yellow-600 mb-6">📥 Bandeja de Solicitudes Recibidas</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-300 rounded px-4 py-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @forelse($notificaciones as $noti)
        <div class="bg-white border border-gray-300 rounded-lg p-4 mb-5 shadow-sm hover:border-yellow-400 transition">

            <div class="mb-3 text-lg font-semibold text-gray-900">
                📁 <strong>Documento:</strong> {{ $noti->documento }}
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3 text-gray-800">
                <div>
                    ⚙️ <strong>Estado de la solicitud:</strong>
                    <span class="inline-block px-2 py-1 bg-green-100 text-green-800 text-sm rounded">
                        {{ $noti->estado }}
                    </span>
                </div>
                <div>
                    🗓️ <strong>Fecha de solicitud:</strong>
                    {{ optional($noti->fecha_solicitud)->format('d/m/Y H:i') ?? 'No registrada' }}
                </div>
            </div>

            <div class="mb-3 text-gray-800">
                📝 <strong>Mensaje del operador:</strong>
                <p class="mt-1">{{ $noti->mensaje ?? 'Sin mensaje personalizado.' }}</p>
            </div>

            @if($noti->archivo)
                <div class="mt-2">
                    <a href="{{ Storage::url($noti->archivo) }}" target="_blank"
                       class="inline-block bg-blue-100 text-blue-800 px-3 py-2 rounded hover:bg-blue-200 transition">
                        📄 Ver documento entregado
                    </a>
                </div>
            @endif

            @if($noti->estado === 'Solicitada')
                <button wire:click="marcarComoAtendida({{ $noti->id }})"
                        class="mt-4 px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                    ✅ Marcar como atendida
                </button>
            @elseif($noti->estado === 'Finalizado')
                <div class="mt-4 inline-block bg-green-100 text-green-700 px-3 py-1 rounded text-sm">
                    🟢 Ya fue atendida
                </div>
            @endif

        </div>
    @empty
        <div class="bg-yellow-50 text-yellow-700 text-center py-6 rounded-lg shadow-sm">
            No tienes solicitudes registradas por mesa de partes aún.
        </div>
    @endforelse
</div>