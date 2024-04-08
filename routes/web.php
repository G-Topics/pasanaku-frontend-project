<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\InvitacionController;
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

Route::get('/', [MainController::class, 'index'])->name('/');
Route::get('/registrar-partida', [MainController::class, 'registrarPartida'])->name('registrar-partida');
Route::get('/registrar-invitacion/{id_partida}', [MainController::class, 'registrarInvitacion'])->name('registrar-invitacion');



Route::post('/', [PartidaController::class, 'consumir']);
Route::post('/registrar-invitacion/{id_partida}', [InvitacionController::class, 'anadir']);
Route::delete('/registrar-invitacion/{id_partida}', [InvitacionController::class, 'eliminar'])->name('eliminar-invitacion');