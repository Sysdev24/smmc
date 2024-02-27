<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScvTDestinoCentroTrabajo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scv_t_destino_centro_trabajo', function (Blueprint $table) {
            $table->id('id_destino');
            $table->string('destino', 200)->nullable(false)->unique();
            $table->unsignedBigInteger('id_centro_trabajo')->nullable(false);
            $table->unsignedBigInteger('id_status')->nullable(false)->default(1);
            $table->timestamps();

            $table->foreign('id_status')->references('id_status')->on('scv_t_estatus');
            $table->foreign('id_centro_trabajo')->references('id_centro_trabajo')->on('scv_t_centro_trabajo');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scv_t_destino_centro_trabajo');
    }
}
