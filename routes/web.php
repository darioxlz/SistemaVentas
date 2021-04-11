<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TransaccionController;
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


    // Rutas USUARIO
    Route::view('/usuarios/listar', 'usuarios.listar')->name('usuarios.listar');
    Route::get('/usuarios/formulario', [UsuarioController::class, 'formulario'])->name('usuarios.formulario');

    Route::get('/datatables/usuarios/listar', [UsuarioController::class, 'data_listar'])->name('usuarios.data.listar');
    Route::post('/usuarios/crear', [UsuarioController::class, 'crear'])->name('usuarios.data.crear');
    Route::post('/usuarios/editar/{id}', [UsuarioController::class, 'editar'])->name('usuarios.data.editar');
    Route::get('/usuarios/eliminar/{id}', [UsuarioController::class, 'eliminar'])->name('usuarios.data.eliminar');
    // FIN Rutas USUARIO


    // Rutas CLIENTE
    Route::view('/clientes/listar', 'clientes.listar')->name('clientes.listar');
    Route::get('/clientes/formulario', [ClienteController::class, 'formulario'])->name('clientes.formulario');

    Route::get('/datatables/clientes/listar', [ClienteController::class, 'data_listar'])->name('clientes.data.listar');
    Route::post('/clientes/crear', [ClienteController::class, 'crear'])->name('clientes.data.crear');
    Route::post('/clientes/editar/{id}', [ClienteController::class, 'editar'])->name('clientes.data.editar');
    Route::get('/clientes/eliminar/{id}', [ClienteController::class, 'eliminar'])->name('clientes.data.eliminar');
    // FIN Rutas CLIENTE


    // Rutas PRODUCTO
    Route::view('/productos/listar', 'productos.listar')->name('productos.listar');
    Route::get('/productos/formulario', [ProductoController::class, 'formulario'])->name('productos.formulario');

    Route::get('/datatables/productos/listar', [ProductoController::class, 'data_listar'])->name('productos.data.listar');
    Route::get('/select2/productos/listar', [ProductoController::class, 'obtener_productos_select2'])->name('productos.data.select2');
    Route::post('/productos/crear', [ProductoController::class, 'crear'])->name('productos.data.crear');
    Route::post('/productos/editar/{id}', [ProductoController::class, 'editar'])->name('productos.data.editar');
    Route::get('/productos/eliminar/{id}', [ProductoController::class, 'eliminar'])->name('productos.data.eliminar');
    // FIN Rutas


    // Rutas CUENTA
    Route::get('/cuentas/listar', [CuentaController::class, 'listar'])->name('cuentas.listar');
    Route::get('/cuentas/formulario', [CuentaController::class, 'formulario'])->name('cuentas.formulario');

    Route::get('/datatables/cuentas/listar', [CuentaController::class, 'data_listar'])->name('cuentas.data.listar');
    Route::post('/cuentas/crear', [CuentaController::class, 'crear'])->name('cuentas.data.crear');
    Route::post('/cuentas/editar/{id}', [CuentaController::class, 'editar'])->name('cuentas.data.editar');
    Route::get('/cuentas/eliminar/{id}', [CuentaController::class, 'eliminar'])->name('cuentas.data.eliminar');
    // FIN Rutas CUENTA


    // Rutas PRESUPUESTO
    Route::view('/presupuestos/crear', 'presupuestos.crear')->name('presupuestos.crear');
    Route::post('/presupuestos/reporte/generar', [PresupuestoController::class, 'generar'])->name('presupuestos.generar');
    // FIN Rutas PRESUPUESTO


    // Rutas TRANSACCION
    Route::get('/transacciones/listar', [TransaccionController::class, 'listar'])->name('transacciones.listar');
    Route::get('/transacciones/formulario', [TransaccionController::class, 'formulario'])->name('transacciones.formulario');
    Route::get('/transacciones/reporte/generar', [TransaccionController::class, 'generar'])->name('transacciones.generar');

    Route::get('/datatables/transacciones/listar', [TransaccionController::class, 'data_listar'])->name('transacciones.data.listar');
    Route::post('/transacciones/crear', [TransaccionController::class, 'crear'])->name('transacciones.data.crear');
    // FIN Rutas TRANSACCION
});
