<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Livewire\Livewire;

use App\Http\Controllers\NotificacionController;
use App\Models\Notificacion;

use App\Livewire\DependenciaBandeja;
use App\Livewire\MesadepartesElaboracion;
use App\Livewire\MesadepartesRegistro;
use App\Livewire\MesadepartesArchivar;
use App\Livewire\MesadepartesFinalizadas;
use App\Livewire\UsuarioBandeja;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('ejemplo', 'ejemplo')
    ->middleware(['auth', 'verified'])
    ->name('ejemplo');

Route::view('ejemplo_dashboard', 'ejemplo_dashboard')
    ->middleware(['auth', 'verified'])
    ->name('ejemplo.dashboard');

Route::post('/notificaciones/solicitar', [NotificacionController::class, 'store'])
    ->name('notificaciones.store');

Route::post('/notificaciones/finalizar/{id}', [NotificacionController::class, 'finalizar'])
    ->name('notificaciones.finalizar');

Route::get('/notificaciones/mesadepartes/bandeja', [NotificacionController::class, 'bandeja'])
    ->name('notificaciones.mesadepartes.bandeja');

Route::get('/notificaciones/mesadepartes/elaboracion/{id}', MesadepartesElaboracion::class)
    ->name('notificaciones.mesadepartes.elaboracion');

Route::get('/notificaciones/mesadepartes/registro', MesadepartesRegistro::class)
    ->name('notificaciones.mesadepartes.registro');

Route::get('/notificaciones/mesadepartes/archivar', MesadepartesArchivar::class)
    ->name('notificaciones.mesadepartes.archivar');

Route::middleware(['auth'])->group(function () {

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('/notificaciones/dependencia/bandeja', DependenciaBandeja::class)
        ->middleware('auth')
        ->name('notificaciones.dependencia.bandeja');


    Route::view('/notificaciones/dependencia/solicitud', 'dependencia-solicitud')
        ->name('notificaciones.dependencia.solicitud');

    Route::get('/notificaciones/usuario/bandeja', UsuarioBandeja::class)
        ->name('notificaciones.usuario.bandeja');

    Route::get('/notificaciones/mesadepartes/entrega-lista', [NotificacionController::class, 'entregaLista'])
        ->name('notificaciones.mesadepartes.entrega.lista');

    Route::get('/notificaciones/mesadepartes/entrega/{id}', function ($id) {
        $notificacion = Notificacion::findOrFail($id);
        return view('mesadepartes-entrega', compact('notificacion'));
    })->name('notificaciones.mesadepartes.entrega');

    Route::post('/notificaciones/mesadepartes/entrega/{id}', [NotificacionController::class, 'entregar'])
        ->name('notificaciones.mesadepartes.entregar');

    Route::post('/expedientes/archivar/{id}', [NotificacionController::class, 'archivar'])
        ->name('expedientes.archivar');

    Route::view('/notificaciones/mesadepartes/finalizadas', 'mesadepartes-finalizadas')
        ->name('notificaciones.mesadepartes.finalizadas');
});

require __DIR__ . '/auth.php';