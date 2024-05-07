<?php

use App\Http\Controllers\calendarController;
use App\Http\Controllers\citaController;
use App\Http\Controllers\contratoController;
use App\Http\Controllers\empresaController;
use App\Http\Controllers\historiaController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\laboratorioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\productolabController;
use App\Http\Controllers\recetaController;
use App\Http\Controllers\saldoController;
use App\Http\Controllers\userController;
use App\Http\Controllers\ventaController;
use App\Http\Livewire\Admin\Cita;
use App\Models\ProductoLaboratorio;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/index', function () {
        return view('index');
    })->name('index');
});
Route::group(['middleware' => ['auth']], function () {
    /**
     * Logout Route
     *//* 
    Route::get('/', [indexController::class, 'index'])->name('/'); */
    Route::redirect('/dashboard', '/index')->name('dashboard');

    //USUARIOS
    Route::get('index', [indexController::class, 'index'])->name('index');
    Route::get('logout', [logoutController::class, 'index'])->name('logout.perform');
    Route::get('user', [userController::class, 'index'])->name('user');

    //EMPRESAS
    Route::get('empresa', [empresaController::class, 'index'])->name('empresa');
    Route::get('calendar/{id}', [calendarController::class, 'list'])->name('calendar');

    //CITA
    Route::get('cita', [citaController::class, 'index'])->name('cita');
    Route::post('listCita', [citaController::class, 'list'])->name('listCita');
    Route::post('storeCita', [citaController::class, 'store'])->name('storeCita');
    Route::post('updateCita', [citaController::class, 'update'])->name('updateCita');
    Route::post('emailCita', [citaController::class, 'email'])->name('emailCita');
    Route::get('printCita/{id}', [citaController::class, 'print'])->name('printCita');

    //LABORATORIO
    Route::get('laboratorio', [laboratorioController::class, 'index'])->name('laboratorio');
    Route::get('productolab', [productolabController::class, 'index'])->name('productolab');

    //RECETA
    Route::get('receta', [recetaController::class, 'index'])->name('receta');

    //PACIENTE
    Route::get('paciente', [pacienteController::class, 'index'])->name('paciente');

    //PACIENTE
    Route::get('contrato', [contratoController::class, 'index'])->name('contrato');

    //VENTAS
    Route::get('venta', [ventaController::class, 'index'])->name('venta');

    //PERFIL
    Route::get('perfil', [PerfilController::class, 'index'])->name('perfil');

    //HISTORIA
    Route::get('historia', [historiaController::class, 'index'])->name('historia');
    
    //SALDOS
    Route::get('saldo', [saldoController::class, 'index'])->name('saldo');
    
});
