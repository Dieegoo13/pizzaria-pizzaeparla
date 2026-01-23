<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [SiteController::class, 'index'])->name('site.index');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/checkout', [SiteController::class, 'checkout'])->name('site.checkout');

Route::get('/perfil', [SiteController::class, 'perfil'])->name('site.perfil');

// Route::put('/perfil/atualizar', [PerfilController::class, 'atualizar'])->name('perfil.atualizar');
// Route::put('/perfil/atualizar-senha', [PerfilController::class, 'atualizarSenha'])->name('perfil.atualizar-senha');
// Route::delete('/perfil/deletar', [PerfilController::class, 'deletar'])->name('perfil.deletar');

// Route::post('/enderecos', [EnderecoController::class, 'store'])->name('enderecos.store');
// Route::delete('/enderecos/{id}', [EnderecoController::class, 'destroy'])->name('enderecos.destroy');

// Route::post('/cartoes', [CartaoController::class, 'store'])->name('cartoes.store');
// Route::delete('/cartoes/{id}', [CartaoController::class, 'destroy'])->name('cartoes.destroy');