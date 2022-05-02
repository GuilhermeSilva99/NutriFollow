<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AdminController};
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\NutricionistaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RefeicaoController;
use App\Http\Controllers\DietaController;
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
    Route::get('/cadastrar-paciente', [NutricionistaController::class, 'cadastrarPaciente'])->name('nutricionista.cadastrar.paciente');
    Route::post('/cadastrar-paciente', [NutricionistaController::class, 'storePaciente'])->name('nutricionista.store.paciente');

    Route::middleware('CheckUserAdmin')->group(function () {
        Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
        Route::put('/ativar/{id}', [AdminController::class, 'ativarCadastro'])->name('cadastro.ativar');
        Route::delete('/deletar/{id}', [AdminController::class, 'recusarCadastro'])->name('cadastro.recusar');
        Route::get('/admin/lista-nutricionistas', [AdminController::class, 'listaNutricionista'])->name('nutricionistas.listar');
        Route::delete('/inativar/{id}', [AdminController::class, 'inativar'])->name('nutricionista.inativar');
        Route::get('/admin/lista-nutricionistas-inativos', [AdminController::class, 'listar_nutricionistas_inativos'])->name('nutricionistas.inativos.listar');
        Route::put('/reativar/{id}', [AdminController::class, 'reativar'])->name('nutricionista.reativar');
    });

    Route::get('/paciente/register-paciente', [PacienteController::class, 'index']);
    Route::post('/paciente/create', [NutricionistaController::class, 'storePaciente'])->name('paciente.create');

    Route::get('/list/paciente', [NutricionistaController::class, 'list'])->name('paciente.list');

    Route::get('/editar/paciente/{id}', [NutricionistaController::class, 'getEditar'])->name('paciente.get.edit');
    Route::post('/editar/paciente/{id}', [NutricionistaController::class, 'editar'])->name('paciente.edit');

    Route::get('/view/paciente/{id}', [NutricionistaController::class, 'view'])->name('paciente.view');

    Route::get('/paciente/password/{id}', [NutricionistaController::class, 'edit_password'])->name('paciente.password.edit');
    Route::post('/paciente/password/{id}', [NutricionistaController::class, 'reset_password'])->name('paciente.reset');
});

Route::get('/nutricionista/cadastro-refeicao', [RefeicaoController::class, 'index']);#->name('refeicao.cadastroRefeicao');
Route::post('/nutricionista/cadastro-refeicao', [RefeicaoController::class, 'store'])->name('refeicao.cadastroRefeicao');

Route::get('/nutricionista/cadastro-dieta', [DietaController::class, 'index']);
Route::post('/nutricionista/cadastro-dieta', [DietaController::class, 'store'])->name('dieta.cadastroDieta');