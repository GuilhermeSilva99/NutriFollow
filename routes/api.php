<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ConsumoAguaController;
use App\Http\Controllers\Api\SonoController;
use Illuminate\Http\Request;
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

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get("/paciente/sono/listar", [SonoController::class, "listarSono"])->name("paciente.sono.listar");
    Route::post("/paciente/sono/criar", [SonoController::class, "criarSono"])->name("paciente.sono.criar");
    Route::get("/paciente/sono/{id}/deletar", [SonoController::class, "deletarSono"])->name("paciente.sono.deletar");
    Route::get("/paciente/sono/{id}", [SonoController::class, "recuperarSono"])->name("paciente.sono.recuperar");
    Route::post("/paciente/sono/{id}/atualizar", [SonoController::class, "atualizarSono"])->name("paciente.sono.atualizar");

    Route::get("/paciente/consumo-agua/listar", [ConsumoAguaController::class, "listarConsumoAgua"])->name("paciente.consumo.agua.listar");
    Route::post("/paciente/consumo-agua/criar", [ConsumoAguaController::class, "criarConsumoAgua"])->name("paciente.consumo.agua.criar");
    Route::get("/paciente/consumo-agua/{id}/deletar", [ConsumoAguaController::class, "deletarConsumoAgua"])->name("paciente.consumo.agua.deletar");
    Route::get("/paciente/consumo-agua/{id}", [ConsumoAguaController::class, "recuperarConsumoAgua"])->name("paciente.consumo.agua.recuperar");
    Route::post("/paciente/consumo-agua/{id}/atualizar", [ConsumoAguaController::class, "atualizarConsumoAgua"])->name("paciente.consumo.agua.atualizar");
});


Route::post('/criar-token', [ApiController::class, 'criarToken'])->name('criar-token');
