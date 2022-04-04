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
        Schema::create('nutricionistas', function (Blueprint $table) {
            $table->id();
            $table->string("crn", 45)->unique();
            $table->string("uf", 2);

            $table->unsignedBigInteger("users_id")->nullable();
            $table->foreign("users_id")->references("id")->on("users");

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
        Schema::dropIfExists('nutricionistas');
    }
};
