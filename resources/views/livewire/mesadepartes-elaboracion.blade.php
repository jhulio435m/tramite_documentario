<div class="p-6 bg-white rounded-xl shadow-lg max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-yellow-600 mb-6">✍️ Elaborar Notificación</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-300 rounded px-4 py-3 mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="guardarCambios" enctype="multipart/form-data" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-black font-semibold mb-1">ID del Trámite</label>
                <input type="text" wire:model="notificacion.tramite_id" class="w-full px-3 py-2 border rounded text-gray-900 bg-gray-100" disabled>
            </div>

            <div>
                <label class="block text-black font-semibold mb-1">Fecha de Solicitud</label>
                <input type="text" wire:model="notificacion.fecha_solicitud" class="w-full px-3 py-2 border rounded text-gray-900 bg-gray-100" disabled>
            </div>
        </div>

        <div>
            <label class="block text-black font-semibold mb-1">Documento</label>
            <input type="text" wire:model="notificacion.documento" class="w-full px-3 py-2 border rounded text-gray-900 bg-gray-100" disabled>
        </div>

        <div>
            <label class="block text-black font-semibold mb-1">Tipo de Notificación</label>
            <input type="text" wire:model="notificacion.tipo" class="w-full px-3 py-2 border rounded text-gray-900 bg-gray-100" disabled>
        </div>

        <hr class="my-6 border-gray-300">

        <h3 class="text-lg font-bold text-green-600 mb-4">📇 Datos del Destinatario</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-black font-semibold mb-1">Nombre</label>
                <input type="text" wire:model="notificacion.destinatario_nombre" class="w-full px-3 py-2 border rounded text-gray-900 bg-gray-100" disabled>
            </div>
            <div>
                <label class="block text-black font-semibold mb-1">Dirección</label>
                <input type="text" wire:model="notificacion.destinatario_direccion" class="w-full px-3 py-2 border rounded text-gray-900 bg-gray-100" disabled>
            </div>
        </div>

        <div>
            <label class="block text-black font-semibold mb-1">Correo / Contacto</label>
            <input type="text" wire:model="notificacion.destinatario_contacto" class="w-full px-3 py-2 border rounded text-gray-900 bg-gray-100" disabled>
        </div>

        <div>
            <label class="block text-black font-semibold mb-1">Funcionario que Solicita</label>
            <input type="text" wire:model="notificacion.funcionario" class="w-full px-3 py-2 border rounded text-gray-900 bg-gray-100" disabled>
        </div>

        <div>
            <label class="block text-black font-semibold mb-1">Estado</label>
            <select wire:model="notificacion.estado" class="w-full px-3 py-2 border rounded text-gray-900 focus:ring-2 focus:ring-yellow-500">
                <option value="Pendiente">Pendiente</option>
                <option value="Finalizado">Finalizado</option>
                <option value="Lista para entrega">Lista para entrega</option>
            </select>
        </div>

        <div>
            <label class="block text-black font-semibold mb-1">Redacción de la Notificación</label>
            <textarea wire:model="notificacion.mensaje" rows="6" placeholder="Escribe aquí el contenido de la notificación..." class="w-full px-3 py-2 border rounded text-gray-900 bg-white"></textarea>
        </div>

        <div>
            <label class="block text-black font-semibold mb-1">Archivo Adjunto</label>
            <input type="file" wire:model="archivo" class="w-full px-3 py-2 border rounded text-gray-900 bg-white">
            @error('archivo') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror

            @if(!empty($notificacion['archivo']))
                <div class="mt-2 text-sm text-blue-600">
                    Archivo actual: 
                    <a href="{{ Storage::url($notificacion['archivo']) }}" target="_blank" class="underline">Ver documento</a>
                </div>
            @endif
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded shadow-md transition duration-200">
                💾 Guardar Cambios
            </button>
        </div>
    </form>
</div>
