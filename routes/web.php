<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/acceso', [LoginController::class, 'mostrar'])->name('acceso')->middleware('guest');
Route::post('/acceso', [LoginController::class, 'autenticar'])->name('autenticar')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::view('/inicio', 'home')->name('inicio');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
