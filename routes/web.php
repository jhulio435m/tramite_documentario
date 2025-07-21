<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\TramiteController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('ejemplo', 'ejemplo')->name('ejemplo');
    Route::view('ejemplo_dashboard', 'ejemplo_dashboard')->name('ejemplo.dashboard');
    Route::view('ampliacion_plazo', 'ampliacion_plazo')->name('ampliacion_plazo');
    Route::view('cambio_titulo_asesor', 'cambio_titulo_asesor')->name('cambio_titulo_asesor');
    Route::view('otros_tramites', 'otros_tramites')->name('otros_tramites');
});


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

// Tramites

Route::get('/tramites', [TramiteController::class, 'listaTramites'])->name('tramites.index');
Route::get('/tramites/{id}', [TramiteController::class, 'show'])->name('tramites.show');
Route::post('/tramites/{id}/enviar', [TramiteController::class, 'enviarSolicitud'])->name('tramites.enviar');

Route::get('/tramites/historial', function () {
    return 'Página de historial aún no implementada.';
})->name('tramites.historial');
