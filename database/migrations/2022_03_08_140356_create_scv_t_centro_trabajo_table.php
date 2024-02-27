<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScvTCentroTrabajoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scv_t_centro_trabajo', function (Blueprint $table) {
            $table->id('id_centro_trabajo');
            $table->string('nombre', 60)->nullable(false);
            $table->string('siglas', 10)->nullable(false);
            $table->unsignedBigInteger('id_municipio')->nullable(false);
            $table->unsignedBigInteger('id_status')->nullable(false)->default(1);

            $table->timestamps();

            $table->foreign('id_municipio')->references('id_municipio')->on('scv_t_municipios');
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
        Schema::dropIfExists('scv_t_centro_trabajo');
    }
}
