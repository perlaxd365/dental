<?php

use App\Http\Controllers\calendarController;
use App\Http\Controllers\citaController;
use App\Http\Controllers\empresaController;
use App\Http\Controllers\indexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\userController;
use App\Http\Livewire\Admin\Cita;

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
    return view('welcome');
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
     */
    Route::get('index', [indexController::class, 'index'])->name('index');
    Route::get('cita', [citaController::class, 'index'])->name('cita');
    Route::get('logout', [logoutController::class, 'index'])->name('logout.perform');
    Route::get('empresa', [empresaController::class, 'index'])->name('empresa');
    Route::get('user', [userController::class, 'index'])->name('user');
    Route::get('calendar/{id}', [calendarController::class, 'list'])->name('calendar');
    Route::post('listCita', [citaController::class, 'list'])->name('listCita');
    Route::post('storeCita', [citaController::class, 'store'])->name('storeCita');
    Route::post('updateCita', [citaController::class, 'update'])->name('updateCita');
    Route::get('printCita/{id}', [citaController::class, 'print'])->name('printCita');
});
