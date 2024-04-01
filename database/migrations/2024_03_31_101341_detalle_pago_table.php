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
        //
        Schema::create('detalle_pagos', function (Blueprint $table) {
            //id
            $table->bigIncrements('id_detalle_pago');
            $table->unsignedBigInteger('id_pago')->comment('id del pago al que pertenece');
            //datos
            $table->decimal('monto_detalle', 8, 2)->nullable();
            $table->decimal('tipo_cambio_detalle', 8, 2)->nullable();
            $table->integer('moneda_detalle');
            $table->string('numero_telefono_detalle');
            $table->string('numero_transferencia_detalle');
            $table->string('numero_operación_detalle');
            $table->string('observaciones_detalle');
            $table->boolean('estado_detalle');
            $table->boolean('estado');


            $table->timestamps();

            //claves foraneas
            $table->foreign('id_pago')->references('id_pago')->on('pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('pagos');
    }
};
