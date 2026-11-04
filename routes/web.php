<?php

use App\Http\Controllers\MainController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::view('/login', 'auth.login')->name('login');
});
Route::get('/', [MainController::class, 'index'])->middleware('auth')->name('home');


// Carros
Route::get('/carros', [App\Http\Controllers\CarroController::class, 'index'])->name('carros.index');
Route::get('/carros/carro/{id}', [App\Http\Controllers\CarroController::class, 'carro'])->name('carros.carro');
Route::get('/carros/create', [App\Http\Controllers\CarroController::class, 'create'])->name('carros.create');
Route::post('/carros', [App\Http\Controllers\CarroController::class, 'store'])->name('carros.store');
Route::get('/carros/edit/{id}', [App\Http\Controllers\CarroController::class, 'edit'])->name('carros.edit');
Route::put('/carros/{id}', [App\Http\Controllers\CarroController::class, 'update'])->name('carros.update');
Route::delete('/carros/{id}', [App\Http\Controllers\CarroController::class, 'destroy'])->name('carros.destroy');
Route::get('carro/destroy/{id}', [App\Models\Carro::class, 'destroy'])->name('carros.destroy');
Route::get('/carros/trabalhos', [App\Http\Controllers\CarroController::class, 'index_trabalho'])->name('carros.trabalho');
Route::get('/carros/trabalho', [App\Http\Controllers\CarroController::class, 'addServico'])->name('carros.trabalho.carro');
Route::post('/carros/trabalho', [App\Http\Controllers\CarroController::class, 'storeServico'])->name('carros.servico.store');
Route::post('/ordens-servico/{id}/iniciar', [App\Http\Controllers\CarroController::class, 'iniciarServico'])->name('carros.servico.iniciar');
Route::post('/ordens-servico/{id}/finalizar', [App\Http\Controllers\CarroController::class, 'finalizarServico'])->name('carros.servico.finalizar');
Route::get('/carros/finalizado', [App\Http\Controllers\CarroController::class, 'index_finalizado'])->name('carros.finalizado');
