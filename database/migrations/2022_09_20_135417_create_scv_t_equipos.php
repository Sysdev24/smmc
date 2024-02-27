<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScvTEquipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scv_t_equipos', function (Blueprint $table) {
            $table->id('id_equipo');
            $table->string('descripcion_equipo',60)->nullable(false);
            $table->string('serial',16)->nullable(false);
            $table->string('observacion',60)->nullable();
            $table->timestamp('fecha_hora_entrada')->nullable(false);
            $table->timestamp('fecha_hora_salida')->nullable();

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
        Schema::dropIfExists('scv_t_equipos');
    }
}
