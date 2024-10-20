<?php
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HistoricoPedidosController;
use App\Http\Controllers\Vendedor\CadastroRestauranteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinhaDoTempoController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\EditarPerfilController;
use Illuminate\Support\Facades\Route;

Route::get('/cadastro', [RegisterController::class, 'index'])->name('registrar');
Route::post('/cadastro', [RegisterController::class, 'register']);
Route::post('/cadastro', [RegisterController::class, 'create'])->name('create');

Route::get('/cadastro-restaurante', [CadastroRestauranteController::class, 'index'])->name('cadastro-restaurantes');
Route::post('/cadastro-restaurante', [CadastroRestauranteController::class, 'register'])->name('registrar.cadastro-restaurante');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/editar-perfil', [EditarPerfilController::class, 'index'])->name('perfil');

    route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos');

    Route::get('/historico-pedidos', [HistoricoPedidosController::class, 'index'])->name('historico-pedidos');

    Route::get('/linha-do-tempo', [LinhaDoTempoController::class, 'index'])->name('linha-do-tempo');
});
