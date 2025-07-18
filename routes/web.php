
<?php




use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\ProveedorController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\LlamadoAtencionController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ClienteController;

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

Route::get('/empleados/{id}/historial', [EmpleadoController::class, 'historial'])->name('empleados.historial');

Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores/{proveedor}', [ProveedorController::class, 'show'])->name('proveedores.show');
Route::get('/proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
Route::put('/proveedores/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');
Route::put('/proveedores/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');


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


Route::resource('productos', ProductoController::class);
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');
Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
Route::get('productos/buscar', [ProductoController::class, 'buscar'])->name('productos.buscar');



Route::controller(ClienteController::class)->group(function () {
    Route::get('/clientes', 'index')->name('clientes.index');           // ✔ Listado principal
    Route::get('/clientes/buscar', 'buscar')->name('clientes.buscar');  // ❗ Filtro AJAX (te faltaba)
    Route::get('/clientes/create', 'create')->name('clientes.create');  // ✔ Formulario crear
    Route::post('/clientes', 'store')->name('clientes.store');          // ✔ Guardar nuevo cliente

    Route::get('/clientes/{cliente}', 'show')->name('clientes.show');   // ❗ Ver detalles
    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit'); // ❗ Formulario editar
    Route::put('/clientes/{cliente}', 'update')->name('clientes.update');  // ❗ Guardar cambios

});

Route::resource('facturas', FacturaController::class);
Route::get('facturas/{factura}', [FacturaController::class, 'show'])->name('facturas.show');


