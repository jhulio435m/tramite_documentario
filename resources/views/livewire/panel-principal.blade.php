<div class="space-y-6">

    {{-- Mensaje de éxito --}}
    @if (session()->has('success'))
        <div class="rounded bg-green-100 text-green-800 p-4 flex items-center">
            <flux:icon.check-circle class="w-5 h-5 mr-2 text-green-600" />
            {{ session('success') }}
        </div>
    @endif

    {{-- Tarjetas de resumen --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="rounded-lg shadow bg-white text-center p-4">
            <flux:icon.folder-open variant="outline" class="w-8 h-8 text-blue-500 mx-auto mb-3" />
            <div class="text-3xl font-bold">{{ $pendientes }}</div>
            <div class="text-gray-500">Pendientes</div>
        </div>

        <div class="rounded-lg shadow bg-white text-center p-4">
            <flux:icon.clock variant="outline" class="w-8 h-8 text-yellow-500 mx-auto mb-3" />
            <div class="text-3xl font-bold">{{ $enProceso }}</div>
            <div class="text-gray-500">En Proceso</div>
        </div>

        <div class="rounded-lg shadow bg-white text-center p-4">
            <flux:icon.check-circle variant="outline" class="w-8 h-8 text-green-500 mx-auto mb-3" />
            <div class="text-3xl font-bold">{{ $completados }}</div>
            <div class="text-gray-500">Completados</div>
        </div>

        <div class="rounded-lg shadow bg-white text-center p-4">
            <flux:icon.share variant="outline" class="w-8 h-8 text-cyan-500 mx-auto mb-3" />
            <div class="text-3xl font-bold">{{ $derivados }}</div>
            <div class="text-gray-500">Derivados</div>
        </div>
    </div>

    {{-- Tabla de documentos --}}
    <div class="rounded-lg shadow bg-white">
        <div class="p-4 border-b flex items-center justify-between">
            <div class="flex items-center gap-2">
                <flux:icon.folder class="w-5 h-5 text-blue-500" />
                <h2 class="text-lg font-semibold">Documentos Asignados Recientes</h2>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-2">Documento</th>
                        <th class="p-2">Solicitante</th>
                        <th class="p-2">Fecha Inicio</th>
                        <th class="p-2">Estado</th>
                        <th class="p-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tramitesRecientes as $tramite)
                        <tr class="border-t">
                            <td class="p-2">
                                <div class="font-semibold">{{ $tramite->documento }}</div>
                                <div class="text-gray-500 text-xs">{{ $tramite->codigo }}</div>
                            </td>
                            <td class="p-2">{{ $tramite->solicitante }}</td>
                            <td class="p-2">{{ $tramite->fecha_inicio }}</td>
                            <td class="p-2">
                                @php
                                    $badgeVariant = match($tramite->estado) {
                                        'Pendiente' => 'warning',
                                        'En Revisión' => 'info', 
                                        'Atendido' => 'primary',
                                        'Aprobado' => 'success',
                                        'Finalizado' => 'success',
                                        'Derivado' => 'zinc',
                                        default => 'zinc'
                                    };
                                @endphp
                                <flux:badge variant="{{ $badgeVariant }}" size="sm">
                                    {{ $tramite->estado }}
                                </flux:badge>
                            </td>
                            <td class="p-2">
                                <div class="flex items-center gap-2">
                                    <flux:button variant="ghost" size="sm" icon="eye" />

                                    @if($tramite->estado === 'Pendiente' || $tramite->estado === 'En Revisión')
                                        <flux:button 
                                            variant="outline" 
                                            size="sm" 
                                            icon="hand-raised"
                                            wire:click="marcarAtendido({{ $tramite->id }})" 
                                            wire:confirm="¿Marcar este trámite como atendido?"
                                            class="text-yellow-600 border-yellow-300 hover:bg-yellow-50">
                                        </flux:button>

                                    @elseif($tramite->estado === 'Atendido')
                                        <flux:button 
                                            variant="outline" 
                                            size="sm" 
                                            icon="check"
                                            wire:click="aprobar({{ $tramite->id }})" 
                                            wire:confirm="¿Aprobar este trámite?"
                                            class="text-green-600 border-green-300 hover:bg-green-50">
                                        </flux:button>
                                        
                                        <flux:button 
                                            variant="outline" 
                                            size="sm" 
                                            icon="share"
                                            wire:click="derivar({{ $tramite->id }})" 
                                            wire:confirm="¿Derivar este trámite?"
                                            class="text-blue-600 border-blue-300 hover:bg-blue-50">
                                        </flux:button>

                                    @elseif($tramite->estado === 'Aprobado')
                                        <flux:button 
                                            variant="outline" 
                                            size="sm" 
                                            icon="check-badge"
                                            wire:click="finalizar({{ $tramite->id }})" 
                                            wire:confirm="¿Finalizar este trámite?"
                                            class="text-indigo-600 border-indigo-300 hover:bg-indigo-50">
                                        </flux:button>

                                    @elseif($tramite->estado === 'Derivado')
                                        <flux:badge variant="zinc" size="sm">Derivado</flux:badge>

                                    @elseif($tramite->estado === 'Finalizado')
                                        <flux:badge variant="success" size="sm">Completado</flux:badge>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
