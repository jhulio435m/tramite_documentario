<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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
