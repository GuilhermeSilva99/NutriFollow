<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ConsumoAguaController;
use App\Http\Controllers\Api\ExercicioController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\RefeicaoPacienteController;
use App\Http\Controllers\Api\SonoController;
use App\Http\Controllers\Api\TipoExercicioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get("/paciente/sono/listar", [SonoController::class, "listarSono"])->name("paciente.sono.listar");
    Route::post("/paciente/sono/criar", [SonoController::class, "criarSono"])->name("paciente.sono.criar");
    Route::delete("/paciente/sono/{id}/deletar", [SonoController::class, "deletarSono"])->name("paciente.sono.deletar");
    Route::get("/paciente/sono/{id}", [SonoController::class, "recuperarSono"])->name("paciente.sono.recuperar");
    Route::put("/paciente/sono/{id}/atualizar", [SonoController::class, "atualizarSono"])->name("paciente.sono.atualizar");

    Route::get("/paciente/consumo-agua/listar", [ConsumoAguaController::class, "listarConsumoAgua"])->name("paciente.consumo.agua.listar");
    Route::post("/paciente/consumo-agua/criar", [ConsumoAguaController::class, "criarConsumoAgua"])->name("paciente.consumo.agua.criar");
    Route::delete("/paciente/consumo-agua/{id}/deletar", [ConsumoAguaController::class, "deletarConsumoAgua"])->name("paciente.consumo.agua.deletar");
    Route::get("/paciente/consumo-agua/{id}", [ConsumoAguaController::class, "recuperarConsumoAgua"])->name("paciente.consumo.agua.recuperar");
    Route::put("/paciente/consumo-agua/{id}/atualizar", [ConsumoAguaController::class, "atualizarConsumoAgua"])->name("paciente.consumo.agua.atualizar");

    Route::get("/paciente/exercicio/listar", [ExercicioController::class, "listarExercicios"])->name("paciente.exercicio.listar");
    Route::post("/paciente/exercicio/criar", [ExercicioController::class, "criarExercicio"])->name("paciente.exercicio.criar");
    Route::delete("/paciente/exercicio/{id}/deletar", [ExercicioController::class, "deletarExercicio"])->name("paciente.exercicio.deletar");
    Route::get("/paciente/exercicio/{id}", [ExercicioController::class, "recuperarExercicio"])->name("paciente.exercicio.recuperar");
    Route::put("/paciente/exercicio/{id}/atualizar", [ExercicioController::class, "atualizarExercicio"])->name("paciente.exercicio.atualizar");

    Route::get("/paciente/tipo-exercicio/listar", [TipoExercicioController::class, "listarTipoExercicios"])->name("paciente.tipo.exercicio.listar");
    Route::get("/paciente/tipo-exercicio/{id}", [TipoExercicioController::class, "recuperarTipoExercicio"])->name("paciente.tipo.exercicio.recuperar");

    Route::get("/paciente/refeicao-nutricionista/listar", [RefeicaoPacienteController::class, "listarRefeicaoDoNutricionista"])->name("paciente.refeicao.listar");
    Route::get("/paciente/refeicao/listar", [RefeicaoPacienteController::class, "listarRefeicaoDoPaciente"])->name("paciente.refeicao.listar");
    Route::post("/paciente/refeicao-paciente/criar", [RefeicaoPacienteController::class, "criarRefeicaoPaciente"])->name("paciente.refeicao-paciente.criar");
    Route::get("/paciente/refeicao-paciente/{id}", [RefeicaoPacienteController::class, "recuperarRefeicaoPaciente"])->name("paciente.refeicao-paciente.recuperar");
    Route::put("/paciente/refeicao-paciente/{id}/atualizar", [RefeicaoPacienteController::class, "atualizarRefeicaoPaciente"])->name("paciente.refeicao-paciente.atualizar");
    Route::delete("/paciente/refeicao-paciente/{id}/deletar", [RefeicaoPacienteController::class, "deletarRefeicaoPaciente"])->name("paciente.refeicao-paciente.deletar");

    Route::get("/paciente/informacoes", [PacienteController::class, "minhasInformacoes"])->name("paciente.informacoes");
    Route::put("/paciente/atualizar", [PacienteController::class, "atualizarInformacoes"])->name("paciente.atualizar");
});


Route::post('/criar-token', [ApiController::class, 'criarToken'])->name('criar-token');
