<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\G1_DocumentosController;
use App\Livewire\CentralFileFilter;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('archivo_central', CentralFileFilter::class)
    ->middleware(['auth', 'verified'])
    ->name('archivo.central');

Route::view('tramite_pendiente', 'Administrador.tramite_pendiente')
    ->middleware(['auth', 'verified'])
    ->name('tramite.pendiente');

Route::view('tramite_en_proceso', 'Administrador.tramite_en_proceso')
    ->middleware(['auth', 'verified'])
    ->name('tramite.proceso');

Route::view('tramite_finalizado', 'Administrador.tramite_finalizado')
    ->middleware(['auth', 'verified'])
    ->name('tramite.finalizado');

Route::view('carga_documentos', 'Administrador.carga_documentos')
    ->middleware(['auth', 'verified'])
    ->name('carga.documentos');

Route::view('registro_expediente', 'Administrador.registro_expediente')
    ->middleware(['auth', 'verified'])
    ->name('registro.expediente');

Route::view('solicitudes_pendientes', 'Administrador.solicitudes_pendientes')
    ->middleware(['auth', 'verified'])
    ->name('solicitudes.pendientes');

Route::view('formulario_solicitudes', 'Administrador.formulario_solicitudes')
    ->middleware(['auth', 'verified'])
    ->name('formulario.solicitudes');

Route::view('enviar_expediente', 'Administrador.enviar_expediente')
    ->middleware(['auth', 'verified'])
    ->name('enviar.expediente');

Route::get('/carga_documentos', [G1_DocumentosController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('carga.documentos');

Route::post('/carga_documentos/subir', [G1_DocumentosController::class, 'subir'])
    ->name('documentos.subir');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
