<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AdminController};
use App\Http\Controllers\AguaController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\NutricionistaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RefeicaoController;
use App\Http\Controllers\DietaController;
use App\Models\Paciente;
use App\Http\Controllers\SonoController;

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

    Route::middleware('CheckUserAdmin')->group(function () {
        Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
        Route::put('/admin/ativar-cadastro/nutricionista/{id}', [AdminController::class, 'ativarCadastroNutricionista'])->name('admin.ativar.cadastro.nutricionista');
        Route::delete('/admin/recusar-cadastro/nutricionista/{id}', [AdminController::class, 'recusarCadastroNutricionista'])->name('admin.recusar.cadastro.nutricionista');
        Route::get('/admin/listar/nutricionistas', [AdminController::class, 'listarNutricionistas'])->name('admin.listar.nutricionistas');
        Route::delete('/admin/inativar-nutricionista/{id}', [AdminController::class, 'inativarNutricionista'])->name('admin.inativar.nutricionista');
        Route::get('/admin/listar/nutricionistas-inativos', [AdminController::class, 'listarNutricionistasInativos'])->name('admin.listar.nutricionistas.inativos');
        Route::put('/admin/reativar-cadastro/nutricionista/{id}', [AdminController::class, 'reativarNutricionista'])->name('admin.reativar.cadastro.nutricionista');
    });

    Route::get('/nutricionista/register-paciente', [NutricionistaController::class, 'index']);

    Route::get('/nutricionista/cadastrar-paciente', [NutricionistaController::class, 'cadastrarPaciente'])->name('nutricionista.cadastrar.paciente');
    Route::post('/nutricionista/cadastrar-paciente', [NutricionistaController::class, 'salvarPaciente'])->name('nutricionista.salvar.paciente');
    Route::post('/nutricionista/paciente/create', [NutricionistaController::class, 'salvarPaciente'])->name('nutricionista.paciente.create');
    Route::get('/nutricionista/listar/pacientes', [NutricionistaController::class, 'listarPacientes'])->name('nutricionista.listar.pacientes');
    Route::get('/nutricionista/editar/paciente/{id}', [NutricionistaController::class, 'editarPaciente'])->name('nutricionista.editar.paciente');
    Route::post('/nutricionista/editar/paciente/{id}', [NutricionistaController::class, 'atualizarPaciente'])->name('nutricionista.atualizar.paciente');
    Route::get('/nutricionista/exibir/paciente/{id}', [NutricionistaController::class, 'exibirPaciente'])->name('nutricionista.exibir.paciente');
    Route::get('/nutricionista/paciente/senha/{id}', [NutricionistaController::class, 'editarSenha'])->name('nutricionista.paciente.senha');
    Route::post('/nutricionista/paciente/senha/{id}', [NutricionistaController::class, 'atualizarSenha'])->name('nutricionista.paciente.atualizar.senha');
    Route::delete('/nutricionista/paciente/inativar/{id}', [NutricionistaController::class, 'inativarPaciente'])->name('nutricionista.paciente.inativar');

    Route::post('/nutricionista/cadastro-refeicao', [RefeicaoController::class, 'store'])->name('refeicao.cadastroRefeicao.post');


    Route::get('/paciente/cadastro-dieta', [DietaController::class, 'index']);
    Route::post('/paciente/cadastro-dieta', [DietaController::class, 'store'])->name('dieta.cadastroDieta');
    Route::get('/paciente/cadastro-dieta/{id}', [DietaController::class, 'view'])->name('dieta.view-dieta');
    Route::get('/nutricionista/cadastro-refeicao/{id}', [DietaController::class, 'adicionarRefeicao'])->name('refeicao.PrepDietaRef');

    Route::middleware('NutricionistaDoPaciente')->group(function(){
        Route::get('/nutricionista/paciente/sono/{id}', [SonoController::class, 'index'])->name('sono');
        Route::post('/nutricionista/paciente/sono/{id}', [SonoController::class, 'index'])->name('sono.filtrar');
        Route::get('/nutricionista/paciente/agua/{id}', [AguaController::class, 'index'])->name('agua');
        Route::post('/nutricionista/paciente/agua/{id}', [AguaController::class, 'index'])->name('agua.filtrar');
    });

    
});
