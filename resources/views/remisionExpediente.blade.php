<x-layouts.app>
    <link rel="stylesheet" href="{{ asset('css/remisionExpediente.css') }}">

    <div class="w-full px-4 md:px-10 py-6">
        <div class="contenedor">
            <h2 class="titulo-seccion">DATOS DEL EXPEDIENTE</h2>

            <div class="datos-box">
                <div class="fila">
                    <div class="etiqueta">N° Expediente</div>
                    <div class="valor">Exp-0001</div>
                </div>
                <div class="fila">
                    <div class="etiqueta">Nombre del solicitante</div>
                    <div class="valor">Jose Ramos</div>
                </div>
                <div class="fila">
                    <div class="etiqueta">Fecha validación</div>
                    <div class="valor">01/07/2025</div>
                </div>
                <div class="fila">
                    <div class="etiqueta">Estado</div>
                    <div class="valor">Requisitos completos</div>
                </div>
                <div class="fila">
                    <div class="etiqueta">Medio de envío</div>
                    <div class="valor">
                        <select>
                            <option selected>Sistema eDoc</option>
                            <option>----</option>
                        </select>
                    </div>
                </div>
            </div>

            <button class="btn-enviar">ENVIAR EXPEDIENTE</button>

            <p class="mensaje-confirmacion">
                <input type="checkbox" checked disabled>
                Enviado exitosamente las 3:00 p.m 10/07/2025
            </p>
        </div>
    </div>
</x-layouts.app>