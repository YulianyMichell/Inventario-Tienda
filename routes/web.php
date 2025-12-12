<?php

use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PresentacionController;
use App\Http\Controllers\FacturaController;


/*
|--------------------------------------------------------------------------
| Redirección inicial AL LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login'));


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Perfil del usuario
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| CRUD principales: Clientes / Proveedores / Productos
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::resource('clientes', ClienteController::class);
    Route::resource('proveedores', ProveedorController::class);
    Route::resource('productos', ProductoController::class);

    Route::resource('categorias', CategoriaController::class);
    Route::resource('presentaciones', PresentacionController::class);
});

// Factura
//lista de facturas
Route::get('/facturas', [FacturaController::class, 'index'])->name('factura.index');
//factura especifica
Route::get('/factura/{venta}', [FacturaController::class, 'show'])->name('factura.show');



/*
|--------------------------------------------------------------------------
| Inventario (CORREGIDO)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->prefix('inventario')
    ->name('inventario.')
    ->group(function () {

        Route::get('/', [InventarioController::class, 'index'])->name('index'); // inventario.index

        Route::get('/entrada', [InventarioController::class, 'createEntrada'])->name('createEntrada'); // inventario.createEntrada
        Route::post('/entrada', [InventarioController::class, 'storeEntrada'])->name('storeEntrada'); // inventario.storeEntrada

        Route::get('/salida', [InventarioController::class, 'createSalida'])->name('createSalida'); // inventario.createSalida
        Route::post('/salida', [InventarioController::class, 'storeSalida'])->name('storeSalida'); // inventario.storeSalida

        // 🛑 LÍNEA ELIMINADA: La ruta 'inventario.create' ya no existe para evitar el error.
    });


/*
|--------------------------------------------------------------------------
| Ventas
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->prefix('ventas')
    ->name('ventas.')
    ->group(function () {

        Route::get('/', [VentaController::class, 'index'])->name('index');
        Route::get('/create', [VentaController::class, 'create'])->name('create');
        Route::post('/', [VentaController::class, 'store'])->name('store');
    });


/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';