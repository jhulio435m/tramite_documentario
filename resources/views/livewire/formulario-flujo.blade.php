<div class="contenedor">
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/formularioFlujo.css') }}">
    @endpush

    <h2>No se encontró un trámite predefinido en el eDoc. Complete los datos para generar flujo personalizado.</h2>

    <form wire:submit.prevent="archivar">
        <label>Número de expediente</label>
        <input type="text" wire:model="codigo">

        <label>Nombre del solicitante</label>
        <input type="text" wire:model="solicitante">

        <div class="row">
            <div class="col">
                <label>Asunto del trámite</label>
                <input type="text" wire:model="asunto">
            </div>
            <div class="col">
                <label>Tipo de documento</label>
                <input type="text" wire:model="tipo_documento">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label>Área de procedencia</label>
                <input type="text" wire:model="area_procedencia">
            </div>
            <div class="col">
                <label>Fecha de recepción</label>
                <input type="date" wire:model="fecha_recepcion">
            </div>
        </div>

        <label>Subir documento</label>
        <div class="upload">
            <input type="file" wire:model="documento">
            <span>PDF o imagen</span>
        </div>

        <label>Observaciones</label>
        <textarea rows="4" wire:model="observaciones"></textarea>

        <div class="acciones">
            <button type="submit" class="btn verde">Archivar</button>
            <button type="reset" class="btn blanco" wire:click="limpiar">Limpiar campos</button>
            <button type="button" class="btn rojo" wire:click="cancelar">Cancelar</button>
        </div>
    </form>
</div>
