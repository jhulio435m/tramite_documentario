<x-layouts.app>
    <link rel="stylesheet" href="{{ asset('css/registroEnvioAutomatico.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <div class="contenedor">
        <h2 class="titulo-seccion">ESTADO DE ENVÍO DE EXPEDIENTES</h2>

        <div class="expediente-lista">
            <!-- Expediente 1 -->
            <div class="expediente seleccionado">
                <input type="checkbox">
                <div class="contenido">
                    <p class="titulo"><strong>Expediente: Nº 00001_2025_José Ramos</strong></p>
                    <p>Medio: eDoc</p>
                    <p class="estado-ok"><i class="fas fa-check-square"></i> Estado: enviado correctamente a eDoc</p>
                    <p class="timestamp">Timestamp: 2025-07-01 / 11:04</p>
                </div>
            </div>

            <!-- Expediente 2 -->
            <div class="expediente">
                <input type="checkbox">
                <div class="contenido">
                    <p class="titulo"><strong>Expediente: Nº 00002_2025_Juan Mendez</strong></p>
                    <p>Medio: eDoc</p>
                    <p class="estado-error"><i class="fas fa-times-circle"></i> Estado: no se pudo enviar a eDoc</p>
                    <p class="timestamp">Timestamp: 2025-07-01 / 12:30</p>
                </div>
            </div>

            <!-- Expediente 3 -->
            <div class="expediente">
                <input type="checkbox">
                <div class="contenido">
                    <p class="titulo"><strong>Expediente: Nº 00003_2025_Angelo Romo</strong></p>
                    <p>Medio: eDoc</p>
                    <p class="estado-error"><i class="fas fa-times-circle"></i> Estado: formato no compatible con eDoc</p>
                    <p class="timestamp">Timestamp: 2025-07-01 / 13:15</p>
                </div>
            </div>

            <!-- Expediente 4 -->
            <div class="expediente">
                <input type="checkbox">
                <div class="contenido">
                    <p class="titulo"><strong>Expediente: Nº 00004_2025_Zahid Matos</strong></p>
                    <p>Medio: eDoc</p>
                    <p class="estado-ok"><i class="fas fa-check-square"></i> Estado: enviado correctamente a eDoc</p>
                    <p class="timestamp">Timestamp: 2025-07-01 / 15:00</p>
                </div>
            </div>
        </div>

        <!-- Navegación inferior -->
        <div class="navegacion">
            <i class="fas fa-step-backward"></i>
            <i class="fas fa-circle"></i>
            <i class="fas fa-step-forward"></i>
        </div>
    </div>
</x-layouts.app>
