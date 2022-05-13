<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refeicaos', function (Blueprint $table) {
            $table->id();
            $table->string("dia_da_semana")->nullable();
            $table->string("descricao_refeicao");
            $table->double("caloria");
            $table->time("horario");
            $table->string("nome_refeicao");
            $table->date("data")->nullable();
            $table->string("foto")->nullable();
            $table->string("observacoes")->nullable();
            $table->foreignId('dieta_id')->constrained('dietas');
            $table->foreignId('nutricionista_id')->nullable()->constrained('nutricionistas');
            $table->foreignId('paciente_id')->nullable()->constrained('pacientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refeicaos');
    }
};
