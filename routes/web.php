<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\VehicleController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthController::class, 'procesarLogin'])->name('login.process');

Route::get('/register', [AuthController::class, 'mostrarRegister'])->name('register');
Route::post('/register', [AuthController::class, 'procesarRegister'])->name('register.process');

Route::get('/', [ArticleController::class, 'index'])->name('home');

Route::get('/perfil/editar', [PerfilController::class, 'editar'])->name('perfil.editar');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/canviar-password', [PasswordController::class, 'mostrarFormulari'])->name('password.cambiar');

Route::get('/vehicle/inserir', [VehicleController::class, 'formulari'])->name('vehicle.inserir');
Route::get('/vehicle/modificar', [VehicleController::class, 'formulariModificar'])->name('vehicle.modificar');
Route::get('/vehicle/esborrar', [VehicleController::class, 'formulariEsborrar'])->name('vehicle.esborrar');




