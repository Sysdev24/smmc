<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScvTEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scv_t_estados', function (Blueprint $table) {
            $table->id('id_estado');
            $table->string('nombre', 25)->nullable(false)->unique();
            $table->timestamps();
            $table->unsignedBigInteger('id_status')->nullable(false)->default(1);

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
        Schema::dropIfExists('scv_t_estados');
    }
}
