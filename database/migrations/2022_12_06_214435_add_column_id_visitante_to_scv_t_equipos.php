<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdVisitanteToScvTEquipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scv_t_equipos', function (Blueprint $table) {

          $table->unsignedBigInteger('id_visitante')->nullable();
          $table->foreign('id_visitante')->references('id_visitante')->on('scv_t_visitantes')->onDelete('cascade');

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
            $table->dropColumn('id_visitante');
        });
    }
}
