<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/remisionExpediente.css') }}">
    @endpush

    <div class="w-full px-4 md:px-10 py-6">
        <div class="contenedor">
            <h2 class="titulo-seccion">DATOS DEL EXPEDIENTE</h2>

            <div class="datos-box">
                <div class="fila">
                    <div class="etiqueta">N° Expediente</div>
                    <div class="valor">{{ $expediente->codigo }}</div>
                </div>
                <div class="fila">
                    <div class="etiqueta">Nombre del solicitante</div>
                    <div class="valor">{{ $expediente->solicitante }}</div>
                </div>
                <div class="fila">
                    <div class="etiqueta">Fecha validación</div>
                    <div class="valor">{{ $expediente->fecha_ingreso }}</div>
                </div>
                <div class="fila">
                    <div class="etiqueta">Estado</div>
                    <div class="valor">{{ $expediente->estado }}</div>
                </div>
                <div class="fila">
                    <div class="etiqueta">Medio de envío</div>
                    <div class="valor">
                        <select wire:model="medioEnvio">
                            <option>Sistema eDoc</option>
                            <option>Otro aplicativo</option>
                        </select>
                    </div>
                </div>
            </div>

            <button class="btn-enviar mt-4" wire:click="enviar">ENVIAR EXPEDIENTE</button>

            @if ($confirmacion)
                <p class="mensaje-confirmacion">
                    <input type="checkbox" checked disabled>
                    Enviado exitosamente a las {{ \Carbon\Carbon::parse($timestampEnvio)->format('g:i A d/m/Y') }}
                </p>
            @endif
        </div>
    </div>
</div>
