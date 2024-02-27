<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScvTCarnets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scv_t_carnets', function (Blueprint $table) {
            $table->unsignedBigInteger('carnet')->primary()->unique(true)->nullable(false);
            $table->unsignedBigInteger('id_status')->nullable(false)->default(1);
            $table->unsignedBigInteger('id_centro_trabajo')->nullable(false);
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
        Schema::dropIfExists('scv_t_carnets');
    }
}
