<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\LlamadoAtencionController;

Route::get('/', function () {
    return view('welcome');
});

// Grupo de rutas para empleados
Route::controller(EmpleadoController::class)->group(function () {
    Route::get('/empleados', 'index')->name('empleados.index');
    Route::get('/empleados/create', 'create')->name('empleados.create');
    Route::post('/empleados', 'store')->name('empleados.store');
    Route::get('/empleados/{id}/edit', 'edit')->name('empleados.edit');
    Route::put('/empleados/{id}/desactivar', 'desactivar')->name('empleados.desactivar');
    Route::put('/empleados/{id}', 'update')->name('empleados.update');
    Route::get('/empleados/{id}', 'show')->name('empleados.show');
});

// Rutas para llamados de atención
Route::get('llamados/create', [LlamadoAtencionController::class, 'create'])->name('llamados.create');
Route::post('llamados', [LlamadoAtencionController::class, 'store'])->name('llamados.store');
Route::get('/empleados/{id}/historial', [EmpleadoController::class, 'historial'])->name('empleados.historial');
