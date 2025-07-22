<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TramiteType;
use App\Models\DetalleTramite;
use App\Models\Expediente;
use App\Models\TramiteExpediente;
use App\Models\Status;
use App\Models\Month;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class FormTramite extends Component
{
    use WithFileUploads;

    public $tramiteId;
    public $tramiteName;
    public $requisitos = [];
    public $detalles;
    public $sustento;
    public $archivos = [];

    public function mount($tramite)
    {
        $this->tramiteId = $tramite;

        $type = TramiteType::find($tramite);
        $this->tramiteName = $type?->name;

        $this->detalles = DetalleTramite::find($tramite);

        $modelo = "\\App\\Models\\Requisito{$tramite}";
        if (class_exists($modelo)) {
            $this->requisitos = $modelo::orderBy('id')->pluck('descripcion')->toArray();
        }
    }

    public function rules()
    {
        $rules = [
            'sustento' => 'required|string|max:255',
        ];
        foreach ($this->requisitos as $index => $req) {
            $rules["archivos.$index"] = 'required|file|max:5120';
        }
        return $rules;
    }

    public function enviarSolicitud()
    {
        $this->validate();

        $paths = [];
        foreach ($this->archivos as $archivo) {
            $paths[] = $archivo->store('tramites');
        }

        $codigo = strtoupper(Str::random(8));

        $status = Status::where('name', 'Pendiente')->value('id');

        Expediente::create([
            'codigo' => $codigo,
            'solicitante' => Auth::user()->name.' '.Auth::user()->last_name,
            'dni' => Auth::user()->dni,
            'year' => now()->year,
            'month_id' => now()->month,
            'fecha_ingreso' => now()->toDateString(),
            'tramite_type_id' => $this->tramiteId,
            'status_id' => $status,
            'sumilla' => $this->tramiteName,
        ]);

        TramiteExpediente::create([
            'codigo' => $codigo,
            'tramite_type_id' => $this->tramiteId,
            'sustento' => $this->sustento,
            'archivos' => $paths,
        ]);

        session()->flash('message', 'Solicitud enviada correctamente.');
        $this->reset(['sustento','archivos']);
    }

    public function volver()
    {
        return redirect()->route('tramites.lista');
    }

    public function render()
    {
        return view('livewire.form-tramite');
    }
}
