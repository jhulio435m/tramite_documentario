<div class="bg-white p-6 rounded-xl shadow-lg max-w-3xl mx-auto">

    <h1 class="text-2xl font-bold text-yellow-500 mb-6">
        Registro de Entrega de Notificación
    </h1>

    {{-- 💬 Mensaje de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-300 rounded px-4 py-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="registrarEntrega" class="space-y-6 text-gray-900">

        {{-- Selección de notificación finalizada --}}
        <div>
            <label class="block mb-1 font-medium text-gray-800">📌 Selecciona la Notificación</label>
            <select wire:model="selectedNotificacionId"
                    class="w-full px-3 py-2 rounded border bg-white text-gray-900 focus:ring-yellow-500"
                    required>
                <option value="">-- Elige un trámite --</option>
                @foreach($notificaciones as $noti)
                    <option value="{{ $noti->id }}">
                        {{ $noti->tramite_id }} — {{ $noti->documento }}
                    </option>
                @endforeach
            </select>
            @error('selectedNotificacionId')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Autocompletados --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-1 text-gray-800">📌 ID del Trámite</label>
                <input type="text" wire:model="tramite_id" disabled
                       class="w-full px-3 py-2 rounded border bg-gray-100 text-gray-800 font-semibold" />
            </div>
            <div>
                <label class="block mb-1 text-gray-800">📁 Documento</label>
                <input type="text" wire:model="documento" disabled
                       class="w-full px-3 py-2 rounded border bg-gray-100 text-gray-800 font-semibold" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-1 text-gray-800">📝 Tipo de Trámite</label>
                <input type="text" wire:model="tipo" disabled
                       class="w-full px-3 py-2 rounded border bg-gray-100 text-gray-800 font-semibold" />
            </div>
            <div>
                <label class="block mb-1 text-gray-800">⚙️ Estado del Trámite</label>
                <input type="text" wire:model="estado" disabled
                       class="w-full px-3 py-2 rounded border bg-gray-100 text-gray-800 font-semibold" />
            </div>
        </div>

        {{-- Fecha y hora --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-1 text-gray-800">📅 Fecha de Entrega</label>
                <input type="date" wire:model="fecha_entrega"
                       class="w-full px-3 py-2 rounded border focus:ring-yellow-500" required />
                @error('fecha_entrega')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block mb-1 text-gray-800">⏰ Hora de Entrega</label>
                <input type="time" wire:model="hora_entrega"
                       class="w-full px-3 py-2 rounded border focus:ring-yellow-500" required />
                @error('hora_entrega')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Estado de entrega y receptor --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-1 text-gray-800">📦 Estado de Entrega</label>
                <select wire:model="estado_entrega"
                        class="w-full px-3 py-2 rounded border focus:ring-yellow-500" required>
                    <option value="">-- Seleccione --</option>
                    <option>Entregado</option>
                    <option>No entregado</option>
                    <option>Rechazado</option>
                    <option>Pendiente</option>
                </select>
                @error('estado_entrega')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block mb-1 text-gray-800">👤 Receptor</label>
                <input type="text" wire:model="receptor"
                       class="w-full px-3 py-2 rounded border focus:ring-yellow-500"
                       placeholder="Ej: Juan Pérez" required />
                @error('receptor')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Observaciones --}}
        <div>
            <label class="block mb-1 text-gray-800">🗒️ Observaciones</label>
            <textarea wire:model="observaciones" rows="3"
                      class="w-full px-3 py-2 rounded border focus:ring-yellow-500"
                      placeholder="Comentario adicional…"></textarea>
        </div>

        {{-- Botón --}}
        <div class="text-right">
            <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">
                📋 Registrar Entrega
            </button>
        </div>
    </form>
</div>