<?php

use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FacturadeCompraController;
use App\Http\Controllers\FacturaVentaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores/{proveedor}', [ProveedorController::class, 'show'])->name('proveedores.show');
Route::get('/proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
Route::put('/proveedores/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');
Route::get('/api/buscar-proveedores', [ProveedorController::class, 'buscarProveedores'])->name('api.buscar-proveedores');

Route::resource('productos', ProductoController::class);
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');
Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
Route::get('productos/buscar', [ProductoController::class, 'buscar'])->name('productos.buscar');

Route::resource('facturas', FacturaController::class)->except(['edit', 'update', 'destroy']);
Route::get('/facturas/checkUniqueNumeroFactura', [FacturaController::class, 'checkUniqueNumeroFactura'])->name('facturas.checkUniqueNumeroFactura');
Route::get('/buscar-proveedores', [ProveedorController::class, 'buscar'])->name('proveedores.buscar');

// Rutas para la gestión de Ventas
Route::prefix('ventas')->group(function () {
    Route::get('/', [FacturaVentaController::class, 'index'])->name('facturaventa.index');
    Route::get('/create', [FacturaVentaController::class, 'create'])->name('facturaventa.create');
    Route::post('/', [FacturaVentaController::class, 'store'])->name('facturaventa.store');
    Route::get('/{ventas}', [FacturaVentaController::class, 'show'])->name('facturaventa.show');
});

Route::get('/api/clientes', [ClienteController::class, 'search'])->name('api.clientes.search');
Route::get('/api/productos', [ProductoController::class, 'allProducts'])->name('api.productos.all');
