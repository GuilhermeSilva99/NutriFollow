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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("sexo");
            $table->string("observacoes", 100);

            $table->unsignedBigInteger("users_id")->nullable();
            $table->foreign("users_id")->references("id")->on("users");

            $table->unsignedBigInteger("nutricionistas_id")->nullable();
            $table->foreign("nutricionistas_id")->references("id")->on("nutricionistas");

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
        Schema::dropIfExists('pacientes');
    }
};
