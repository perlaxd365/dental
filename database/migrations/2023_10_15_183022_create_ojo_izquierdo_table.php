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
        Schema::create('ojo_izquierdos', function (Blueprint $table) {
            $table->bigIncrements('id_ojo_izquierdo');
            //datos
            $table->string('esfera_izquierdo');
            $table->string('cilindro_izquierdo');
            $table->string('eje_izquierdo');
            $table->string('agudeza_visual_izquierdo')->nullable();
            $table->string('dp_izquierdo')->nullable();
            $table->string('estado_izquierdo');

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
        Schema::dropIfExists('ojo_izquierdos');
    }
};
