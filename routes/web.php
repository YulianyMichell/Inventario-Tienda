<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Inventario
Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');

Route::get('/inventario/entrada', [InventarioController::class, 'createEntrada'])->name('inventario.createEntrada');
Route::post('/inventario/entrada', [InventarioController::class, 'storeEntrada'])->name('inventario.storeEntrada');

Route::get('/inventario/salida', [InventarioController::class, 'createSalida'])->name('inventario.createSalida');
Route::post('/inventario/salida', [InventarioController::class, 'storeSalida'])->name('inventario.storeSalida');


require __DIR__.'/auth.php';
