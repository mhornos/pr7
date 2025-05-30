<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RestartPasswordController;
use App\Http\Controllers\CanviarPasswordController;
use App\Http\Controllers\EditarPerfilController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', [ArticleController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthController::class, 'procesarLogin'])->name('login.process');

Route::get('/register', [AuthController::class, 'mostrarRegister'])->name('register');
Route::post('/register', [AuthController::class, 'procesarRegister'])->name('register.process');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/canviar-password', [PasswordController::class, 'mostrarFormulari'])->name('password.cambiar');

Route::get('/vehicle/inserir', [VehicleController::class, 'formulariInserir'])->name('vehicle.inserir');
Route::post('/vehicles/inserir', [VehicleController::class, 'inserir'])->name('vehicle.inserir.process');

Route::get('/vehicle/modificar', [VehicleController::class, 'formulariModificar'])->name('vehicle.modificar');
Route::post('/modificar', [VehicleController::class, 'modificar'])->name('vehicle.modificar.process');

Route::get('/vehicle/esborrar', [VehicleController::class, 'formulariEsborrar'])->name('vehicle.esborrar');
Route::post('/vehicle/esborrar', [VehicleController::class, 'esborrar'])->name('vehicle.esborrar.process');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.cambiar');
Route::post('/forgot-password', [ForgotPasswordController::class, 'enviarCorreu'])->name('password.send');

Route::get('/restart-password/{token}', [RestartPasswordController::class, 'showForm'])->name('password.restart');
Route::post('/restart-password/{token}', [RestartPasswordController::class, 'processar'])->name('password.restart.process');

Route::get('/canviar-contrasenya', [CanviarPasswordController::class, 'form'])->name('password.form');
Route::post('/canviar-contrasenya', [CanviarPasswordController::class, 'update'])->name('password.update');

Route::get('/perfil/editar', [EditarPerfilController::class, 'formulari'])->name('perfil.editar');
Route::post('/perfil/editar', [EditarPerfilController::class, 'editar'])->name('perfil.editar.process');

Route::get('/admin/usuaris', [AdminController::class, 'index'])->name('usuaris.gestionar');
Route::post('/admin/usuaris/eliminar', [AdminController::class, 'eliminar'])->name('usuaris.eliminar');
Route::post('/usuaris/confirmar-eliminar', [AdminController::class, 'confirmarEliminacio'])->name('usuaris.confirmar');
Route::post('/usuaris/eliminar', [AdminController::class, 'eliminar'])->name('usuaris.eliminar');