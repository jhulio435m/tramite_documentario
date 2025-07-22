<div class="p-6">
    {{-- Resumen --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white shadow rounded-xl p-6 text-center">
            <h2 class="text-lg font-semibold text-yellow-600">📌 Notificaciones Pendientes</h2>
            <p class="text-3xl font-bold text-gray-800">{{ count($pendientes ?? []) }}</p>
        </div>
        <div class="bg-white shadow rounded-xl p-6 text-center">
            <h2 class="text-lg font-semibold text-yellow-600">✅ Notificaciones Finalizadas</h2>
            <p class="text-3xl font-bold text-gray-800">{{ count($finalizadas ?? []) }}</p>
        </div>
    </div>

    {{-- Pendientes --}}
    <div class="mt-10">
        <h3 class="text-xl font-bold text-yellow-600 mb-4">📥 Notificaciones Pendientes</h3>
        <div class="overflow-auto rounded-lg shadow">
            <div class="min-w-full bg-white border">
                <!-- Encabezado -->
                <div class="bg-gray-100 text-gray-700 grid grid-cols-5 font-semibold text-sm">
                    <div class="px-4 py-2 border">ID</div>
                    <div class="px-4 py-2 border">Trámite</div>
                    <div class="px-4 py-2 border">Solicitante</div>
                    <div class="px-4 py-2 border">Fecha</div>
                    <div class="px-4 py-2 border">Estado</div>
                </div>

                <!-- Datos -->
                @forelse($pendientes as $noti)
                    @if($noti->id)
                        <a href="{{ route('notificaciones.mesadepartes.elaboracion', ['id' => $noti->id]) }}"
                        class="grid grid-cols-5 text-sm hover:bg-gray-50 transition cursor-pointer text-gray-800">
                            <div class="px-4 py-2 border">{{ $noti->tramite_id }}</div>
                            <div class="px-4 py-2 border">{{ $noti->documento }}</div>
                            <div class="px-4 py-2 border">{{ $noti->destinatario_nombre }}</div>
                            <div class="px-4 py-2 border">{{ $noti->fecha_solicitud }}</div>
                            <div class="px-4 py-2 border">
                                <span class="bg-yellow-300 text-black text-xs font-semibold px-2 py-1 rounded">
                                    {{ $noti->estado }}
                                </span>
                            </div>
                        </a>
                    @endif
                @empty
                    <div class="text-center py-4 text-gray-500">No hay notificaciones pendientes.</div>
                @endforelse
            </div>
        </div>
    </div>


    {{-- Finalizadas --}}
    <div class="mt-10">
        <h3 class="text-xl font-bold text-yellow-600 mb-4">📤 Notificaciones Finalizadas</h3>
        <div class="overflow-auto rounded-lg shadow">
            <div class="min-w-full bg-white border">
                <div class="bg-gray-100 text-gray-700 grid grid-cols-5 font-semibold text-sm">
                    <div class="px-4 py-2 border">ID</div>
                    <div class="px-4 py-2 border">Trámite</div>
                    <div class="px-4 py-2 border">Solicitante</div>
                    <div class="px-4 py-2 border">Fecha</div>
                    <div class="px-4 py-2 border">Estado</div>
                </div>
                @forelse($finalizadas as $noti)
                    <div class="grid grid-cols-5 text-sm hover:bg-gray-50 transition cursor-pointer text-gray-800">
                        <div class="px-4 py-2 border">{{ $noti->id }}</div>
                        <div class="px-4 py-2 border">{{ $noti->documento }}</div>
                        <div class="px-4 py-2 border">{{ $noti->destinatario_nombre }}</div>
                        <div class="px-4 py-2 border">{{ \Carbon\Carbon::parse($noti->fecha_solicitud)->format('Y-m-d H:i') }}</div>
                        <div class="px-4 py-2 border flex items-center gap-2">
                            <span class="bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded">
                                {{ $noti->estado }}
                            </span>
                            @if($noti->estado === 'Lista para entrega')
                                <button 
                                    wire:click="irAEntrega({{ $noti->id }})"
                                    class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded"
                                >
                                    Entregar
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-gray-500">No hay notificaciones finalizadas.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
