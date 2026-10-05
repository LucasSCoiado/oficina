<?php

use App\Http\Controllers\MainController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::view('/login', 'auth.login')->name('login');
});
Route::get('/', [MainController::class, 'index'])->middleware('auth')->name('home');
