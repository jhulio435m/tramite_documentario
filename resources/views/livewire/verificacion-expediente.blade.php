<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/verificacionExpediente.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @endpush

    <main class="main-content p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Verificación de Expedientes</h2>

        <!-- Lista de expedientes con scroll -->
        <div class="tabla-scroll">
            <table class="expedientes-table w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-zinc-700 text-left">
                        <th class="p-2">N° Expediente</th>
                        <th class="p-2">Solicitante</th>
                        <th class="p-2">Fecha Ingreso</th>
                        <th class="p-2">Estado</th>
                        <th class="p-2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expedientes as $exp)
                        <tr class="{{ $exp->estado === 'Aprobado' ? 'estado-validado' : ($exp->estado === 'Rechazado' ? 'estado-rechazado' : 'estado-pendiente') }}">
                            <td class="p-2">{{ $exp->codigo }}</td>
                            <td class="p-2">{{ $exp->solicitante }}</td>
                            <td class="p-2">{{ $exp->fecha_ingreso }}</td>
                            <td class="p-2">{{ $exp->estado }}</td>
                            <td class="p-2 flex gap-2">
                                <button class="btn-ver" wire:click="seleccionarExpediente({{ $exp->id }})">Ver</button>
                                <a href="{{ route('registroObservaciones', ['expedienteId' => $exp->id]) }}" class="btn-observar bg-blue-500 text-white px-2 py-1 rounded text-sm hover:bg-blue-600">
                                    Observar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Detalle del expediente -->
        @if ($expedienteSeleccionado)
            <div class="expediente-detalle mt-8">
                <h3 class="text-xl font-semibold mb-4">Detalle del Expediente</h3>

                <div class="detalle-info grid gap-2 mb-4">
                    <div><strong>N° Expediente:</strong> {{ $expedienteSeleccionado->codigo }}</div>
                    <div><strong>Solicitante:</strong> {{ $expedienteSeleccionado->solicitante }}</div>
                    <div><strong>Fecha Ingreso:</strong> {{ $expedienteSeleccionado->fecha_ingreso }}</div>
                    <div><strong>Sumilla:</strong> {{ $expedienteSeleccionado->sumilla }}</div>
                    <div><strong>Estado:</strong> {{ $expedienteSeleccionado->estado }}</div>
                </div>

                <div class="form-group mb-4">
                    <label class="block font-medium mb-1">Observaciones:</label>
                    <textarea rows="4" class="w-full p-2 border rounded" wire:model.defer="observaciones" placeholder="Escriba observaciones..."></textarea>
                </div>

                <div class="acciones flex gap-4">
                    <button wire:click="validarExpediente" class="btn validar-btn bg-green-600 text-white px-4 py-2 rounded">
                        VALIDAR
                    </button>
                    <button wire:click="rechazarExpediente" class="btn rechazar-btn bg-red-600 text-white px-4 py-2 rounded">
                        RECHAZAR Y ARCHIVAR
                    </button>
                </div>
            </div>
        @endif
    </main>
</div>
