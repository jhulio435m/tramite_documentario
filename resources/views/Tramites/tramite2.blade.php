@extends('layouts.tramiteView')

@section('title', $titulo)

@section('page-title')
    <div style="
        background: white;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        color: #C09700;
        letter-spacing: 0.5px;
    ">
        {{ $titulo }}
    </div>
@endsection

@section('content')
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="
            display: flex;
            gap: 30px;
            justify-content: space-between;
            flex-wrap: nowrap;
            align-items: flex-start;
            width: 100%;
        ">
            {{-- Columna izquierda: 40% --}}
            <div style="width: 40%; min-width: 300px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                <h3 style="margin-top: 0; color: #333;">Descripción :</h3>
                <p><strong>{{ $titulo }}</strong></p>

                <h4 style="margin-top: 30px;">REQUISITOS</h4>
                <ol style="font-size: 14px; line-height: 1.6;">
                    @foreach ($requisitos as $req)
                        <li>{{ $req }}</li>
                    @endforeach
                </ol>
            </div>

            {{-- Columna derecha: 60% --}}
            <div style="width: 60%; min-width: 300px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                <h4>Detalles:</h4>
                <ul style="list-style: none; padding-left: 0; font-size: 14px; margin-top: 5px;">
                    <li><strong>Duración:</strong> {{ $duracion }}</li>
                    <li><strong>Área:</strong> {{ $area }}</li>
                    <li><strong>Dependencia:</strong> {{ $dependencia }}</li>
                </ul>

                {{-- Subida de Foto con previsualización --}}
                <div style="margin-top: 20px;">
                    <label for="foto"><strong>Foto:</strong></label><br>
                    <input type="file" id="foto" name="foto" accept="image/*" onchange="previewImage(event)" style="margin-top: 5px;">
                    <div style="margin-top: 10px;">
                        <img id="preview" src="#" alt="Previsualización" style="display:none; max-width: 150px; border: 1px solid #ccc; border-radius: 4px; padding: 4px;">
                    </div>
                </div>

                {{-- Sustento --}}
                <div style="margin-top: 20px;">
                    <label for="sustento"><strong>Sustento:</strong></label><br>
                    <input type="text" name="sustento" id="sustento" style="width: 100%; padding: 8px; font-size: 14px;">
                </div>

                {{-- Tabla de requisitos para subir archivos --}}
                <h4 style="margin-top: 30px;">Requisitos</h4>
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead>
                        <tr style="background-color: #e0e0e0;">
                            <th style="padding: 10px; border: 1px solid #ccc;">Requisito</th>
                            <th style="padding: 10px; border: 1px solid #ccc;">Archivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requisitos as $index => $requisito)
                            <tr>
                                <td style="padding: 8px; border: 1px solid #ccc;">{{ $requisito }}</td>
                                <td style="padding: 8px; border: 1px solid #ccc;">
                                    <input type="file" name="archivo_{{ $index }}" required>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Botón Enviar --}}
                <div style="text-align: right; margin-top: 30px;">
                    <button type="submit"
                        style="background-color: #E5C300; padding: 12px 24px; border: none; font-weight: bold; border-radius: 4px; cursor: pointer;">
                        + ENVIAR SOLICITUD
                    </button>
                </div>
            </div>
        </div>
    </form>

    {{-- Script para previsualizar imagen --}}
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = "#";
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
