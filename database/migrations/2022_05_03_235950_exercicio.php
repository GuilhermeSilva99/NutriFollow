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
        Schema::create('exercicios', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->nullable();
            $table->time('duracao');
            $table->string('descricao');
            $table->date('data');
            $table->string("observacoes")->nullable();
            $table->foreignId('paciente_id')->constrained('pacientes');
            $table->foreignId('tipo_exercicio_id')->constrained('tipo_exercicios')->nullable();
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
        //
    }
};
