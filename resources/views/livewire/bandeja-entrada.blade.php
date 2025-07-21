<div>
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Trámites por archivar</h2>

    <div class="tabla-scroll">
        <table class="expedientes-table">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">Código</th>
                    <th class="p-2">Solicitante</th>
                    <th class="p-2">Fecha ingreso</th>
                    <th class="p-2">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                    <tr>
                        <td class="p-2">{{ $req->expediente->codigo }}</td>
                        <td class="p-2">{{ $req->expediente->solicitante }}</td>
                        <td class="p-2">{{ $req->expediente->fecha_ingreso }}</td>
                        <td class="p-2">
                            <button class="btn btn-ver" wire:click="selectRequest({{ $req->id }})">Procesar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">No hay solicitudes.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($selectedRequest)
        <div class="mt-8 max-w-xl">
            <h3 class="text-xl font-semibold mb-4">Detalle del trámite</h3>
            <p><strong>Código:</strong> {{ $selectedRequest->expediente->codigo }}</p>
            <p><strong>Solicitante:</strong> {{ $selectedRequest->expediente->solicitante }}</p>

            <div class="form-group mt-4">
                <label>Ubicación física *</label>
                <input type="text" wire:model.defer="ubicacion" class="w-full border rounded p-2">
                @error('ubicacion')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>

            <div class="form-group mt-2">
                <label>Comentario</label>
                <textarea wire:model.defer="comentario" class="w-full border rounded p-2" rows="3"></textarea>
                @error('comentario')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>

            <div class="flex gap-4 mt-4">
                <button wire:click="generarReporte" class="btn bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Generar PDF y archivar</button>
                <button wire:click="$set('selectedRequest', null)" class="btn bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</button>
            </div>
        </div>
    @endif
</div>
