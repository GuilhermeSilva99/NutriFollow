<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AdminController};
use App\Http\Controllers\AguaController;
use App\Http\Controllers\Api\ExercicioController;
use App\Http\Controllers\NutricionistaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RefeicaoController;
use App\Http\Controllers\DietaController;
use App\Http\Controllers\MedidaController;
use App\Http\Controllers\SonoController;
use App\Http\Controllers\SuplementoController;

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
    Route::get('/nutricionista/editar-refeicao/{id}', [RefeicaoController::class, 'editarRefeicao'])->name('refeicao.editarRefeicao');
    Route::post('/nutricionista/editar-refeicao/{id}', [RefeicaoController::class, 'atualizarRefeicao'])->name('refeicao.atualizarRefeicao');

    Route::get('/nutricionista/criar/comorbidade/paciente/{id}', [NutricionistaController::class, 'criarComorbidadePaciente'])->name('nutricionista.criar.comorbidade.paciente');
    Route::post('/nutricionista/salvar/comorbidade/paciente', [NutricionistaController::class, 'salvarComorbidadePaciente'])->name('nutricionista.salvar.comorbidade.paciente');
    Route::get('/nutricionista/listar/comorbidade/paciente/{id}', [NutricionistaController::class, 'listarComorbidadesPaciente'])->name('nutricionista.listar.comorbidade.paciente');
    Route::get('/nutricionista/editar/comorbidade/paciente/{id}', [NutricionistaController::class, 'editarComorbidadePaciente'])->name('nutricionista.editar.comorbidade.paciente');
    Route::put('/nutricionista/editar/comorbidade/paciente/{id}', [NutricionistaController::class, 'atualizarComorbidadePaciente'])->name('nutricionista.atualizar.comorbidade.paciente');
    Route::delete('/nutricionista/deletar/comorbidade/paciente/{id}', [NutricionistaController::class, 'deletarComorbidadePaciente'])->name('nutricionista.deletar.comorbidade.paciente');

    Route::get('/nutricionista/cadastrar/exame/paciente/{id}', [NutricionistaController::class, 'cadastrarExamePaciente'])->name('nutricionista.cadastrar.exame.paciente');
    Route::get('/nutricionista/listar/exame/paciente/{id}', [NutricionistaController::class, 'listarExamePaciente'])->name('nutricionista.listar.exame.paciente');
    Route::post('/nutricionista/salvar/exame/paciente/', [NutricionistaController::class, 'salvarExamePaciente'])->name('nutricionista.salvar.exame.paciente');
    Route::get('/nutricionista/editar/exame/paciente/{id}', [NutricionistaController::class, 'editarExamePaciente'])->name('nutricionista.editar.exame.paciente');
    Route::put('/nutricionista/editar/exame/paciente/{id}', [NutricionistaController::class, 'atualizarExamePaciente'])->name('nutricionista.atualizar.exame.paciente');
    Route::delete('/nutricionista/deletar/exame/paciente/{id}', [NutricionistaController::class, 'deletarExamePaciente'])->name('nutricionista.deletar.exame.paciente');
    Route::get('/nutricionista/realizar-consulta', [NutricionistaController::class, 'consulta'])->name('realizar.consulta'); //rota teste

    Route::get('/nutricionista/cadastrar/suplemento/paciente/{id}', [SuplementoController::class, 'cadastrarsuplemento'])->name('nutricionista.cadastrar.suplemento.paciente');
    Route::get('/nutricionista/listar/suplemento/paciente/{id}', [SuplementoController::class, 'listarSuplementos'])->name('nutricionista.listar.suplemento.paciente');
    Route::post('/nutricionista/salvar/suplemento/paciente/', [SuplementoController::class, 'store'])->name('nutricionista.salvar.suplemento.paciente');
    Route::get('/nutricionista/editar/suplemento/paciente/{id}', [SuplementoController::class, 'editarSuplemento'])->name('nutricionista.editar.suplemento.paciente');
    Route::put('/nutricionista/editar/suplemento/paciente/{id}', [SuplementoController::class, 'atualizarSuplemento'])->name('nutricionista.atualizar.suplemento.paciente');
    Route::delete('/nutricionista/deletar/suplemento/paciente/{id}', [SuplementoController::class, 'deletarSuplemento'])->name('nutricionista.deletar.suplemento.paciente');



    Route::get('/paciente/cadastro-dieta', [DietaController::class, 'index']);
    Route::post('/paciente/cadastro-dieta', [DietaController::class, 'store'])->name('dieta.cadastroDieta');
    Route::get('/paciente/cadastro-dieta/{id}', [DietaController::class, 'view'])->name('dieta.view-dieta');
    Route::get('/nutricionista/cadastro-refeicao/{id}', [DietaController::class, 'adicionarRefeicao'])->name('refeicao.PrepDietaRef');
    Route::get('/paciente/dietas/{id}', [DietaController::class, 'listarDietas'])->name('dieta.dietas');
    Route::get('/paciente/dieta/editar/{id}', [DietaController::class, 'editarDieta'])->name('dieta.editarDieta');
    Route::post('/paciente/dieta/editar/{id}', [DietaController::class, 'atualizarDieta'])->name('dieta.atualizarDieta');

    Route::get('/nutricionista/paciente/medida/{id}', [MedidaController::class, 'index'])->name('medida');
    Route::delete('/nutricionista/paciente/deletar/medida/{id}/{medida_id}', [MedidaController::class, 'delete'])->name('medida.delete');
    Route::get('/nutricionista/paciente/cadastrar/medida/{id}', [MedidaController::class, 'adicionarMedida'])->name('medida.cadastrar');
    Route::post('/nutricionista/paciente/cadastrar/medida/{id}', [MedidaController::class, 'adicionarMedida']);
    Route::put('/nutricionista/paciente/editar/medida/{id}/{medida_id}', [MedidaController::class, 'editarMedida'])->name('medida.editar');

    Route::middleware('NutricionistaDoPaciente')->group(function () {
        Route::get('/nutricionista/paciente/sono/{id}', [SonoController::class, 'index'])->name('sono');
        Route::post('/nutricionista/paciente/sono/{id}', [SonoController::class, 'index'])->name('sono.filtrar');
        Route::get('/nutricionista/paciente/agua/{id}', [AguaController::class, 'index'])->name('agua');
        Route::post('/nutricionista/paciente/agua/{id}', [AguaController::class, 'index'])->name('agua.filtrar');
        Route::get('/nutricionista/paciente/relatorio-dieta/{id}', [RefeicaoController::class, 'listarRefeicoes'])->name('dieta.relatorio');
        Route::post('/nutricionista/paciente/relatorio-dieta/{id}', [RefeicaoController::class, 'listarRefeicoes']);
        Route::get('/nutricionista/paciente/exercicio/{id}', [ExercicioController::class, 'index'])->name('exercicio');
        Route::post('/nutricionista/paciente/exercicio/{id}', [ExercicioController::class, 'index'])->name('exercicio.filtrar');
    });
});
