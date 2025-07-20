
<div>
    <div class="pb-4">
        <h1 class="text-3xl font-bold text-green-800">Archivo Central</h1>
    </div>

    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-xl mt-5 p-4 space-y-6">
        <flux:input wire:model.debounce.500ms="search" icon="magnifying-glass" placeholder="Filtrar por palabras clave" label="Filtros"/>
    </div>

    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-xl mt-3 p-4 space-y-6">
        <div class="flex flex-wrap gap-4 mt-4">
            <flux:select wire:model.defer="year" placeholder="Año" label="Año">
                <flux:select.option value="2021">2021</flux:select.option>
                <flux:select.option value="2022">2022</flux:select.option>
                <flux:select.option value="2023">2023</flux:select.option>
                <flux:select.option value="2024">2024</flux:select.option>
                <flux:select.option value="2025">2025</flux:select.option>
            </flux:select>

            <flux:select wire:model.defer="month" placeholder="Mes" label="Mes">
                <flux:select.option value="Enero">Enero</flux:select.option>
                <flux:select.option value="Febrero">Febrero</flux:select.option>
                <flux:select.option value="Marzo">Marzo</flux:select.option>
                <flux:select.option value="Abril">Abril</flux:select.option>
                <flux:select.option value="Mayo">Mayo</flux:select.option>
                <flux:select.option value="Junio">Junio</flux:select.option>
                <flux:select.option value="Julio">Julio</flux:select.option>
                <flux:select.option value="Agosto">Agosto</flux:select.option>
                <flux:select.option value="Septiembre">Septiembre</flux:select.option>
                <flux:select.option value="Octubre">Octubre</flux:select.option>
                <flux:select.option value="Noviembre">Noviembre</flux:select.option>
                <flux:select.option value="Diciembre">Diciembre</flux:select.option>
            </flux:select>

        <flux:select wire:model.defer="faculty_id" placeholder="Facultad" label="Facultad">
    <flux:select.option value="">Todas las facultades</flux:select.option>
    @foreach($facultades as $facultad)
        <flux:select.option value="{{ $facultad->id }}">{{ $facultad->nombre }}</flux:select.option>
    @endforeach
</flux:select>

    <flux:select wire:model.defer="document_type" placeholder="Tipo de documento" label="Tipo de documento">
        <flux:select.option value="Solicitud">Solicitud</flux:select.option>
        <flux:select.option value="Constancia">Constancia</flux:select.option>
        <flux:select.option value="Certificado">Certificado</flux:select.option>
        <flux:select.option value="Resolución">Resolución</flux:select.option>
        <flux:select.option value="Informe">Informe</flux:select.option>
        <flux:select.option value="Memorando">Memorando</flux:select.option>
        <flux:select.option value="Oficio">Oficio</flux:select.option>
    </flux:select>

    <flux:select wire:model.defer="status" placeholder="Estado" label="Estado">
        <flux:select.option value="Pendiente">Pendiente</flux:select.option>
        <flux:select.option value="En Proceso">En Proceso</flux:select.option>
        <flux:select.option value="Finalizado">Finalizado</flux:select.option>
    </flux:select>

    <div class="flex justify-end gap-2">
        <flux:button wire:click="applyFilters" variant="primary" color="green">
            Aplicar filtros
        </flux:button>
        <flux:button wire:click="limpiarFiltros" variant="primary" color="yellow">
            Limpiar filtros
        </flux:button>
    </div>
</div>
   
    <table class="w-full text-sm text-left text-gray-700 mt-6">
    <thead class="text-xs text-gray-600 uppercase border-b">
        <tr>
            <th class="px-4 py-2">Código</th>
            <th class="px-4 py-2">Solicitante</th>
            <th class="px-4 py-2">Tipo</th>
            <th class="px-4 py-2">Facultad</th>
            <th class="px-4 py-2">Fecha</th>
            <th class="px-4 py-2">Estado</th>
            <th class="px-4 py-2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($files as $file)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $file->id }}</td>
            <td class="px-4 py-2">{{ $file->name }}</td>
            <td class="px-4 py-2">{{ $file->document_type }}</td>
            <td class="px-4 py-2">{{ $file->facultad->nombre ?? '-' }}</td>
            <td class="px-4 py-2">{{ $file->created_at->format('d/m/Y h:i a') }}</td>
            <td class="px-4 py-2">
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                    {{ $file->status }}
                </span>
            </td>
            <td class="px-4 py-2">
                <flux:button wire:click="viewFile({{ $file->id }})" variant="primary" color="green">
                    Ver Detalles
                </flux:button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


</div>
</div>