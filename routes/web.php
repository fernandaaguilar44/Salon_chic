
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\LlamadoAtencionController;
use App\Http\Controllers\ServicioController;


Route::get('/', function () {
    return view('welcome');
});

Route::controller(EmpleadoController::class)->group(function () {
    Route::get('/empleados', 'index')->name('empleados.index');
    Route::get('/empleados/create', 'create')->name('empleados.create'); // ✅ Primero las rutas fijas
    Route::post('/empleados', 'store')->name('empleados.store');
    Route::get('/empleados/buscar',  'buscar')->name('empleados.buscar');
    Route::get('/empleados/{id}/edit', 'edit')->name('empleados.edit');
    Route::put('/empleados/{id}/deshabilitar', [EmpleadoController::class, 'deshabilitar'])->name('empleados.deshabilitar');
    Route::put('/empleados/{id}', 'update')->name('empleados.update');
    Route::get('/empleados/{id}', 'show')->name('empleados.show');// ✅ Ruta con parámetro debe ir al final


});



// Rutas para llamados de atención
Route::get('llamados/create/{empleado_id?}', [LlamadoAtencionController::class, 'create'])->name('llamados.create');
Route::post('llamados', [LlamadoAtencionController::class, 'store'])->name('llamados.store');
Route::get('/empleados/{id}/llamados', [LlamadoAtencionController::class, 'historial'])->name('llamados.historial');



Route::controller(ServicioController::class)->group(function () {
    Route::get('/servicios', 'index')->name('servicios.index');
    Route::get('/servicios/buscar', 'buscar')->name('servicios.buscar');
    Route::get('/servicios/create', 'create')->name('servicios.create');
    Route::post('/servicios', 'store')->name('servicios.store');
    Route::get('/servicios/{servicio}/edit', [ServicioController::class, 'edit'])->name('servicios.edit');
    Route::put('servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update');
    Route::get('/servicios/{servicio}', 'show')->name('servicios.show');


});