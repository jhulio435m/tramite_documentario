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
