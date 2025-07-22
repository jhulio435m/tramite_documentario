<x-layouts.app :title="__('Solicitud de Notificación')">
    <div class="bg-white p-6 rounded-xl shadow-lg max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-yellow-500 mb-6">Solicitud de Notificación a Mesa de Partes</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 rounded px-4 py-3 mb-4">
                ✅ {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('notificaciones.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">ID del Trámite</label>
                    <input type="text" name="tramite_id" class="w-full px-3 py-2 rounded border border-gray-300 text-gray-900 focus:ring-2 focus:ring-yellow-500" placeholder="Ej: TRM2025" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Fecha y Hora de Solicitud</label>
                    <input type="datetime-local" name="fecha_solicitud" class="w-full px-3 py-2 rounded border border-gray-300 text-gray-900 focus:ring-2 focus:ring-yellow-500" value="{{ now()->format('Y-m-d\TH:i') }}" required>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Documento o Resultado a Notificar</label>
                <input type="text" name="documento" class="w-full px-3 py-2 rounded border border-gray-300 text-gray-900 focus:ring-2 focus:ring-yellow-500" placeholder="Ej: Resolución N°123" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Tipo de Notificación</label>
                <select name="tipo" class="w-full px-3 py-2 rounded border border-gray-300 text-gray-900 focus:ring-2 focus:ring-yellow-500" required>
                    <option value="">Seleccione...</option>
                    <option value="Personal">Personal</option>
                    <option value="Correo electrónico">Correo electrónico</option>
                    <option value="Vía digital">Vía digital</option>
                </select>
            </div>

            <hr class="my-6 border-t border-gray-300">

            <h2 class="text-lg font-bold text-green-600 mb-4">Datos del Destinatario</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Nombre del Destinatario</label>
                    <input type="text" name="destinatario_nombre" class="w-full px-3 py-2 rounded border border-gray-300 text-gray-900 focus:ring-2 focus:ring-yellow-500" placeholder="Ej: Juan Pérez" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Dirección</label>
                    <input type="text" name="destinatario_direccion" class="w-full px-3 py-2 rounded border border-gray-300 text-gray-900 focus:ring-2 focus:ring-yellow-500" placeholder="Ej: Av. Universitaria 123" required>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Correo / Contacto</label>
                <input type="email" name="destinatario_contacto" class="w-full px-3 py-2 rounded border border-gray-300 text-gray-900 focus:ring-2 focus:ring-yellow-500" placeholder="Ej: juanperez@email.com" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Funcionario que Solicita</label>
                <input type="text" name="funcionario" class="w-full px-3 py-2 rounded border border-gray-300 text-gray-900 focus:ring-2 focus:ring-yellow-500" placeholder="Ej: Lic. Mariana Torres" required>
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded shadow-md transition duration-200">
                    📨 Enviar Solicitud
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
