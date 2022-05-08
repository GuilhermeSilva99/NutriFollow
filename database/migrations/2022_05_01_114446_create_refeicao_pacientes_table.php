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
        Schema::create('refeicao_pacientes', function (Blueprint $table) {
            $table->id();
            $table->string("foto");
            
            $table->foreignId('refeicao_id')->references('id')->on('refeicaos');
            $table->foreignId('paciente_id')->references('id')->on('pacientes');

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
        Schema::dropIfExists('refeicao_pacientes');
    }
};
