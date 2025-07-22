<div class="p-6">
    <h2 class="text-2xl font-bold text-yellow-600 mb-6">📦 Lista de Notificaciones para Entrega</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-300 rounded px-4 py-3 mb-4">
             {{ session('success') }}
        </div>
    @endif

    @if($notificaciones->isEmpty())
        <p class="text-gray-600">No hay notificaciones listas para entrega.</p>
    @else
        <div class="overflow-auto rounded-lg shadow">
            <table class="min-w-full bg-white border">
                <thead class="bg-gray-100 text-gray-700 font-semibold text-sm">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Documento</th>
                        <th class="px-4 py-2 border">Destinatario</th>
                        <th class="px-4 py-2 border">Fecha Solicitud</th>
                        <th class="px-4 py-2 border">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notificaciones as $noti)
                        <tr class="text-sm hover:bg-gray-50 transition text-gray-800">
                            <td class="px-4 py-2 border">{{ $noti->id }}</td>
                            <td class="px-4 py-2 border">{{ $noti->documento }}</td>
                            <td class="px-4 py-2 border">{{ $noti->destinatario_nombre }}</td>
                            <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($noti->fecha_solicitud)->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-2 border text-center">
                                <button 
                                    wire:click="entregar({{ $noti->id }})"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 text-sm rounded"
                                >
                                    Entregar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
