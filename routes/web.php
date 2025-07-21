<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\DerivarTramite;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('mis_asignaciones', 'mis_asignaciones')
    ->middleware(['auth', 'verified'])
    ->name('mis.asignaciones');

Route::view('panel_principal', 'panel_principal')
    ->middleware(['auth', 'verified'])
    ->name('panel.principal');

// bandeja salida
Route::view('bandeja_salida', 'bandeja_salida')
    ->middleware(['auth', 'verified'])
    ->name('bandeja.salida');


Route::view('perfil/editar', 'editar-perfil')
    ->middleware(['auth', 'verified'])
    ->name('perfil.editar');

Route::get('tramites/{tramiteId}/derivar', DerivarTramite::class)
    ->middleware(['auth', 'verified'])
    ->name('derivar.tramite');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
