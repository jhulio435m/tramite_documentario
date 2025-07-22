<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\VerificacionExpediente;
use App\Livewire\RegistroObservaciones;
use App\Livewire\RemisionExpediente;
use App\Livewire\RegistroEnvioAutomatico;
use App\Livewire\FormularioFlujo;
use App\Livewire\CanalizarEnvio;
use App\Livewire\RevisarExpedientesFinalizados;
use App\Livewire\NotificacionesSolicitante;
use App\Livewire\EntregarArchivar;
use App\Livewire\PanelSeguimiento;
use App\Livewire\MisAsignaciones;
use App\Http\Controllers\G1_DocumentosController;
use App\Livewire\CentralFileFilter;
use App\Livewire\DerivarTramite;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Ruta principal de trámites
Route::view('/tramites', 'tramites_lista')
    ->middleware(['auth', 'verified'])
    ->name('tramites_lista');

// Rutas específicas para cada trámite
Route::view('/tramites/constancia-expedito-profesional', 'constancia_expedito_profesional')
    ->middleware(['auth', 'verified'])
    ->name('constancia_expedito_profesional');

Route::view('/tramites/constancia-expedito-bachiller', 'constancia_expedito_bachiller')
    ->middleware(['auth', 'verified'])
    ->name('constancia_expedito_bachiller');

Route::view('/tramites/constancia-practicas-preprofesionales', 'constancia_practicas_preprofesionales')
    ->middleware(['auth', 'verified'])
    ->name('constancia_practicas_preprofesionales');

Route::view('/tramites/constancia-plan-tesis', 'constancia_plan_tesis')
    ->middleware(['auth', 'verified'])
    ->name('constancia_plan_tesis');

Route::view('/tramites/constancia-egresado', 'constancia_egresado')
    ->middleware(['auth', 'verified'])
    ->name('constancia_egresado');

Route::view('/tramites/certificado-estudios-pregrado', 'certificado_estudios_pregrado')
    ->middleware(['auth', 'verified'])
    ->name('certificado_estudios_pregrado');

Route::view('/tramites/certificado-practicas', 'certificado_practicas')
    ->middleware(['auth', 'verified'])
    ->name('certificado_practicas');

Route::view('/tramites/constancia-record-academico', 'constancia_record_academico')
    ->middleware(['auth', 'verified'])
    ->name('constancia_record_academico');

Route::view('/tramites/constancia-orden-merito', 'constancia_orden_merito')
    ->middleware(['auth', 'verified'])
    ->name('constancia_orden_merito');

Route::view('/tramites/cambio-titulo-asesor', 'cambio_titulo_asesor')
    ->middleware(['auth', 'verified'])
    ->name('cambio_titulo_asesor');

Route::view('/tramites/ampliacion-plazo-tesis', 'ampliacion_plazo_tesis')
    ->middleware(['auth', 'verified'])
    ->name('ampliacion_plazo_tesis');

Route::view('/tramites/otorgar-titulo-profesional', 'otorgar_titulo_profesional')
    ->middleware(['auth', 'verified'])
    ->name('otorgar_titulo_profesional');

Route::view('/tramites/otorgar-grado-academico', 'otorgar_grado_academico')
    ->middleware(['auth', 'verified'])
    ->name('otorgar_grado_academico');

Route::view('/tramites/otros-tramites', 'otros_tramites')
    ->middleware(['auth', 'verified'])
    ->name('otros_tramites');

Route::middleware(['auth', 'verified', 'role:operador'])->group(function () {
    Route::get('/verificacion-expediente', VerificacionExpediente::class)
        ->name('verificacionExpediente');

    Route::get('/registro-observaciones/{expedienteId?}', RegistroObservaciones::class)
        ->name('registroObservaciones');

    Route::get('/remision-expediente/{expedienteId?}', RemisionExpediente::class)
        ->name('remisionExpediente');

    Route::get('/registro-envio-automatico', RegistroEnvioAutomatico::class)
        ->name('registroEnvioAutomatico');

    Route::get('/formulario-flujo', FormularioFlujo::class)
        ->name('formularioFlujo');

    Route::get('/canalizar-envio', CanalizarEnvio::class)
        ->name('canalizarEnvio');

    Route::get('/revisar-expedientes-finalizados', RevisarExpedientesFinalizados::class)
        ->name('revisarExpedientesFinalizados');

    Route::get('/notificaciones-solicitante', NotificacionesSolicitante::class)
        ->name('notificacionesSolicitante');

    Route::get('/entregar-archivar', EntregarArchivar::class)
        ->name('entregarArchivar');

    Route::get('/panel-seguimiento', PanelSeguimiento::class)
        ->name('panelSeguimiento');
});

Route::middleware(['auth', 'verified', 'role:administrador'])->group(function () {
    Route::get('archivo_central', CentralFileFilter::class)
        ->name('archivo.central');

    Route::view('tramite_pendiente', 'Administrador.tramite_pendiente')
        ->name('tramite.pendiente');

    Route::view('tramite_en_proceso', 'Administrador.tramite_en_proceso')
        ->name('tramite.proceso');

    Route::view('tramite_finalizado', 'Administrador.tramite_finalizado')
        ->name('tramite.finalizado');
        
    Route::view('bandeja_entrada', 'Administrador.bandeja_entrada')
        ->name('bandeja.entrada');
});

Route::middleware(['auth', 'verified', 'role:funcionario'])->group(function () {
    Route::get('mis_asignaciones', MisAsignaciones::class)
        ->name('mis.asignaciones');

    Route::view('panel_principal', 'Funcionario.panel_principal')
        ->name('panel.principal');

    // bandeja salida
    Route::view('bandeja_salida', 'Funcionario.bandeja_salida')
        ->name('bandeja.salida');

    Route::view('perfil/editar', 'Funcionario.editar-perfil')
        ->name('perfil.editar');

    Route::get('tramites/{tramiteId}/derivar', DerivarTramite::class)
        ->name('derivar.tramite');
});



Route::view('ampliacion_plazo', 'ampliacion_plazo')
    ->middleware(['auth', 'verified'])
    ->name('ampliacion_plazo');

Route::view('cambio_titulo_asesor', 'cambio_titulo_asesor')
    ->middleware(['auth', 'verified'])
    ->name('cambio_titulo_asesor');

Route::view('otros_tramites', 'otros_tramites')
    ->middleware(['auth', 'verified'])
    ->name('otros_tramites');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

//Tramites 
use App\Http\Controllers\TramiteController;

Route::get('/tramites', [TramiteController::class, 'listaTramites'])->name('tramites.index');
Route::get('/tramites/{id}', [TramiteController::class, 'show'])->name('tramites.show');
Route::post('/tramites/{id}/enviar', [TramiteController::class, 'enviarSolicitud'])->name('tramites.enviar');

Route::get('/tramites/historial', function () {
    return 'Página de historial aún no implementada.';
})->name('tramites.historial');
