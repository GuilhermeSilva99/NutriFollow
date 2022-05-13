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
        Schema::create('refeicao_nutricionistas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refeicao_id')->references('id')->on('refeicaos');
            $table->foreignId('nutricionista_id')->references('id')->on('nutricionistas');
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
        Schema::dropIfExists('refeicao_nutricionistas');
    }
};
