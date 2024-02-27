<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScvTUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scv_t_usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('ci', 10)->unique(true);
            $table->string('usuario', 10);
            $table->string('password')->nullable();
            $table->integer('no_carnet')->nullable(false)->unique(true);
            $table->string('nombres', 20)->nullable(false);
            $table->string('apellidos', 20)->nullable(false);
            $table->string('email', 30)->nullable(false)->unique(true);
            $table->unsignedBigInteger('id_status')->nullable(false)->default(1);
            $table->unsignedBigInteger('id_centro_trabajo')->nullable(false);
            $table->unsignedBigInteger('id_tipo_usuario')->nullable(false);
            $table->timestamps();

            $table->foreign('id_status')->references('id_status')->on('scv_t_estatus');
            $table->foreign('id_centro_trabajo')->references('id_centro_trabajo')->on('scv_t_centro_trabajo');
            $table->foreign('id_tipo_usuario')->references('id_tipo_usuario')->on('scv_t_tipos_usuarios');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scv_scv_t_usuariosusuarios');
    }
}
