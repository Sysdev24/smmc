<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScvTCodigosArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scv_t_codigos_area', function (Blueprint $table) {
            $table->id('id_area');
            $table->string('codigo_area', 4)->nullable(false);
            $table->string('referencia', 400)->nullable(false);
            $table->unsignedBigInteger('id_status')->nullable(false)->default(1);
            $table->timestamps();

            $table->foreign('id_status')->references('id_status')->on('scv_t_estatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scv_t_codigos_area');
    }
}
