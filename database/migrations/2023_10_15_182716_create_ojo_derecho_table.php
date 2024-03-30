<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ojo_derechos', function (Blueprint $table) {
            $table->bigIncrements('id_ojo_derecho');
            //datos
            $table->string('esfera_derecho');
            $table->string('cilindro_derecho');
            $table->string('eje_derecho');
            $table->string('agudeza_visual_derecho')->nullable();
            $table->string('dp_derecho')->nullable();
            $table->string('estado_derecho');

            $table->string('id_empresa');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ojo_derechos');
    }
};
