<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditColumnseToScvTEquipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scv_t_equipos', function (Blueprint $table) {

           $table->dropColumn(['fecha_hora_entrada','fecha_hora_salida']);

            $table->boolean('salio')->default(false);
            $table->boolean('entro')->default(false);
            $table->string('ci_pasaporte', 15)->nullable(false);
            $table->string('observacion', 150)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scv_t_equipos', function (Blueprint $table) {

            $table->dropColumn(['salio','entro','ci_pasaporte','observacion']);

            $table->timestamp('fecha_hora_entrada')->nullable();
            $table->timestamp('fecha_hora_salida')->nullable();

        });
    }
}
