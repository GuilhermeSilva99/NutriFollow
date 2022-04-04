<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\NutricionistaController;

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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/nutricionista/cadastro-nao-aprovado', [NutricionistaController::class, 'cadastroNaoConfirmado'])->name('nutricionista.cadastroNaoConfirmado');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'CheckCadastroAprovadoNutricionista'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::middleware('CheckUserAdmin')->group(function () {
        //Route::redirect('/dashboard', '/admin/home');
        Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');
        Route::put('/ativar/{id}', [HomeController::class, 'ativar_cadastro'])->name('cadastro.ativar');
        Route::delete('/deletar/{id}', [HomeController::class, 'recusar_cadastro'])->name('cadastro.recusar');
    });
});
