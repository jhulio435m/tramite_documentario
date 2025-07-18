<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\VerificacionExpediente;
use App\Livewire\RegistroObservaciones;
use App\Livewire\RemisionExpediente;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/verificacion-expediente', VerificacionExpediente::class)
    ->middleware(['auth', 'verified'])
    ->name('verificacionExpediente');

Route::get('/registro-observaciones/{expedienteId?}', RegistroObservaciones::class)
    ->middleware(['auth', 'verified'])
    ->name('registroObservaciones');

Route::get('/remision-expediente/{expedienteId?}', RemisionExpediente::class)
    ->middleware(['auth', 'verified'])
    ->name('remisionExpediente');

Route::view('registroEnvioAutomatico', 'registroEnvioAutomatico')
    ->middleware(['auth', 'verified'])
    ->name('registroEnvioAutomatico');

Route::view('formularioFlujo', 'formularioFlujo')
    ->middleware(['auth', 'verified'])
    ->name('formularioFlujo');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
