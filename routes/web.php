<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsuarioController;
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
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::view('/usuarios/listar', 'usuarios.listar')->name('usuarios.listar');
    Route::get('/usuarios/formulario', [UsuarioController::class, 'formulario'])->name('usuarios.formulario');

    Route::get('/datatables/usuarios/listar', [UsuarioController::class, 'data_listar'])->name('usuarios.data.listar');
    Route::post('/usuarios/crear', [UsuarioController::class, 'crear'])->name('usuarios.data.crear');
    Route::post('/usuarios/editar/{id}', [UsuarioController::class, 'editar'])->name('usuarios.data.editar');
    Route::get('/usuarios/eliminar/{id}', [UsuarioController::class, 'eliminar'])->name('usuarios.data.eliminar');
});
