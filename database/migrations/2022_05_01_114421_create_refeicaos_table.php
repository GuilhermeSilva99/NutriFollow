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

            $table->foreignId('dieta_id')->references('id')->on('dietas');#->constrained('dietas')->onDelete('cascade');
            

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
