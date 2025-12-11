<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Redirección inicial SIEMPRE al login (forzando logout)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    Auth::logout();             // 🔥 Fuerza cerrar sesión siempre
    session()->invalidate();    // Limpia la sesión
    session()->regenerateToken();

    return redirect()->route('login'); // Redirige al login
});

/*
|--------------------------------------------------------------------------
| Dashboard (solo autenticados)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Perfil de usuario (Laravel Breeze)
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
| Inventario (TODAS las rutas protegidas)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('inventario')->name('inventario.')->group(function () {

    Route::get('/', [InventarioController::class, 'index'])
        ->name('index');

    // Entradas
    Route::get('/entrada', [InventarioController::class, 'createEntrada'])
        ->name('createEntrada');

    Route::post('/entrada', [InventarioController::class, 'storeEntrada'])
        ->name('storeEntrada');

    // Salidas
    Route::get('/salida', [InventarioController::class, 'createSalida'])
        ->name('createSalida');

    Route::post('/salida', [InventarioController::class, 'storeSalida'])
        ->name('storeSalida');

    // Kardex
    Route::get('/kardex', [InventarioController::class, 'kardex'])
        ->name('kardex');
});
// rutas del controlador de ventas
Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');

// Factura
Route::get('/factura/{venta}', [FacturaController::class, 'show'])->name('factura.show');



/*
|--------------------------------------------------------------------------
| Rutas Breeze (login, register, logout, etc.)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
