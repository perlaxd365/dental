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
            $table->unsignedBigInteger('id_tipo_pago')->nullable()->comment('id del tipo de pago al que pertenece');
            //datos
            $table->decimal('monto_detalle', 8, 2)->nullable();
            $table->decimal('tipo_cambio_detalle', 8, 2)->nullable();
            $table->integer('moneda_detalle')->nullable();
            $table->string('nombre_completo_detalle')->nullable();
            $table->string('numero_cuota_detalle')->nullable();
            $table->string('numero_telefono_detalle')->nullable();
            $table->string('numero_transferencia_detalle')->nullable();
            $table->string('numero_operacion_detalle')->nullable();
            $table->string('fecha_fin_detalle')->nullable();
            $table->string('observaciones_detalle')->nullable();
            $table->string('fecha_notificacion_detalle')->nullable();
            $table->string('adjunto_detalle')->nullable();
            $table->boolean('notificacion_detalle')->nullable();
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
