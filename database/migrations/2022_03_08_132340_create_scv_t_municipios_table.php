<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScvTMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scv_t_municipios', function (Blueprint $table) {
            $table->id('id_municipio');
            $table->string('nombre', 50)->nullable(false);
            $table->unsignedBigInteger('id_estado')->nullable(false);
            $table->unsignedBigInteger('id_status')->nullable(false)->default(1);
            $table->timestamps();

            $table->foreign('id_estado')->references('id_estado')->on('scv_t_estados');
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
        Schema::dropIfExists('scv_t_municipios');
    }
}
