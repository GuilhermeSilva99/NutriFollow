<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\PacienteController;
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

    Route::get("/paciente/sono/listar", [PacienteController::class, "listarSono"])->name("paciente.sono.listar");
    Route::post("/paciente/sono/criar", [PacienteController::class, "criarSono"])->name("paciente.sono.criar");
    Route::get("/paciente/sono/{id}/deletar", [PacienteController::class, "deletarSono"])->name("paciente.sono.deletar");
    Route::get("/paciente/sono/{id}", [PacienteController::class, "recuperarSono"])->name("paciente.sono.recuperar");
    Route::post("/paciente/sono/{id}/atualizar", [PacienteController::class, "atualizarSono"])->name("paciente.sono.atualizar");
});


Route::post('/criar-token', [ApiController::class, 'criarToken'])->name('criar-token');
