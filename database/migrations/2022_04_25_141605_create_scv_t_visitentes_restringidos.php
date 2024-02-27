<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScvTVisitentesRestringidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scv_t_visitentes_restringidos', function (Blueprint $table) {
            $table->string('ci_pasaporte', 15)->primary()->unique(true)->nullable(false);
            $table->string('nombres', 20)->nullable(false);
            $table->string('apallidos', 20)->nullable(false);
            $table->string('empresa', 30)->nullable();
            $table->string('motivo', 300)->nullable();
            $table->timestamp('fecha_hora_evento')->nullable(false);
            //$table->timestamps('fecha_hora_registro')->nullable(false);
            $table->timestamps();

            $table->foreignId('id_usuario')->references('id_usuario')->on('scv_t_usuarios');
            $table->foreignId('id_centro_trabajo')->references('id_centro_trabajo')->on('scv_t_centro_trabajo');
            $table->foreignId('id_status')->default(1)->references('id_status')->on('scv_t_estatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scv_t_visitentes_restringidos');
    }
}
