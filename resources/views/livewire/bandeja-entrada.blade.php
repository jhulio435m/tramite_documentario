<div>
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Trámites por archivar</h2>

    <div class="overflow-auto rounded-lg shadow-sm bg-white">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Solicitante</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha ingreso</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($requests as $req)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $req->expediente->codigo }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $req->expediente->solicitante }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $req->expediente->fecha_ingreso }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm">
                            <flux:button size="sm" variant="primary" wire:click="selectRequest({{ $req->id }})">
                                <flux-icon name="pencil" class="w-4 h-4 mr-1" />
                                Procesar
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">No hay solicitudes.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($selectedRequest)
        <div class="mt-8 max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Detalle del trámite</h3>

            <p class="text-sm text-gray-700"><strong>Código:</strong> {{ $selectedRequest->expediente->codigo }}</p>
            <p class="text-sm text-gray-700 mb-4"><strong>Solicitante:</strong> {{ $selectedRequest->expediente->solicitante }}</p>

            <div class="mt-4">
                <flux:input
                    type="text"
                    wire:model.defer="ubicacion"
                    placeholder="Ej. Estante 3, Caja 5"
                />
                @error('ubicacion') 
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <flux:textarea
                    wire:model.defer="comentario"
                    rows="3"
                    placeholder="Opcional..."
                    label="Comentario"
                ></flux:textarea>
                @error('comentario')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end items-center gap-3 mt-6">
                <flux:button wire:click="generarReporte">
                    <flux-icon name="document-arrow-down" class="w-4 h-4 mr-1" />
                    Generar PDF y archivar
                </flux:button>

                <flux:button wire:click="$set('selectedRequest', null)">
                    Cancelar
                </flux:button>
            </div>
        </div>
    @endif
</div>
