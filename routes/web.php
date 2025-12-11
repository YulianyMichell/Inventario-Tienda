<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\VentaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página principal (Dashboard)
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    /* ======================================================
       ================  CRUDS DE YULIANY  ==================
       ====================================================== */

    // CLIENTES
    Route::resource('clientes', ClienteController::class);

    // PROVEEDORES
    Route::resource('proveedores', ProveedorController::class);

    // CATEGORÍAS
    Route::resource('categorias', CategoriaController::class);

    // PRODUCTOS
    Route::resource('productos', ProductoController::class);
    