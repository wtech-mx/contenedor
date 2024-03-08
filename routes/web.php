<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PermisosController;


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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('permisos', PermisosController::class);
    Route::resource('users', UserController::class);
    Route::resource('clients', ClientController::class);


    Route::get('proveedores', [App\Http\Controllers\ProveedorController::class, 'index'])->name('index.proveedores');
    Route::post('proveedores/create', [App\Http\Controllers\ProveedorController::class, 'store'])->name('store.proveedores');
    Route::patch('proveedores/update/{id}', [App\Http\Controllers\ProveedorController::class, 'update'])->name('update.proveedores');

    Route::get('equipos', [App\Http\Controllers\EquiposController::class, 'index'])->name('index.equipos');
    Route::patch('equipos/update/{id}', [App\Http\Controllers\EquiposController::class, 'update'])->name('update.equipos');

    Route::get('operadores', [App\Http\Controllers\OperadorController::class, 'index'])->name('index.operadores');
    Route::patch('operadores/update/{id}', [App\Http\Controllers\OperadorController::class, 'update'])->name('update.operadores');



});

//Route Hooks - Do not delete//
Route::view('/especialists', 'livewire.especialists.index')->middleware('auth');

/*|--------------------------------------------------------------------------
|Configuracion
|--------------------------------------------------------------------------*/
Route::get('/configuracion', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('index.configuracion');
Route::patch('/configuracion/update', [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('update.configuracion');
