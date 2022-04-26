<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{HomeController, AdminController};
use App\Http\Controllers\NutricionistaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PacienteController;
use App\Models\Paciente;

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

Route::redirect('/', '/dashboard');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/nutricionista/cadastro-nao-aprovado', [NutricionistaController::class, 'cadastroNaoConfirmado'])->name('nutricionista.cadastroNaoConfirmado');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'CheckCadastroAprovadoNutricionista'])->group(function () {
    Route::get('/dashboard', [LoginController::class, 'redirect'])->name('dashboard');
    Route::get('/cadastrar-paciente', [NutricionistaController::class, 'cadastrarPacienteView'])->name('nutricionista.cadastrar.paciente');
    Route::post('/cadastrar-paciente', [NutricionistaController::class, 'storePaciente'])->name('nutricionista.store.paciente');

    Route::middleware('CheckUserAdmin')->group(function () {
        Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');
        Route::put('/ativar/{id}', [HomeController::class, 'ativar_cadastro'])->name('cadastro.ativar');
        Route::delete('/deletar/{id}', [HomeController::class, 'recusar_cadastro'])->name('cadastro.recusar');
        Route::get('/admin/lista-nutricionistas', [AdminController::class, 'index'])->name('nutricionistas.listar');
        Route::delete('/inativar/{id}', [AdminController::class, 'inativar'])->name('nutricionista.inativar');
        Route::get('/admin/lista-nutricionistas-inativos', [AdminController::class, 'listar_nutricionistas_inativos'])->name('nutricionistas.inativos.listar');
        Route::put('/reativar/{id}', [AdminController::class, 'reativar'])->name('nutricionista.reativar');
    });

    Route::get('/paciente/register-paciente', [PacienteController::class, 'index']);
    Route::post('/paciente/create', [PacienteController::class, 'storePaciente'])->name('paciente.create');

    Route::get('/list/paciente', [PacienteController::class, 'list'])->name('paciente.list');

    Route::get('/editar/paciente/{id}', [PacienteController::class, 'getEditar'])->name('paciente.get.edit');
    Route::post('/editar/paciente', [PacienteController::class, 'editar'])->name('paciente.edit');

    Route::get('/view/paciente/{id}', [PacienteController::class, 'view'])->name('paciente.view');

    Route::get('/paciente/password/{id}', [PacienteController::class, 'edit_password'])->name('paciente.password.edit');
    Route::post('/paciente/password', [PacienteController::class, 'reset_password'])->name('paciente.reset');
});
