<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TramiteType;
use App\Models\RequisitosConstanciaExpeditoProfesional;
use Illuminate\Support\Facades\Log;
use App\Models\SolicitudExpedito;
use App\Models\Expediente;
use App\Models\TramiteExpediente;
use App\Models\Status;
use App\Models\Month;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ConstanciaExpeditoProfesional extends Component
{
    use WithFileUploads;

    public $tramite;
    public $requisitos = [];
    public $titulo;
    public $descripcion;
    public $duracion;
    public $area;
    public $dependencia;
    public $requiere_foto;
    public $cargando = true;
    public $error = null;

    // Nuevas propiedades
    public $sustento;
    public $archivos = [];

    public function mount()
    {
        try {
            $tramiteType = TramiteType::where('name', 'Constancia de expedito para optar título profesional')->first();

            if (!$tramiteType) {
                $this->error = 'Tipo de trámite no encontrado';
                $this->cargando = false;
                return;
            }

            $this->tramite = RequisitosConstanciaExpeditoProfesional::where('tramite_type_id', $tramiteType->id)->first();

            if ($this->tramite) {
                $this->titulo = $this->tramite->titulo;
                $this->descripcion = $this->tramite->descripcion;
                $this->duracion = $this->tramite->duracion;
                $this->area = $this->tramite->area;
                $this->dependencia = $this->tramite->dependencia;
                $this->requiere_foto = $this->tramite->requiere_foto;

                $this->requisitos = is_array($this->tramite->requisitos) ? $this->tramite->requisitos : [];

                Log::info('Requisitos cargados:', $this->requisitos);
            } else {
                $this->error = 'No se encontraron requisitos para este trámite';
            }

        } catch (\Exception $e) {
            $this->error = 'Error al cargar el trámite: ' . $e->getMessage();
            Log::error('Error en ConstanciaExpeditoProfesional:', ['error' => $e->getMessage()]);
        } finally {
            $this->cargando = false;
        }
    }

    public function rules()
    {
        $rules = [
            'sustento' => 'required|string|max:255',
        ];

        // Validar que cada archivo esté presente y no supere los 5MB
        foreach ($this->requisitos as $index => $requisito) {
            $rules["archivos.$index"] = 'required|file|max:5120'; // 5MB
        }

        return $rules;
    }

    public function enviarSolicitud()
    {
        $this->validate();

        $rutasArchivos = [];

        foreach ($this->archivos as $index => $archivo) {
            // Guardamos el archivo y capturamos la ruta
            $ruta = $archivo->store('solicitudes/expedito');
            $rutasArchivos[] = $ruta;
            Log::info("Archivo [$index] guardado en: $ruta");
        }

        // Crear expediente
        $codigo = strtoupper(Str::random(8));
        $status = Status::where('name', 'Pendiente')->value('id');

        Expediente::create([
            'codigo' => $codigo,
            'solicitante' => Auth::user()->name.' '.Auth::user()->last_name,
            'dni' => Auth::user()->dni,
            'year' => now()->year,
            'month_id' => now()->month,
            'fecha_ingreso' => now()->toDateString(),
            'tramite_type_id' => $this->tramite->tramite_type_id ?? null,
            'status_id' => $status,
            'sumilla' => $this->titulo,
        ]);

        SolicitudExpedito::create([
            'codigo' => $codigo,
            'sustento' => $this->sustento,
            'archivos' => $rutasArchivos,
        ]);

        TramiteExpediente::create([
            'codigo' => $codigo,
            'tramite_type_id' => $this->tramite->tramite_type_id ?? null,
            'sustento' => $this->sustento,
            'archivos' => $rutasArchivos,
        ]);

        session()->flash('message', 'La solicitud fue enviada correctamente.');
    }

    public function volver()
    {
        return redirect()->route('tramites_lista');
    }

    public function render()
    {
        return view('livewire.constancia-expedito-profesional');
    }
}
