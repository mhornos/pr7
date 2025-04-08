<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthController::class, 'procesarLogin'])->name('login.process');

Route::get('/register', [AuthController::class, 'mostrarRegister'])->name('register');
Route::post('/register', [AuthController::class, 'procesarRegister'])->name('register.process');

Route::get('/', [ArticleController::class, 'index'])->name('home');



