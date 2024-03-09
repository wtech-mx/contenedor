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

// =============== M O D U L O   login custom ===============================

// Route::get('dashboard', [App\Http\Controllers\CustomAuthController::class, 'dashboard']);
Route::get('login', [App\Http\Controllers\CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [App\Http\Controllers\CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [App\Http\Controllers\CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [App\Http\Controllers\CustomAuthController::class, 'signOut'])->name('signout');


Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('permisos', PermisosController::class);
    Route::resource('users', UserController::class);


    // ==================== C L I E N T E S ====================
    Route::resource('clients', ClientController::class);
    Route::post('clients/create', [App\Http\Controllers\ClientController::class, 'store'])->name('store.clients');

    // ==================== P R O V E E D O R E S ====================
    Route::get('proveedores', [App\Http\Controllers\ProveedorController::class, 'index'])->name('index.proveedores');
    Route::post('proveedores/create', [App\Http\Controllers\ProveedorController::class, 'store'])->name('store.proveedores');
    Route::post('proveedores/create/cuenta', [App\Http\Controllers\ProveedorController::class, 'cuenta'])->name('cuenta.proveedores');
    Route::patch('proveedores/update/{id}', [App\Http\Controllers\ProveedorController::class, 'update'])->name('update.proveedores');

    // ==================== E Q U I P O S ====================
    Route::get('equipos/index', [App\Http\Controllers\EquiposController::class, 'index'])->name('index.equipos');
    Route::post('equipos/create', [App\Http\Controllers\EquiposController::class, 'store'])->name('store.equipos');
    Route::patch('equipos/update/{id}', [App\Http\Controllers\EquiposController::class, 'update'])->name('update.equipos');

    // ==================== O P E R A D O R E S ====================
    Route::get('operadores', [App\Http\Controllers\OperadorController::class, 'index'])->name('index.operadores');
    Route::post('operadores/create', [App\Http\Controllers\OperadorController::class, 'store'])->name('store.operadores');
    Route::patch('operadores/update/{id}', [App\Http\Controllers\OperadorController::class, 'update'])->name('update.operadores');



});

//Route Hooks - Do not delete//
Route::view('/especialists', 'livewire.especialists.index')->middleware('auth');

/*|--------------------------------------------------------------------------
|Configuracion
|--------------------------------------------------------------------------*/
Route::get('/configuracion', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('index.configuracion');
Route::patch('/configuracion/update', [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('update.configuracion');
