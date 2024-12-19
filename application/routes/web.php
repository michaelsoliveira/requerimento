<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SolicitacaoController;
use App\Http\Controllers\AtendenteController;
use App\Http\Controllers\MenuController;
use Illuminate\Http\Request;

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

// Tela de login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Rota de envio do formulário para autenticar
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/solicitacao/store', [SolicitacaoController::class, 'store'])->name('solicitacao.store');


Route::get('/atendente', [AtendenteController::class, 'index']);