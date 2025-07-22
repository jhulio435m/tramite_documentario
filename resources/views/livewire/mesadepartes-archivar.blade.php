<div class="p-6">

    {{-- 🔢 Resumen visual --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white shadow rounded-xl p-6 text-center">
            <h2 class="text-lg font-semibold text-yellow-600">🗂️ Expedientes Activos</h2>
            <p class="text-3xl font-bold text-gray-800">{{ count($expedientesActivos) }}</p>
        </div>
        <div class="bg-white shadow rounded-xl p-6 text-center">
            <h2 class="text-lg font-semibold text-yellow-600">📦 Expedientes Archivados</h2>
            <p class="text-3xl font-bold text-gray-800">{{ count($expedientesArchivados) }}</p>
        </div>
    </div>

    {{-- ✅ Mensajes --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-300 rounded px-4 py-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 border border-red-300 rounded px-4 py-3 mb-4">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    {{-- 📁 Expedientes activos (Finalizados) --}}
    <div class="mt-4">
        <h3 class="text-xl font-bold text-yellow-600 mb-4">📥 Expedientes Activos</h3>
        <div class="overflow-auto rounded-lg shadow">
            <div class="min-w-full bg-white border">
                <div class="bg-gray-100 text-gray-700 grid grid-cols-5 font-semibold text-sm">
                    <div class="px-4 py-2 border">ID</div>
                    <div class="px-4 py-2 border">Trámite</div>
                    <div class="px-4 py-2 border">Documento</div>
                    <div class="px-4 py-2 border">Estado</div>
                    <div class="px-4 py-2 border">Acción</div>
                </div>

                @forelse($expedientesActivos as $exp)
                    <div class="grid grid-cols-5 text-sm hover:bg-gray-50 transition cursor-pointer text-gray-800">
                        <div class="px-4 py-2 border">{{ $exp->id }}</div>
                        <div class="px-4 py-2 border">{{ $exp->tramite_id }}</div>
                        <div class="px-4 py-2 border">{{ $exp->documento }}</div>
                        <div class="px-4 py-2 border">
                            <span class="bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded">
                                {{ $exp->estado }}
                            </span>
                        </div>
                        <div class="px-4 py-2 border text-center">
                            <form method="POST" action="{{ route('expedientes.archivar', $exp->id) }}"
                                  onsubmit="return confirm('¿Deseas archivar este expediente?');">
                                @csrf
                                <button class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-4 py-1 rounded">
                                    Archivar
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-500">No hay expedientes finalizados para archivar.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- 🔍 Filtros para archivados --}}
    <div class="mt-10">
        <h3 class="text-xl font-bold text-yellow-600 mb-4">📦 Expedientes Archivados</h3>

        <form method="GET" action="{{ route('notificaciones.mesadepartes.archivar') }}"
              class="flex flex-col md:flex-row gap-4 mb-6">
            <input type="text" name="buscar" value="{{ request('buscar') }}"
                   placeholder="🔎 Documento..."
                   class="px-3 py-2 rounded border w-full md:w-1/3 bg-white text-gray-900 placeholder-gray-500">
            <input type="date" name="fecha" value="{{ request('fecha') }}"
                   class="px-3 py-2 rounded border w-full md:w-1/3 bg-white text-gray-900">
            <button type="submit"
                    class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded">
                Buscar
            </button>
        </form>

        {{-- 📤 Tabla de archivados --}}
        <div class="overflow-auto rounded-lg shadow">
            <div class="min-w-full bg-white border text-gray-900">
                <div class="bg-gray-100 text-gray-700 grid grid-cols-5 font-semibold text-sm">
                    <div class="px-4 py-2 border">ID</div>
                    <div class="px-4 py-2 border">Trámite</div>
                    <div class="px-4 py-2 border">Documento</div>
                    <div class="px-4 py-2 border">Fecha Archivo</div>
                    <div class="px-4 py-2 border">Archivado por</div>
                </div>

                @forelse($expedientesArchivados as $arch)
                    <div class="grid grid-cols-5 text-sm hover:bg-gray-50 transition text-gray-800">
                        <div class="px-4 py-2 border">{{ $arch->id }}</div>
                        <div class="px-4 py-2 border">{{ $arch->tramite_id }}</div>
                        <div class="px-4 py-2 border">{{ $arch->documento }}</div>
                        <div class="px-4 py-2 border">
                            {{ optional($arch->fecha_archivo)->format('Y-m-d H:i') }}
                        </div>
                        <div class="px-4 py-2 border">{{ $arch->archivado_por }}</div>
                    </div>
                @empty
                    <div class="text-center py-6 text-yellow-600 font-semibold bg-yellow-50 rounded">
                        📂 No se encontraron documentos archivados con los filtros actuales.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>