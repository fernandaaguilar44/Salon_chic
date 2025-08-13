
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\LlamadoAtencionController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CitaController;


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

Route::controller(ClienteController::class)->group(function () {
    Route::get('/clientes', 'index')->name('clientes.index');           // ✔ Listado principal
    Route::get('/clientes/buscar', 'buscar')->name('clientes.buscar');  // ❗ Filtro AJAX (te faltaba)
    Route::get('/clientes/create', 'create')->name('clientes.create');  // ✔ Formulario crear
    Route::post('/clientes', 'store')->name('clientes.store');          // ✔ Guardar nuevo cliente

    Route::get('/clientes/{cliente}', 'show')->name('clientes.show');   // ❗ Ver detalles
    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit'); // ❗ Formulario editar
    Route::put('/clientes/{cliente}', 'update')->name('clientes.update');  // ❗ Guardar cambios

});
// Agregar estas rutas a tu archivo web.php

Route::controller(CitaController::class)->group(function () {
    Route::get('/citas', 'index')->name('citas.index');           // ✔ Listado principal
    Route::get('/citas/buscar', 'buscar')->name('citas.buscar');  // ✔ Filtro AJAX
    Route::get('/citas/create', 'create')->name('citas.create');  // ✔ Formulario crear
    Route::post('/citas', 'store')->name('citas.store');          // ✔ Guardar nueva cita

    Route::get('/citas/{cita}', 'show')->name('citas.show');      // ✔ Ver detalles
    Route::get('/citas/{cita}/edit', 'edit')->name('citas.edit'); // ✔ Formulario editar
    Route::put('/citas/{cita}', 'update')->name('citas.update');  // ✔ Guardar cambios


// ✅ Opción 1: Ruta específica
    Route::get('/citas-disponibilidad', [App\Http\Controllers\CitaController::class, 'disponibilidad'])->name('citas.disponibilidad');

});