<x-layouts.app>
    <link rel="stylesheet" href="{{ asset('css/formularioFlujo.css') }}">

    <div class="contenedor">
        <h2>No se encontró un trámite predefinido en el eDoc. Complete los datos para generar flujo personalizado.</h2>

        <form>
            <label>Número de expediente</label>
            <input type="text" placeholder="">

            <label>Nombre del solicitante</label>
            <input type="text" placeholder="">

            <div class="row">
                <div class="col">
                    <label>Asunto del trámite</label>
                    <input type="text">
                </div>
                <div class="col">
                    <label>Tipo de documento</label>
                    <input type="text">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Área de procedencia</label>
                    <input type="text">
                </div>
                <div class="col">
                    <label>Fecha de recepción</label>
                    <input type="date">
                </div>
            </div>

            <label>Subir documento</label>
            <div class="upload">
                <input type="file" accept=".pdf, image/*">
                <span>PDF o imagen</span>
            </div>

            <label>Observaciones</label>
            <textarea rows="4"></textarea>

            <div class="acciones">
                <button type="button" class="btn verde">Archivar</button>
                <button type="reset" class="btn blanco">Limpiar campos</button>
                <button type="button" class="btn rojo">Cancelar</button>
            </div>
        </form>
    </div>
</x-layouts.app>
