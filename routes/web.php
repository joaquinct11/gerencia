<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

 Route::middleware([
     'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
     Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
 });

Route::resource('incidencias', IncidenciaController::class);

Route::resource('usuarios', UsuarioController::class);

Route::get('/incidencias/{id}/solucionar', [IncidenciaController::class, 'solucionar'])->name('incidencia.solucionar');

Route::get('/principal', [IncidenciaController::class, 'principal'])->name('incidencia.principal');



//Route::get('/dash', [DashboardController::class, 'index']);

