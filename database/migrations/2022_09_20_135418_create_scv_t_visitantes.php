<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScvTVisitantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scv_t_visitantes', function (Blueprint $table) {
            $table->id('id_visitante');
            $table->string('ci_pasaporte', 15)->nullable(false);
            $table->string('nombres', 20)->nullable(false);
            $table->string('apellidos', 20)->nullable(false);
            $table->string('telefono', 12)->nullable();
            $table->string('procedencia', 30)->nullable();
            $table->string('no_carnet_asignado', 15)->nullable();
            $table->timestamp('fecha_hora_entrada')->nullable(false);
            $table->timestamp('fecha_hora_salida')->nullable();
            $table->string('nombres_apellidos_visitado', 45)->nullable(false);
            $table->string('ci_visitado', 15)->nullable(false);
            $table->string('nombres_apellidos_autoriza', 45)->nullable(false);
            $table->string('ci_autoriza', 15)->nullable(false);
            $table->string('observacion', 300)->nullable();

            $table->unsignedBigInteger('id_tipo_visitante')->nullable(false)->default(1);
            $table->unsignedBigInteger('id_motivo_visita')->nullable(false)->default(1);
            $table->unsignedBigInteger('id_centro_trabajo')->nullable(false)->default(1);
            $table->unsignedBigInteger('id_destino')->nullable(false)->default(1);
            $table->unsignedBigInteger('id_equipo')->nullable();
            $table->unsignedBigInteger('id_operador')->nullable(false)->default(1);
            $table->timestamps();

            $table->foreign('id_tipo_visitante')->references('id_tipo_visitante')->on('scv_t_tipos_visitantes');
            $table->foreign('id_motivo_visita')->references('id_motivo_visita')->on('scv_t_motivos_visitas');
            $table->foreign('id_centro_trabajo')->references('id_centro_trabajo')->on('scv_t_centro_trabajo');
            $table->foreign('id_equipo')->references('id_equipo')->on('scv_t_equipos');
            $table->foreign('id_operador')->references('id_usuario')->on('scv_t_usuarios');
            $table->foreign('id_destino')->references('id_destino')->on('scv_t_destino_centro_trabajo');
            $table->foreign('no_carnet_asignado')->references('carnet')->on('scv_t_carnets');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scv_t_visitantes');
    }
}
