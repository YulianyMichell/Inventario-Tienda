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
| CRUD principales: Clientes / Proveedores / Productos / Categorías / Presentaciones
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('clientes', ClienteController::class);

    // Corregido: renombramos parámetro singular para proveedores
    Route::resource('proveedores', ProveedorController::class)
        ->parameters(['proveedores' => 'proveedor']);

    Route::resource('productos', ProductoController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('presentaciones', PresentacionController::class);
});

Route::middleware('auth')
    ->prefix('factura')
    ->name('factura.')
    ->group(function () {

        // Lista de facturas
        Route::get('/', [FacturaController::class, 'index'])->name('index');

        // Descargar PDF
        Route::get('/descargar/{venta}', [FacturaController::class, 'descargar'])->name('descargar');

        // Ver detalle
        Route::get('/{venta}', [FacturaController::class, 'show'])->name('show');
    });
/*
|--------------------------------------------------------------------------
| Inventario
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->prefix('inventario')
    ->name('inventario.')
    ->group(function () {
        Route::get('/', [InventarioController::class, 'index'])->name('index');

        Route::get('/entrada', [InventarioController::class, 'createEntrada'])->name('createEntrada');
        Route::post('/entrada', [InventarioController::class, 'storeEntrada'])->name('storeEntrada');

        Route::get('/salida', [InventarioController::class, 'createSalida'])->name('createSalida');
        Route::post('/salida', [InventarioController::class, 'storeSalida'])->name('storeSalida');
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

        // Ruta para eliminar una venta
        Route::delete('/{venta}', [VentaController::class, 'destroy'])->name('destroy');
    });


/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
