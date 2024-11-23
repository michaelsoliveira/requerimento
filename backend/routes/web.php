<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function(){
    return view('welcome');
});

Route::get('auth/login', [AuthController::class, 'showLoginForm'])->name('login');

// Rota para processar o login
Route::post('auth/login', [AuthController::class, 'login']);

// Rota para a tela de boas-vindas após o login bem-sucedido
Route::get('/welcome', function () {
    return "Bem-vindo ao sistema!";
})->name('welcome');

Route::get('/ava', function(){
    return view('auth.login_ava');
});
