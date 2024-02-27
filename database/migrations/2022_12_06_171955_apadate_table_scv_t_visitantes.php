<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ApadateTableScvTVisitantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('scv_t_visitantes', function (Blueprint $table) {

          $table->dropColumn(['id_equipo','id_operador']);

          $table->unsignedBigInteger('id_opetador_entrada')->nullable(false)->default(1);
          $table->unsignedBigInteger('id_opetador_salida')->nullable();

          $table->foreign('id_opetador_entrada')->references('id_usuario')->on('scv_t_usuarios');
          $table->foreign('id_opetador_salida')->references('id_usuario')->on('scv_t_usuarios');


        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scv_t_visitantes', function (Blueprint $table) {


            $table->dropColumn('id_opetador_entrada');
            $table->dropColumn('id_opetador_salida');

            $table->unsignedBigInteger('id_equipo')->nullable(true);
            $table->unsignedBigInteger('id_operador')->nullable(true);

            $table->foreign('id_equipo')->references('id_equipo')->on('scv_t_equipos');
            $table->foreign('id_operador')->references('id_usuario')->on('scv_t_usuarios');

        });
    }
}
